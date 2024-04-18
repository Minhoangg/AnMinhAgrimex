<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\OptimizerExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\OptimizerExtension');
if (FALSE) {
    class Twig_Extension_Optimizer extends OptimizerExtension
    {
    }
}
