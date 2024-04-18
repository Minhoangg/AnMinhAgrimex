<?php

namespace WPML\Core;

use WPML\Core\Twig\Error\SyntaxError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Error\\SyntaxError');
if (FALSE) {
    class Twig_Error_Syntax extends SyntaxError
    {
    }
}
