<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig;

use WPML\Core\Twig\Node\Node;
use function array_merge;
use function call_user_func;
use function class_alias;
use function class_exists;

/**
 * Represents a template function.
 *
 * @final
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class TwigFunction
{
    protected $name;
    protected $callable;
    protected $options;
    protected $arguments = [];
    public function __construct($name, $callable, array $options = [])
    {
        $this->name = $name;
        $this->callable = $callable;
        $this->options = array_merge(['needs_environment' => FALSE, 'needs_context' => FALSE, 'is_variadic' => FALSE, 'is_safe' => null, 'is_safe_callback' => null, 'node_class' => '\\WPML\\Core\\Twig\\Node\\Expression\\FunctionExpression', 'deprecated' => FALSE, 'alternative' => null], $options);
    }
    public function getName()
    {
        return $this->name;
    }
    public function getCallable()
    {
        return $this->callable;
    }
    public function getNodeClass()
    {
        return $this->options['node_class'];
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
    public function getSafe(Node $functionArgs)
    {
        if (null !== $this->options['is_safe']) {
            return $this->options['is_safe'];
        }
        if (null !== $this->options['is_safe_callback']) {
            return call_user_func($this->options['is_safe_callback'], $functionArgs);
        }
        return [];
    }
    public function isVariadic()
    {
        return $this->options['is_variadic'];
    }
    public function isDeprecated()
    {
        return (bool) $this->options['deprecated'];
    }
    public function getDeprecatedVersion()
    {
        return $this->options['deprecated'];
    }
    public function getAlternative()
    {
        return $this->options['alternative'];
    }
}
class_alias('WPML\\Core\\Twig\\TwigFunction', 'WPML\\Core\\Twig_SimpleFunction');
// Ensure that the aliased name is loaded to keep BC for classes implementing the typehint with the old aliased name.
class_exists('WPML\\Core\\Twig\\Node\\Node');
