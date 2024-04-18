<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\IfTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\IfTokenParser');
if (FALSE) {
    class Twig_TokenParser_If extends IfTokenParser
    {
    }
}
