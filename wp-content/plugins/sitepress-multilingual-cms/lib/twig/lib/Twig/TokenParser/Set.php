<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\SetTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\SetTokenParser');
if (FALSE) {
    class Twig_TokenParser_Set extends SetTokenParser
    {
    }
}
