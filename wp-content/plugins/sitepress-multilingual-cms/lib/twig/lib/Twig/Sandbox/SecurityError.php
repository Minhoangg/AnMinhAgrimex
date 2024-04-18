<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityError');
if (FALSE) {
    class Twig_Sandbox_SecurityError extends SecurityError
    {
    }
}
