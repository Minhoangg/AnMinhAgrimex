<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityNotAllowedMethodError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityNotAllowedMethodError');
if (FALSE) {
    class Twig_Sandbox_SecurityNotAllowedMethodError extends SecurityNotAllowedMethodError
    {
    }
}
