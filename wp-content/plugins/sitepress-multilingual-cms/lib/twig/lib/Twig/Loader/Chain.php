<?php

namespace WPML\Core;

use WPML\Core\Twig\Loader\ChainLoader;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Loader\\ChainLoader');
if (FALSE) {
    class Twig_Loader_Chain extends ChainLoader
    {
    }
}
