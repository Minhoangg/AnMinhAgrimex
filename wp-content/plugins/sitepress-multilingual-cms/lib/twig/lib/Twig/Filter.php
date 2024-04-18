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
use WPML\Core\Twig\Node\Node;
use function array_merge;
use function call_user_func;
use function trigger_error;
use const E_USER_DEPRECATED;

@trigger_error('The Twig_Filter class is deprecated since version 1.12 and will be removed in 2.0. Use \\Twig\\TwigFilter instead.', E_USER_DEPRECATED);
/**
 * Represents a template filter.
 *
 * Use \Twig\TwigFilter instead.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
abstract class Twig_Filter implements Twig_FilterInterface, Twig_FilterCallableInterface
{
    protected $options;
    protected $arguments = [];
    public function __construct(array $options = [])
    {
        $this->options = array_merge(['needs_environment' => FALSE, 'needs_context' => FALSE, 'pre_escape' => null, 'preserves_safety' => null, 'callable' => null], $options);
    }
    public function setArguments($arguments)
    {
        $this->arguments = $arguments;
    }
    public function getArguments()
    {
        return $this->arguments;
    }
    public function needsEnvironment()
    {
        return $this->options['needs_environment'];
    }
    public function needsContext()
    {
        return $this->options['needs_context'];
    }
    public function getSafe(Node $filterArgs)
    {
        if (isset($this->options['is_safe'])) {
            return $this->options['is_safe'];
        }
        if (isset($this->options['is_safe_callback'])) {
            return call_user_func($this->options['is_safe_callback'], $filterArgs);
        }
    }
    public function getPreservesSafety()
    {
        return $this->options['preserves_safety'];
    }
    public function getPreEscape()
    {
        return $this->options['pre_escape'];
    }
    public function getCallable()
    {
        return $this->options['callable'];
    }
}
