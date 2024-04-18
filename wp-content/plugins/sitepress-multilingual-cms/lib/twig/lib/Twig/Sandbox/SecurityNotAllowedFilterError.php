<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityNotAllowedFilterError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityNotAllowedFilterError');
if (FALSE) {
    class Twig_Sandbox_SecurityNotAllowedFilterError extends SecurityNotAllowedFilterError
    {
    }
}
