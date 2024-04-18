<?php

namespace WPML\Core;

use WPML\Core\Twig\Loader\FilesystemLoader;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Loader\\FilesystemLoader');
if (FALSE) {
    class Twig_Loader_Filesystem extends FilesystemLoader
    {
    }
}
