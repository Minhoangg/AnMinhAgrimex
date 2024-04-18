<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Extension;

use function class_alias;

/**
 * Enables usage of the deprecated Twig\Extension\AbstractExtension::initRuntime() method.
 *
 * Explicitly implement this interface if you really need to implement the
 * deprecated initRuntime() method in your extensions.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
interface InitRuntimeInterface
{
}
class_alias('WPML\\Core\\Twig\\Extension\\InitRuntimeInterface', 'WPML\\Core\\Twig_Extension_InitRuntimeInterface');
