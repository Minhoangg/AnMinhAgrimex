<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\FilterTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\FilterTokenParser');
if (FALSE) {
    class Twig_TokenParser_Filter extends FilterTokenParser
    {
    }
}
