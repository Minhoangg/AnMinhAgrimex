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

class MatchesBinary extends AbstractBinary
{
    public function compile(Compiler $compiler)
    {
        $compiler->raw('preg_match(')->subcompile($this->getNode('right'))->raw(', ')->subcompile($this->getNode('left'))->raw(')');
    }
    public function operator(Compiler $compiler)
    {
        return $compiler->raw('');
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\Binary\\MatchesBinary', 'WPML\\Core\\Twig_Node_Expression_Binary_Matches');
