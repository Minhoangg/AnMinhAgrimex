<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Node;

use WPML\Core\Twig\Compiler;
use WPML\Core\Twig_NodeInterface;
use function class_alias;

/**
 * Represents a spaceless node.
 *
 * It removes spaces between HTML tags.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class SpacelessNode extends Node
{
    public function __construct(Twig_NodeInterface $body, $lineno, $tag = 'spaceless')
    {
        parent::__construct(['body' => $body], [], $lineno, $tag);
    }
    public function compile(Compiler $compiler)
    {
        $compiler->addDebugInfo($this);
        if ($compiler->getEnvironment()->isDebug()) {
            $compiler->write("ob_start();\n");
        } else {
            $compiler->write("ob_start(function () { return ''; });\n");
        }
        $compiler->subcompile($this->getNode('body'))->write("echo trim(preg_replace('/>\\s+</', '><', ob_get_clean()));\n");
    }
}
class_alias('WPML\\Core\\Twig\\Node\\SpacelessNode', 'WPML\\Core\\Twig_Node_Spaceless');
