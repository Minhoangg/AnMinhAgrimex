<?php

namespace WPML\Core;

use WPML\Core\Twig\Error\LoaderError;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Error\\LoaderError');
if (FALSE) {
    class Twig_Error_Loader extends LoaderError
    {
    }
}
