<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\GlobalsInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\GlobalsInterface');
if (FALSE) {
    class Twig_Extension_GlobalsInterface extends GlobalsInterface
    {
    }
}
