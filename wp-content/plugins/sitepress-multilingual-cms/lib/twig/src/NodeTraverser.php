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

use WPML\Core\Twig\NodeVisitor\NodeVisitorInterface;
use WPML\Core\Twig_NodeInterface;
use function class_alias;
use function ksort;

/**
 * A node traverser.
 *
 * It visits all nodes and their children and calls the given visitor for each.
 *
 * @final
 *
 * @author Fabien Potencier <fabien@symfony.com>
 */
class NodeTraverser
{
    protected $env;
    protected $visitors = [];
    /**
     * @param NodeVisitorInterface[] $visitors
     */
    public function __construct(Environment $env, array $visitors = [])
    {
        $this->env = $env;
        foreach ($visitors as $visitor) {
            $this->addVisitor($visitor);
        }
    }
    public function addVisitor(NodeVisitorInterface $visitor)
    {
        $this->visitors[$visitor->getPriority()][] = $visitor;
    }
    /**
     * Traverses a node and calls the registered visitors.
     *
     * @return \Twig_NodeInterface
     */
    public function traverse(Twig_NodeInterface $node)
    {
        ksort($this->visitors);
        foreach ($this->visitors as $visitors) {
            foreach ($visitors as $visitor) {
                $node = $this->traverseForVisitor($visitor, $node);
            }
        }
        return $node;
    }
    protected function traverseForVisitor(NodeVisitorInterface $visitor, Twig_NodeInterface $node = null)
    {
        if (null === $node) {
            return;
        }
        $node = $visitor->enterNode($node, $this->env);
        foreach ($node as $k => $n) {
            if (null === $n) {
                continue;
            }
            if (FALSE !== ($m = $this->traverseForVisitor($visitor, $n)) && null !== $m) {
                if ($m !== $n) {
                    $node->setNode($k, $m);
                }
            } else {
                $node->removeNode($k);
            }
        }
        return $visitor->leaveNode($node, $this->env);
    }
}
class_alias('WPML\\Core\\Twig\\NodeTraverser', 'WPML\\Core\\Twig_NodeTraverser');
