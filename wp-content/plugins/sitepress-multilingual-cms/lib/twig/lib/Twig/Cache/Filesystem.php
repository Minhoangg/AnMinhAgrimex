<?php

namespace WPML\Core;

use WPML\Core\Twig\Cache\FilesystemCache;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Cache\\FilesystemCache');
if (FALSE) {
    class Twig_Cache_Filesystem extends FilesystemCache
    {
    }
}
