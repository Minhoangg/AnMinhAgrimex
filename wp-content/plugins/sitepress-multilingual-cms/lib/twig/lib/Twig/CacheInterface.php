<?php

namespace WPML\Core;

use WPML\Core\Twig\Cache\CacheInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Cache\\CacheInterface');
if (FALSE) {
    class Twig_CacheInterface extends CacheInterface
    {
    }
}
