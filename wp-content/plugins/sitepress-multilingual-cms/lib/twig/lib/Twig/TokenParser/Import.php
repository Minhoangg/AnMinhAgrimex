<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\ImportTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\ImportTokenParser');
if (FALSE) {
    class Twig_TokenParser_Import extends ImportTokenParser
    {
    }
}
