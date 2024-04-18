<?php

namespace WPML\Core;

use WPML\Core\Twig\NodeVisitor\AbstractNodeVisitor;
use function class_exists;

class_exists('WPML\\Core\\Twig\\NodeVisitor\\AbstractNodeVisitor');
if (FALSE) {
    class Twig_BaseNodeVisitor extends AbstractNodeVisitor
    {
    }
}
