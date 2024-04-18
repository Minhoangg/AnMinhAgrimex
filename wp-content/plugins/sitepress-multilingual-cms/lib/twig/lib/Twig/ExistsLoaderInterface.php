<?php

namespace WPML\Core;

use WPML\Core\Twig\Loader\ExistsLoaderInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Loader\\ExistsLoaderInterface');
if (FALSE) {
    class Twig_ExistsLoaderInterface extends ExistsLoaderInterface
    {
    }
}
