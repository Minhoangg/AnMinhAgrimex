<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\CoreExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\CoreExtension');
if (FALSE) {
    class Twig_Extension_Core extends CoreExtension
    {
    }
}
