<?php

namespace WPML\Core;

use WPML\Core\Twig\Compiler;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Compiler');
if (FALSE) {
    class Twig_Compiler extends Compiler
    {
    }
}
