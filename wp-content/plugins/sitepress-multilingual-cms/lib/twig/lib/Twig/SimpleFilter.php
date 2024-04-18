<?php

namespace WPML\Core;

use WPML\Core\Twig\TwigFilter;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TwigFilter');
if (FALSE) {
    class Twig_SimpleFilter extends TwigFilter
    {
    }
}
