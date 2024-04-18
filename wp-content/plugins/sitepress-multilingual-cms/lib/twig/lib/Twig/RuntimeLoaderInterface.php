<?php

namespace WPML\Core;

use WPML\Core\Twig\RuntimeLoader\RuntimeLoaderInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\RuntimeLoader\\RuntimeLoaderInterface');
if (FALSE) {
    class Twig_RuntimeLoaderInterface extends RuntimeLoaderInterface
    {
    }
}
