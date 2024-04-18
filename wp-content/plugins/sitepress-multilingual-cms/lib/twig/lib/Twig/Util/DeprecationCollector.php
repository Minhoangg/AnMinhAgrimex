<?php

namespace WPML\Core;

use WPML\Core\Twig\Util\DeprecationCollector;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Util\\DeprecationCollector');
if (FALSE) {
    class Twig_Util_DeprecationCollector extends DeprecationCollector
    {
    }
}
