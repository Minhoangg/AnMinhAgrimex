<?php

namespace WPML\Core;

use WPML\Core\Twig\NodeVisitor\SandboxNodeVisitor;
use function class_exists;

class_exists('WPML\\Core\\Twig\\NodeVisitor\\SandboxNodeVisitor');
if (FALSE) {
    class Twig_NodeVisitor_Sandbox extends SandboxNodeVisitor
    {
    }
}
