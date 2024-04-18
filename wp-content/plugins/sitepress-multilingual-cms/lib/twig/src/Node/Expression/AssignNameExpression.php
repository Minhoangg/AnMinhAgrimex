<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Node\Expression;

use WPML\Core\Twig\Compiler;
use function class_alias;

class AssignNameExpression extends NameExpression
{
    public function compile(Compiler $compiler)
    {
        $compiler->raw('$context[')->string($this->getAttribute('name'))->raw(']');
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\AssignNameExpression', 'WPML\\Core\\Twig_Node_Expression_AssignName');
