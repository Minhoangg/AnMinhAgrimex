<?php

namespace WPML\Core;

use WPML\Core\Twig\RuntimeLoader\ContainerRuntimeLoader;
use function class_exists;

class_exists('WPML\\Core\\Twig\\RuntimeLoader\\ContainerRuntimeLoader');
if (FALSE) {
    class Twig_ContainerRuntimeLoader extends ContainerRuntimeLoader
    {
    }
}
