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
use function class_alias;
use function sprintf;

/**
 * Represents a block call node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class BlockReferenceNode extends Node implements NodeOutputInterface
{
    public function __construct($name, $lineno, $tag = null)
    {
        parent::__construct([], ['name' => $name], $lineno, $tag);
    }
    public function compile(Compiler $compiler)
    {
        $compiler->addDebugInfo($this)->write(sprintf("\$this->displayBlock('%s', \$context, \$blocks);\n", $this->getAttribute('name')));
    }
}
class_alias('WPML\\Core\\Twig\\Node\\BlockReferenceNode', 'WPML\\Core\\Twig_Node_BlockReference');
