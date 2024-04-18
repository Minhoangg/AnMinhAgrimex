<?php

namespace WPML\Core;

use WPML\Core\Twig\Error\Error;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Error\\Error');
if (FALSE) {
    class Twig_Error extends Error
    {
    }
}
