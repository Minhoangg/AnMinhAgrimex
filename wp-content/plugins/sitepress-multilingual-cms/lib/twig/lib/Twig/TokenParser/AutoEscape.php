<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\AutoEscapeTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\AutoEscapeTokenParser');
if (FALSE) {
    class Twig_TokenParser_AutoEscape extends AutoEscapeTokenParser
    {
    }
}
