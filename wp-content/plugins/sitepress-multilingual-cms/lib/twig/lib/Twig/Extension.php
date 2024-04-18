<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\AbstractExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\AbstractExtension');
if (FALSE) {
    class Twig_Extension extends AbstractExtension
    {
    }
}
