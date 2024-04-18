<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Test;

use Exception;
use InvalidArgumentException;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use ReflectionProperty;
use WPML\Core\PHPUnit\Framework\TestCase;
use WPML\Core\Twig\Environment;
use WPML\Core\Twig\Error\Error;
use WPML\Core\Twig\Extension\ExtensionInterface;
use WPML\Core\Twig\Loader\ArrayLoader;
use WPML\Core\Twig\Loader\SourceContextLoaderInterface;
use WPML\Core\Twig\RuntimeLoader\RuntimeLoaderInterface;
use WPML\Core\Twig\Source;
use WPML\Core\Twig\TwigFilter;
use WPML\Core\Twig\TwigFunction;
use WPML\Core\Twig\TwigTest;
use function array_keys;
use function array_merge;
use function class_alias;
use function class_exists;
use function explode;
use function file_get_contents;
use function get_class;
use function hash;
use function mt_rand;
use function preg_match;
use function preg_match_all;
use function printf;
use function realpath;
use function sprintf;
use function str_replace;
use function strlen;
use function strpos;
use function substr;
use function trim;
use function uniqid;
use const PREG_SET_ORDER;

/**
 * Integration test helper.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author Karma Dordrak <drak@zikula.org>
 */
abstract class IntegrationTestCase extends TestCase
{
    /**
     * @return string
     */
    protected abstract function getFixturesDir();
    /**
     * @return RuntimeLoaderInterface[]
     */
    protected function getRuntimeLoaders()
    {
        return [];
    }
    /**
     * @return ExtensionInterface[]
     */
    protected function getExtensions()
    {
        return [];
    }
    /**
     * @return TwigFilter[]
     */
    protected function getTwigFilters()
    {
        return [];
    }
    /**
     * @return TwigFunction[]
     */
    protected function getTwigFunctions()
    {
        return [];
    }
    /**
     * @return TwigTest[]
     */
    protected function getTwigTests()
    {
        return [];
    }
    /**
     * @dataProvider getTests
     */
    public function testIntegration($file, $message, $condition, $templates, $exception, $outputs)
    {
        $this->doIntegrationTest($file, $message, $condition, $templates, $exception, $outputs);
    }
    /**
     * @dataProvider getLegacyTests
     * @group legacy
     */
    public function testLegacyIntegration($file, $message, $condition, $templates, $exception, $outputs)
    {
        $this->doIntegrationTest($file, $message, $condition, $templates, $exception, $outputs);
    }
    public function getTests($name, $legacyTests = FALSE)
    {
        $fixturesDir = realpath($this->getFixturesDir());
        $tests = [];
        foreach (new RecursiveIteratorIterator(new RecursiveDirectoryIterator($fixturesDir), RecursiveIteratorIterator::LEAVES_ONLY) as $file) {
            if (!preg_match('/\\.test$/', $file)) {
                continue;
            }
            if ($legacyTests xor FALSE !== strpos($file->getRealpath(), '.legacy.test')) {
                continue;
            }
            $test = file_get_contents($file->getRealpath());
            if (preg_match('/--TEST--\\s*(.*?)\\s*(?:--CONDITION--\\s*(.*))?\\s*((?:--TEMPLATE(?:\\(.*?\\))?--(?:.*?))+)\\s*(?:--DATA--\\s*(.*))?\\s*--EXCEPTION--\\s*(.*)/sx', $test, $match)) {
                $message = $match[1];
                $condition = $match[2];
                $templates = self::parseTemplates($match[3]);
                $exception = $match[5];
                $outputs = [[null, $match[4], null, '']];
            } elseif (preg_match('/--TEST--\\s*(.*?)\\s*(?:--CONDITION--\\s*(.*))?\\s*((?:--TEMPLATE(?:\\(.*?\\))?--(?:.*?))+)--DATA--.*?--EXPECT--.*/s', $test, $match)) {
                $message = $match[1];
                $condition = $match[2];
                $templates = self::parseTemplates($match[3]);
                $exception = FALSE;
                preg_match_all('/--DATA--(.*?)(?:--CONFIG--(.*?))?--EXPECT--(.*?)(?=\\-\\-DATA\\-\\-|$)/s', $test, $outputs, PREG_SET_ORDER);
            } else {
                throw new InvalidArgumentException(sprintf('Test "%s" is not valid.', str_replace($fixturesDir . '/', '', $file)));
            }
            $tests[] = [str_replace($fixturesDir . '/', '', $file), $message, $condition, $templates, $exception, $outputs];
        }
        if ($legacyTests && empty($tests)) {
            // add a dummy test to avoid a PHPUnit message
            return [['not', '-', '', [], '', []]];
        }
        return $tests;
    }
    public function getLegacyTests()
    {
        return $this->getTests('testLegacyIntegration', TRUE);
    }
    protected function doIntegrationTest($file, $message, $condition, $templates, $exception, $outputs)
    {
        if (!$outputs) {
            $this->markTestSkipped('no tests to run');
        }
        if ($condition) {
            eval('$ret = ' . $condition . ';');
            if (!$ret) {
                $this->markTestSkipped($condition);
            }
        }
        $loader = new ArrayLoader($templates);
        foreach ($outputs as $i => $match) {
            $config = array_merge(['cache' => FALSE, 'strict_variables' => TRUE], $match[2] ? eval($match[2] . ';') : []);
            $twig = new Environment($loader, $config);
            $twig->addGlobal('global', 'global');
            foreach ($this->getRuntimeLoaders() as $runtimeLoader) {
                $twig->addRuntimeLoader($runtimeLoader);
            }
            foreach ($this->getExtensions() as $extension) {
                $twig->addExtension($extension);
            }
            foreach ($this->getTwigFilters() as $filter) {
                $twig->addFilter($filter);
            }
            foreach ($this->getTwigTests() as $test) {
                $twig->addTest($test);
            }
            foreach ($this->getTwigFunctions() as $function) {
                $twig->addFunction($function);
            }
            $p = new ReflectionProperty($twig, 'templateClassPrefix');
            $p->setAccessible(TRUE);
            $p->setValue($twig, '\\WPML\\Core\\__TwigTemplate_' . hash('sha256', uniqid(mt_rand(),
                    TRUE),
                    FALSE) . '_');
            try {
                $template = $twig->load('index.twig');
            } catch (Exception $e) {
                if (FALSE !== $exception) {
                    $message = $e->getMessage();
                    $this->assertSame(trim($exception), trim(sprintf('%s: %s', get_class($e), $message)));
                    $last = substr($message, strlen($message) - 1);
                    $this->assertTrue('.' === $last || '?' === $last, 'Exception message must end with a dot or a question mark.');
                    return;
                }
                throw new Error(sprintf('%s: %s', get_class($e), $e->getMessage()), -1, null, $e);
            }
            try {
                $output = trim($template->render(eval($match[1] . ';')), "\n ");
            } catch (Exception $e) {
                if (FALSE !== $exception) {
                    $this->assertSame(trim($exception), trim(sprintf('%s: %s', get_class($e), $e->getMessage())));
                    return;
                }
                $e = new Error(sprintf('%s: %s', get_class($e), $e->getMessage()), -1, null, $e);
                $output = trim(sprintf('%s: %s', get_class($e), $e->getMessage()));
            }
            if (FALSE !== $exception) {
                [$class] = explode(':', $exception);
                $constraintClass = class_exists('WPML\\Core\\PHPUnit\\Framework\\Constraint\\Exception') ? 'PHPUnit\\Framework\\Constraint\\Exception' : 'PHPUnit_Framework_Constraint_Exception';
                $this->assertThat(null, new $constraintClass($class));
            }
            $expected = trim($match[3], "\n ");
            if ($expected !== $output) {
                printf("Compiled templates that failed on case %d:\n", $i + 1);
                foreach (array_keys($templates) as $name) {
                    echo "Template: {$name}\n";
                    $loader = $twig->getLoader();
                    if (!$loader instanceof SourceContextLoaderInterface) {
                        $source = new Source($loader->getSource($name), $name);
                    } else {
                        $source = $loader->getSourceContext($name);
                    }
                    echo $twig->compile($twig->parse($twig->tokenize($source)));
                }
            }
            $this->assertEquals($expected, $output, $message . ' (in ' . $file . ')');
        }
    }
    protected static function parseTemplates($test)
    {
        $templates = [];
        preg_match_all('/--TEMPLATE(?:\\((.*?)\\))?--(.*?)(?=\\-\\-TEMPLATE|$)/s', $test, $matches, PREG_SET_ORDER);
        foreach ($matches as $match) {
            $templates[$match[1] ? $match[1] : 'index.twig'] = $match[2];
        }
        return $templates;
    }
}
class_alias('WPML\\Core\\Twig\\Test\\IntegrationTestCase', 'WPML\\Core\\Twig_Test_IntegrationTestCase');
