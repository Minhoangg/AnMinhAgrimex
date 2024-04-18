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
namespace WPML\Core\Twig\Node;

use WPML\Core\Twig\Compiler;
use WPML\Core\Twig_NodeInterface;
use function class_alias;
use function sprintf;

/**
 * Represents a block node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class BlockNode extends Node
{
    public function __construct($name, Twig_NodeInterface $body, $lineno, $tag = null)
    {
        parent::__construct(['body' => $body], ['name' => $name], $lineno, $tag);
    }
    public function compile(Compiler $compiler)
    {
        $compiler->addDebugInfo($this)->write(sprintf("public function block_%s(\$context, array \$blocks = [])\n", $this->getAttribute('name')), "{\n")->indent();
        $compiler->subcompile($this->getNode('body'))->outdent()->write("}\n\n");
    }
}
class_alias('WPML\\Core\\Twig\\Node\\BlockNode', 'WPML\\Core\\Twig_Node_Block');
