<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\ExtensionInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\ExtensionInterface');
if (FALSE) {
    class Twig_ExtensionInterface extends ExtensionInterface
    {
    }
}
