<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityNotAllowedTagError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityNotAllowedTagError');
if (FALSE) {
    class Twig_Sandbox_SecurityNotAllowedTagError extends SecurityNotAllowedTagError
    {
    }
}
