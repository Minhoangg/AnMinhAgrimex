<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\MacroTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\MacroTokenParser');
if (FALSE) {
    class Twig_TokenParser_Macro extends MacroTokenParser
    {
    }
}
