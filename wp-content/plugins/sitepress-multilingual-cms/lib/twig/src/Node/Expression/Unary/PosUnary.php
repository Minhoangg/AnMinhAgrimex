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
namespace WPML\Core\Twig\Node\Expression\Unary;

use WPML\Core\Twig\Compiler;
use function class_alias;

class PosUnary extends AbstractUnary
{
    public function operator(Compiler $compiler)
    {
        $compiler->raw('+');
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\Unary\\PosUnary', 'WPML\\Core\\Twig_Node_Expression_Unary_Pos');
