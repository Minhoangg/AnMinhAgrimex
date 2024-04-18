<?php

namespace WPML\Core;

use WPML\Core\Twig\Loader\LoaderInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Loader\\LoaderInterface');
if (FALSE) {
	interface Twig_LoaderInterface extends LoaderInterface
    {
    }
}
