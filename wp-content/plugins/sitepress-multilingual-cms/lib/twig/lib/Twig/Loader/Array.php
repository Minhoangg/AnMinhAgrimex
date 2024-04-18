<?php

namespace WPML\Core;

use WPML\Core\Twig\Loader\ArrayLoader;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Loader\\ArrayLoader');
if (FALSE) {
    class Twig_Loader_Array extends ArrayLoader
    {
    }
}
