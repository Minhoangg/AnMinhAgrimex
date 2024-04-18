<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Node\Expression\Binary;

use WPML\Core\Twig\Compiler;
use function class_alias;

class GreaterBinary extends AbstractBinary
{
    public function operator(Compiler $compiler)
    {
        return $compiler->raw('>');
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\Binary\\GreaterBinary', 'WPML\\Core\\Twig_Node_Expression_Binary_Greater');
