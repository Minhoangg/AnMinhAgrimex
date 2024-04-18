<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\FromTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\FromTokenParser');
if (FALSE) {
    class Twig_TokenParser_From extends FromTokenParser
    {
    }
}
