<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\IncludeTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\IncludeTokenParser');
if (FALSE) {
    class Twig_TokenParser_Include extends IncludeTokenParser
    {
    }
}
