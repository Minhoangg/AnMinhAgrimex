<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\StringLoaderExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\StringLoaderExtension');
if (FALSE) {
    class Twig_Extension_StringLoader extends StringLoaderExtension
    {
    }
}
