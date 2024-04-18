<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\SandboxNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\SandboxNode');
if (FALSE) {
    class Twig_Node_Sandbox extends SandboxNode
    {
    }
}
