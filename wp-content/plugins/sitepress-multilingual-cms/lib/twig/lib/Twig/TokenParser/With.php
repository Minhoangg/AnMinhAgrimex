<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\WithTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\WithTokenParser');
if (FALSE) {
    class Twig_TokenParser_With extends WithTokenParser
    {
    }
}
