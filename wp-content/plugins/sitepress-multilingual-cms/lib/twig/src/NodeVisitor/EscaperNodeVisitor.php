<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\NodeVisitor;

use WPML\Core\Twig\Environment;
use WPML\Core\Twig\Node\AutoEscapeNode;
use WPML\Core\Twig\Node\BlockNode;
use WPML\Core\Twig\Node\BlockReferenceNode;
use WPML\Core\Twig\Node\DoNode;
use WPML\Core\Twig\Node\Expression\ConditionalExpression;
use WPML\Core\Twig\Node\Expression\ConstantExpression;
use WPML\Core\Twig\Node\Expression\FilterExpression;
use WPML\Core\Twig\Node\Expression\InlinePrint;
use WPML\Core\Twig\Node\ImportNode;
use WPML\Core\Twig\Node\ModuleNode;
use WPML\Core\Twig\Node\Node;
use WPML\Core\Twig\Node\PrintNode;
use WPML\Core\Twig\NodeTraverser;
use WPML\Core\Twig_NodeInterface;
use function array_pop;
use function class_alias;
use function count;
use function get_class;
use function in_array;

/**
 * @final
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class EscaperNodeVisitor extends AbstractNodeVisitor
{
    protected $statusStack = [];
    protected $blocks = [];
    protected $safeAnalysis;
    protected $traverser;
    protected $defaultStrategy = FALSE;
    protected $safeVars = [];
    public function __construct()
    {
        $this->safeAnalysis = new SafeAnalysisNodeVisitor();
    }
    protected function doEnterNode(Node $node, Environment $env)
    {
        if ($node instanceof ModuleNode) {
            if ($env->hasExtension('WPML\\Core\\Twig\\Extension\\EscaperExtension') && ($defaultStrategy = $env->getExtension('WPML\\Core\\Twig\\Extension\\EscaperExtension')->getDefaultStrategy($node->getTemplateName()))) {
                $this->defaultStrategy = $defaultStrategy;
            }
            $this->safeVars = [];
            $this->blocks = [];
        } elseif ($node instanceof AutoEscapeNode) {
            $this->statusStack[] = $node->getAttribute('value');
        } elseif ($node instanceof BlockNode) {
            $this->statusStack[] = isset($this->blocks[$node->getAttribute('name')]) ? $this->blocks[$node->getAttribute('name')] : $this->needEscaping($env);
        } elseif ($node instanceof ImportNode) {
            $this->safeVars[] = $node->getNode('var')->getAttribute('name');
        }
        return $node;
    }
    protected function doLeaveNode(Node $node, Environment $env)
    {
        if ($node instanceof ModuleNode) {
            $this->defaultStrategy = FALSE;
            $this->safeVars = [];
            $this->blocks = [];
        } elseif ($node instanceof FilterExpression) {
            return $this->preEscapeFilterNode($node, $env);
        } elseif ($node instanceof PrintNode && FALSE !== ($type = $this->needEscaping($env))) {
            $expression = $node->getNode('expr');
            if ($expression instanceof ConditionalExpression && $this->shouldUnwrapConditional($expression, $env, $type)) {
                return new DoNode($this->unwrapConditional($expression, $env, $type), $expression->getTemplateLine());
            }
            return $this->escapePrintNode($node, $env, $type);
        }
        if ($node instanceof AutoEscapeNode || $node instanceof BlockNode) {
            array_pop($this->statusStack);
        } elseif ($node instanceof BlockReferenceNode) {
            $this->blocks[$node->getAttribute('name')] = $this->needEscaping($env);
        }
        return $node;
    }
    private function shouldUnwrapConditional(ConditionalExpression $expression, Environment $env, $type)
    {
        $expr2Safe = $this->isSafeFor($type, $expression->getNode('expr2'), $env);
        $expr3Safe = $this->isSafeFor($type, $expression->getNode('expr3'), $env);
        return $expr2Safe !== $expr3Safe;
    }
    private function unwrapConditional(ConditionalExpression $expression, Environment $env, $type)
    {
        // convert "echo a ? b : c" to "a ? echo b : echo c" recursively
        $expr2 = $expression->getNode('expr2');
        if ($expr2 instanceof ConditionalExpression && $this->shouldUnwrapConditional($expr2, $env, $type)) {
            $expr2 = $this->unwrapConditional($expr2, $env, $type);
        } else {
            $expr2 = $this->escapeInlinePrintNode(new InlinePrint($expr2, $expr2->getTemplateLine()), $env, $type);
        }
        $expr3 = $expression->getNode('expr3');
        if ($expr3 instanceof ConditionalExpression && $this->shouldUnwrapConditional($expr3, $env, $type)) {
            $expr3 = $this->unwrapConditional($expr3, $env, $type);
        } else {
            $expr3 = $this->escapeInlinePrintNode(new InlinePrint($expr3, $expr3->getTemplateLine()), $env, $type);
        }
        return new ConditionalExpression($expression->getNode('expr1'), $expr2, $expr3, $expression->getTemplateLine());
    }
    private function escapeInlinePrintNode(InlinePrint $node, Environment $env, $type)
    {
        $expression = $node->getNode('node');
        if ($this->isSafeFor($type, $expression, $env)) {
            return $node;
        }
        return new InlinePrint($this->getEscaperFilter($type, $expression), $node->getTemplateLine());
    }
    protected function escapePrintNode(PrintNode $node, Environment $env, $type)
    {
        if (FALSE === $type) {
            return $node;
        }
        $expression = $node->getNode('expr');
        if ($this->isSafeFor($type, $expression, $env)) {
            return $node;
        }
        $class = get_class($node);
        return new $class($this->getEscaperFilter($type, $expression), $node->getTemplateLine());
    }
    protected function preEscapeFilterNode(FilterExpression $filter, Environment $env)
    {
        $name = $filter->getNode('filter')->getAttribute('value');
        $type = $env->getFilter($name)->getPreEscape();
        if (null === $type) {
            return $filter;
        }
        $node = $filter->getNode('node');
        if ($this->isSafeFor($type, $node, $env)) {
            return $filter;
        }
        $filter->setNode('node', $this->getEscaperFilter($type, $node));
        return $filter;
    }
    protected function isSafeFor($type, Twig_NodeInterface $expression, $env)
    {
        $safe = $this->safeAnalysis->getSafe($expression);
        if (null === $safe) {
            if (null === $this->traverser) {
                $this->traverser = new NodeTraverser($env, [$this->safeAnalysis]);
            }
            $this->safeAnalysis->setSafeVars($this->safeVars);
            $this->traverser->traverse($expression);
            $safe = $this->safeAnalysis->getSafe($expression);
        }
        return in_array($type, $safe) || in_array('all', $safe);
    }
    protected function needEscaping(Environment $env)
    {
        if (count($this->statusStack)) {
            return $this->statusStack[count($this->statusStack) - 1];
        }
        return $this->defaultStrategy ? $this->defaultStrategy : FALSE;
    }
    protected function getEscaperFilter($type, Twig_NodeInterface $node)
    {
        $line = $node->getTemplateLine();
        $name = new ConstantExpression('escape', $line);
        $args = new Node([new ConstantExpression((string) $type, $line), new ConstantExpression(null, $line), new ConstantExpression(TRUE, $line)]);
        return new FilterExpression($node, $name, $args, $line);
    }
    public function getPriority()
    {
        return 0;
    }
}
class_alias('WPML\\Core\\Twig\\NodeVisitor\\EscaperNodeVisitor', 'WPML\\Core\\Twig_NodeVisitor_Escaper');
