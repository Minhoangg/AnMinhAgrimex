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
namespace WPML\Core\Twig\Node\Expression\Binary;

use WPML\Core\Twig\Compiler;
use WPML\Core\Twig\Node\Expression\AbstractExpression;
use WPML\Core\Twig_NodeInterface;
use function class_alias;

abstract class AbstractBinary extends AbstractExpression
{
    public function __construct(Twig_NodeInterface $left, Twig_NodeInterface $right, $lineno)
    {
        parent::__construct(['left' => $left, 'right' => $right], [], $lineno);
    }
    public function compile(Compiler $compiler)
    {
        $compiler->raw('(')->subcompile($this->getNode('left'))->raw(' ');
        $this->operator($compiler);
        $compiler->raw(' ')->subcompile($this->getNode('right'))->raw(')');
    }
    public abstract function operator(Compiler $compiler);
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\Binary\\AbstractBinary', 'WPML\\Core\\Twig_Node_Expression_Binary');
