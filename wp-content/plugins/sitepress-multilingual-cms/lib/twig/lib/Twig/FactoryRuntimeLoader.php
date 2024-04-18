<?php

namespace WPML\Core;

use WPML\Core\Twig\RuntimeLoader\FactoryRuntimeLoader;
use function class_exists;

class_exists('WPML\\Core\\Twig\\RuntimeLoader\\FactoryRuntimeLoader');
if (FALSE) {
    class Twig_FactoryRuntimeLoader extends FactoryRuntimeLoader
    {
    }
}
