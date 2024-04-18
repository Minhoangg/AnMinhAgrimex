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
use WPML\Core\Twig\Node\CheckSecurityNode;
use WPML\Core\Twig\Node\CheckToStringNode;
use WPML\Core\Twig\Node\Expression\Binary\ConcatBinary;
use WPML\Core\Twig\Node\Expression\Binary\RangeBinary;
use WPML\Core\Twig\Node\Expression\FilterExpression;
use WPML\Core\Twig\Node\Expression\FunctionExpression;
use WPML\Core\Twig\Node\Expression\GetAttrExpression;
use WPML\Core\Twig\Node\Expression\NameExpression;
use WPML\Core\Twig\Node\ModuleNode;
use WPML\Core\Twig\Node\Node;
use WPML\Core\Twig\Node\PrintNode;
use WPML\Core\Twig\Node\SetNode;
use function class_alias;

/**
 * @final
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class SandboxNodeVisitor extends AbstractNodeVisitor
{
    protected $inAModule = FALSE;
    protected $tags;
    protected $filters;
    protected $functions;
    private $needsToStringWrap = FALSE;
    protected function doEnterNode(Node $node, Environment $env)
    {
        if ($node instanceof ModuleNode) {
            $this->inAModule = TRUE;
            $this->tags = [];
            $this->filters = [];
            $this->functions = [];
            return $node;
        } elseif ($this->inAModule) {
            // look for tags
            if ($node->getNodeTag() && !isset($this->tags[$node->getNodeTag()])) {
                $this->tags[$node->getNodeTag()] = $node;
            }
            // look for filters
            if ($node instanceof FilterExpression && !isset($this->filters[$node->getNode('filter')->getAttribute('value')])) {
                $this->filters[$node->getNode('filter')->getAttribute('value')] = $node;
            }
            // look for functions
            if ($node instanceof FunctionExpression && !isset($this->functions[$node->getAttribute('name')])) {
                $this->functions[$node->getAttribute('name')] = $node;
            }
            // the .. operator is equivalent to the range() function
            if ($node instanceof RangeBinary && !isset($this->functions['range'])) {
                $this->functions['range'] = $node;
            }
            if ($node instanceof PrintNode) {
                $this->needsToStringWrap = TRUE;
                $this->wrapNode($node, 'expr');
            }
            if ($node instanceof SetNode && !$node->getAttribute('capture')) {
                $this->needsToStringWrap = TRUE;
            }
            // wrap outer nodes that can implicitly call __toString()
            if ($this->needsToStringWrap) {
                if ($node instanceof ConcatBinary) {
                    $this->wrapNode($node, 'left');
                    $this->wrapNode($node, 'right');
                }
                if ($node instanceof FilterExpression) {
                    $this->wrapNode($node, 'node');
                    $this->wrapArrayNode($node, 'arguments');
                }
                if ($node instanceof FunctionExpression) {
                    $this->wrapArrayNode($node, 'arguments');
                }
            }
        }
        return $node;
    }
    protected function doLeaveNode(Node $node, Environment $env)
    {
        if ($node instanceof ModuleNode) {
            $this->inAModule = FALSE;
            $node->getNode('constructor_end')->setNode('_security_check', new Node([new CheckSecurityNode($this->filters, $this->tags, $this->functions), $node->getNode('display_start')]));
        } elseif ($this->inAModule) {
            if ($node instanceof PrintNode || $node instanceof SetNode) {
                $this->needsToStringWrap = FALSE;
            }
        }
        return $node;
    }
    private function wrapNode(Node $node, $name)
    {
        $expr = $node->getNode($name);
        if ($expr instanceof NameExpression || $expr instanceof GetAttrExpression) {
            $node->setNode($name, new CheckToStringNode($expr));
        }
    }
    private function wrapArrayNode(Node $node, $name)
    {
        $args = $node->getNode($name);
        foreach ($args as $name => $_) {
            $this->wrapNode($args, $name);
        }
    }
    public function getPriority()
    {
        return 0;
    }
}
class_alias('WPML\\Core\\Twig\\NodeVisitor\\SandboxNodeVisitor', 'WPML\\Core\\Twig_NodeVisitor_Sandbox');
