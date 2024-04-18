<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\DebugExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\DebugExtension');
if (FALSE) {
    class Twig_Extension_Debug extends DebugExtension
    {
    }
}
