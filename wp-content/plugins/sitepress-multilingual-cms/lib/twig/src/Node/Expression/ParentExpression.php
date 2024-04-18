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

/**
 * Represents a parent node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class ParentExpression extends AbstractExpression
{
    public function __construct($name, $lineno, $tag = null)
    {
        parent::__construct([], ['output' => FALSE, 'name' => $name], $lineno, $tag);
    }
    public function compile(Compiler $compiler)
    {
        if ($this->getAttribute('output')) {
            $compiler->addDebugInfo($this)->write('$this->displayParentBlock(')->string($this->getAttribute('name'))->raw(", \$context, \$blocks);\n");
        } else {
            $compiler->raw('$this->renderParentBlock(')->string($this->getAttribute('name'))->raw(', $context, $blocks)');
        }
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\ParentExpression', 'WPML\\Core\\Twig_Node_Expression_Parent');
