<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityNotAllowedPropertyError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityNotAllowedPropertyError');
if (FALSE) {
    class Twig_Sandbox_SecurityNotAllowedPropertyError extends SecurityNotAllowedPropertyError
    {
    }
}
