<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Node\Expression;

use WPML\Core\Twig\Compiler;
use function class_alias;

class MethodCallExpression extends AbstractExpression
{
    public function __construct(AbstractExpression $node, $method, ArrayExpression $arguments, $lineno)
    {
        parent::__construct(['node' => $node, 'arguments' => $arguments], ['method' => $method, 'safe' => FALSE], $lineno);
        if ($node instanceof NameExpression) {
            $node->setAttribute('always_defined', TRUE);
        }
    }
    public function compile(Compiler $compiler)
    {
        $compiler->subcompile($this->getNode('node'))->raw('->')->raw($this->getAttribute('method'))->raw('(');
        $first = TRUE;
        foreach ($this->getNode('arguments')->getKeyValuePairs() as $pair) {
            if (!$first) {
                $compiler->raw(', ');
            }
            $first = FALSE;
            $compiler->subcompile($pair['value']);
        }
        $compiler->raw(')');
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\MethodCallExpression', 'WPML\\Core\\Twig_Node_Expression_MethodCall');
