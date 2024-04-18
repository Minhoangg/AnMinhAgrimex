<?php

namespace WPML\Core;

use WPML\Core\Twig\NodeVisitor\NodeVisitorInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\NodeVisitor\\NodeVisitorInterface');
if (FALSE) {
    class Twig_NodeVisitorInterface extends NodeVisitorInterface
    {
    }
}
