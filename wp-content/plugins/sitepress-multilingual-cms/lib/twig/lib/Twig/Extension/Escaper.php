<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\EscaperExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\EscaperExtension');
if (FALSE) {
    class Twig_Extension_Escaper extends EscaperExtension
    {
    }
}
