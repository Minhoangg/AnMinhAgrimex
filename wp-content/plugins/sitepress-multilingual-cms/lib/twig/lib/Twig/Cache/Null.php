<?php

namespace WPML\Core;

use WPML\Core\Twig\Cache\NullCache;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Cache\\NullCache');
if (FALSE) {
    class Twig_Cache_Null extends NullCache
    {
    }
}
