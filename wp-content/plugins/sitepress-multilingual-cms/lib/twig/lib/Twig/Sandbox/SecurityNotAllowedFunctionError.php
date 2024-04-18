<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityNotAllowedFunctionError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityNotAllowedFunctionError');
if (FALSE) {
    class Twig_Sandbox_SecurityNotAllowedFunctionError extends SecurityNotAllowedFunctionError
    {
    }
}
