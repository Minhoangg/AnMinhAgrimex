<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Node\Expression\Test;

use WPML\Core\Twig\Compiler;
use WPML\Core\Twig\Error\SyntaxError;
use WPML\Core\Twig\Node\Expression\ArrayExpression;
use WPML\Core\Twig\Node\Expression\BlockReferenceExpression;
use WPML\Core\Twig\Node\Expression\ConstantExpression;
use WPML\Core\Twig\Node\Expression\FunctionExpression;
use WPML\Core\Twig\Node\Expression\GetAttrExpression;
use WPML\Core\Twig\Node\Expression\NameExpression;
use WPML\Core\Twig\Node\Expression\TestExpression;
use WPML\Core\Twig_NodeInterface;
use function class_alias;

/**
 * Checks if a variable is defined in the current context.
 *
 *    {# defined works with variable names and variable attributes #}
 *    {% if foo is defined %}
 *        {# ... #}
 *    {% endif %}
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class DefinedTest extends TestExpression
{
    public function __construct(Twig_NodeInterface $node, $name, Twig_NodeInterface $arguments = null, $lineno)
    {
        if ($node instanceof NameExpression) {
            $node->setAttribute('is_defined_test', TRUE);
        } elseif ($node instanceof GetAttrExpression) {
            $node->setAttribute('is_defined_test', TRUE);
            $this->changeIgnoreStrictCheck($node);
        } elseif ($node instanceof BlockReferenceExpression) {
            $node->setAttribute('is_defined_test', TRUE);
        } elseif ($node instanceof FunctionExpression && 'constant' === $node->getAttribute('name')) {
            $node->setAttribute('is_defined_test', TRUE);
        } elseif ($node instanceof ConstantExpression || $node instanceof ArrayExpression) {
            $node = new ConstantExpression(TRUE, $node->getTemplateLine());
        } else {
            throw new SyntaxError('The "defined" test only works with simple variables.', $lineno);
        }
        parent::__construct($node, $name, $arguments, $lineno);
    }
    protected function changeIgnoreStrictCheck(GetAttrExpression $node)
    {
        $node->setAttribute('ignore_strict_check', TRUE);
        if ($node->getNode('node') instanceof GetAttrExpression) {
            $this->changeIgnoreStrictCheck($node->getNode('node'));
        }
    }
    public function compile(Compiler $compiler)
    {
        $compiler->subcompile($this->getNode('node'));
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\Test\\DefinedTest', 'WPML\\Core\\Twig_Node_Expression_Test_Defined');
