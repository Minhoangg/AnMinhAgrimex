<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\DeprecatedTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\DeprecatedTokenParser');
if (FALSE) {
    class Twig_TokenParser_Deprecated extends DeprecatedTokenParser
    {
    }
}
