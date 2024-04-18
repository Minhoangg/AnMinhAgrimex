<?php

namespace WPML\Core;

use WPML\Core\Twig\Environment;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Environment');
if (FALSE) {
    class Twig_Environment extends Environment
    {
    }
}
