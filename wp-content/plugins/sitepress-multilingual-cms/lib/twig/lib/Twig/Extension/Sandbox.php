<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\SandboxExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\SandboxExtension');
if (FALSE) {
    class Twig_Extension_Sandbox extends SandboxExtension
    {
    }
}
