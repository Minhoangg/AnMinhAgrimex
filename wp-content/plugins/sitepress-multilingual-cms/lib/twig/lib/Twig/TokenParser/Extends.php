<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\ExtendsTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\ExtendsTokenParser');
if (FALSE) {
    class Twig_TokenParser_Extends extends ExtendsTokenParser
    {
    }
}
