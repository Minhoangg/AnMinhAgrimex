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

use WPML\Core\PHPUnit\Framework\TestCase;
use WPML\Core\Twig\Compiler;
use WPML\Core\Twig\Environment;
use WPML\Core\Twig\Loader\ArrayLoader;
use WPML\Core\Twig\Node\Node;
use function class_alias;
use function function_exists;
use function sprintf;
use function trim;
use const PHP_VERSION_ID;

abstract class NodeTestCase extends TestCase
{
    public abstract function getTests();
    /**
     * @dataProvider getTests
     */
    public function testCompile($node, $source, $environment = null, $isPattern = FALSE)
    {
        $this->assertNodeCompilation($source, $node, $environment, $isPattern);
    }
    public function assertNodeCompilation($source, Node $node, Environment $environment = null, $isPattern = FALSE)
    {
        $compiler = $this->getCompiler($environment);
        $compiler->compile($node);
        if ($isPattern) {
            $this->assertStringMatchesFormat($source, trim($compiler->getSource()));
        } else {
            $this->assertEquals($source, trim($compiler->getSource()));
        }
    }
    protected function getCompiler(Environment $environment = null)
    {
        return new Compiler(null === $environment ? $this->getEnvironment() : $environment);
    }
    protected function getEnvironment()
    {
        return new Environment(new ArrayLoader([]));
    }
    protected function getVariableGetter($name, $line = FALSE)
    {
        $line = $line > 0 ? "// line {$line}\n" : '';
        if (PHP_VERSION_ID >= 70000) {
            return sprintf('%s($context["%s"] ?? null)', $line, $name);
        }
        if (PHP_VERSION_ID >= 50400) {
            return sprintf('%s(isset($context["%s"]) ? $context["%s"] : null)', $line, $name, $name);
        }
        return sprintf('%s$this->getContext($context, "%s")', $line, $name);
    }
    protected function getAttributeGetter()
    {
        if (function_exists('WPML\\Core\\twig_template_get_attributes')) {
            return 'twig_template_get_attributes($this, ';
        }
        return '$this->getAttribute(';
    }
}
class_alias('WPML\\Core\\Twig\\Test\\NodeTestCase', 'WPML\\Core\\Twig_Test_NodeTestCase');
