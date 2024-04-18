<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\DoTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\DoTokenParser');
if (FALSE) {
    class Twig_TokenParser_Do extends DoTokenParser
    {
    }
}
