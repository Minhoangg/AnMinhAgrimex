<?php

namespace WPML\Core;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use function array_merge;
use function trigger_error;
use const E_USER_DEPRECATED;

@trigger_error('The Twig_Test class is deprecated since version 1.12 and will be removed in 2.0. Use \\Twig\\TwigTest instead.', E_USER_DEPRECATED);
/**
 * Represents a template test.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
abstract class Twig_Test implements Twig_TestInterface, Twig_TestCallableInterface
{
    protected $options;
    protected $arguments = [];
    public function __construct(array $options = [])
    {
        $this->options = array_merge(['callable' => null], $options);
    }
    public function getCallable()
    {
        return $this->options['callable'];
    }
}
