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
use WPML\Core\Twig\Loader\ExistsLoaderInterface;
use WPML\Core\Twig\Loader\LoaderInterface;
use WPML\Core\Twig\Loader\SourceContextLoaderInterface;
use WPML\Core\Twig\Source;
use function get_class;
use function sprintf;
use function trigger_error;
use const E_USER_DEPRECATED;

@trigger_error('The Twig_Loader_String class is deprecated since version 1.18.1 and will be removed in 2.0. Use "Twig\\Loader\\ArrayLoader" instead or "Twig\\Environment::createTemplate()".', E_USER_DEPRECATED);
/**
 * Loads a template from a string.
 *
 * This loader should NEVER be used. It only exists for Twig internal purposes.
 *
 * When using this loader with a cache mechanism, you should know that a new cache
 * key is generated each time a template content "changes" (the cache key being the
 * source code of the template). If you don't want to see your cache grows out of
 * control, you need to take care of clearing the old cache file by yourself.
 *
 * @deprecated since 1.18.1 (to be removed in 2.0)
 *
 * @internal
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class Twig_Loader_String implements LoaderInterface, ExistsLoaderInterface, SourceContextLoaderInterface
{
    public function getSource($name)
    {
        @trigger_error(sprintf('Calling "getSource" on "%s" is deprecated since 1.27. Use getSourceContext() instead.', get_class($this)), E_USER_DEPRECATED);
        return $name;
    }
    public function getSourceContext($name)
    {
        return new Source($name, $name);
    }
    public function exists($name)
    {
        return TRUE;
    }
    public function getCacheKey($name)
    {
        return $name;
    }
    public function isFresh($name, $time)
    {
        return TRUE;
    }
}
