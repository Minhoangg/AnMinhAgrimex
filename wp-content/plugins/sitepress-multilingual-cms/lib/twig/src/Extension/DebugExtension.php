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

use WPML\Core\Twig\TwigFunction;
use function class_alias;
use function extension_loaded;
use function ini_get;
use const PHP_SAPI;

/**
 * @final
 */
class DebugExtension extends AbstractExtension
{
    public function getFunctions()
    {
        // dump is safe if var_dump is overridden by xdebug
        $isDumpOutputHtmlSafe = extension_loaded('xdebug') && (FALSE === ini_get('xdebug.overload_var_dump') || ini_get('xdebug.overload_var_dump')) && (FALSE === ini_get('html_errors') || ini_get('html_errors')) || 'cli' === PHP_SAPI;
        return [new TwigFunction('dump', '\WPML\Core\twig_var_dump', ['is_safe' => $isDumpOutputHtmlSafe ? ['html'] : [], 'needs_context' => TRUE, 'needs_environment' => TRUE, 'is_variadic' => TRUE])];
    }
    public function getName()
    {
        return 'debug';
    }
}
class_alias('WPML\\Core\\Twig\\Extension\\DebugExtension', 'WPML\\Core\\Twig_Extension_Debug');
namespace WPML\Core;

use WPML\Core\Twig\Environment;
use WPML\Core\Twig\Template;
use WPML\Core\Twig\TemplateWrapper;
use function ob_get_clean;
use function ob_start;
use function var_dump;

function twig_var_dump(Environment $env, $context, array $vars = [])
{
    if (!$env->isDebug()) {
        return;
    }
    ob_start();
    if (!$vars) {
        $vars = [];
        foreach ($context as $key => $value) {
            if (!$value instanceof Template && !$value instanceof TemplateWrapper) {
                $vars[$key] = $value;
            }
        }
        var_dump($vars);
    } else {
        foreach ($vars as $var) {
            var_dump($var);
        }
    }
    return ob_get_clean();
}
