<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\UseTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\UseTokenParser');
if (FALSE) {
    class Twig_TokenParser_Use extends UseTokenParser
    {
    }
}
