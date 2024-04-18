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

use function class_alias;

/**
 * Represents a body node.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class BodyNode extends Node
{
}
class_alias('WPML\\Core\\Twig\\Node\\BodyNode', 'WPML\\Core\\Twig_Node_Body');
