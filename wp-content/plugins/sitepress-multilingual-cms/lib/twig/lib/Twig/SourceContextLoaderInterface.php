<?php

namespace WPML\Core;

use WPML\Core\Twig\Loader\SourceContextLoaderInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Loader\\SourceContextLoaderInterface');
if (FALSE) {
    class Twig_SourceContextLoaderInterface extends SourceContextLoaderInterface
    {
    }
}
