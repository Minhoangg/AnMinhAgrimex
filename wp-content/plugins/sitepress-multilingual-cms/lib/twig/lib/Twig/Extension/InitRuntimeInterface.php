<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\InitRuntimeInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\InitRuntimeInterface');
if (FALSE) {
    class Twig_Extension_InitRuntimeInterface extends InitRuntimeInterface
    {
    }
}
