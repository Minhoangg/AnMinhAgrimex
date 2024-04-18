<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\SandboxedPrintNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\SandboxedPrintNode');
if (FALSE) {
    class Twig_Node_SandboxedPrint extends SandboxedPrintNode
    {
    }
}
