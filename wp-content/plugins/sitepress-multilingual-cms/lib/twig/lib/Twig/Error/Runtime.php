<?php

namespace WPML\Core;

use WPML\Core\Twig\Error\RuntimeError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Error\\RuntimeError');
if (FALSE) {
    class Twig_Error_Runtime extends RuntimeError
    {
    }
}
