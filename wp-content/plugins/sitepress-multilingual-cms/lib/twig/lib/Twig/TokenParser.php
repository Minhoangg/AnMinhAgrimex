<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\AbstractTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\AbstractTokenParser');
if (FALSE) {
    class Twig_TokenParser extends AbstractTokenParser
    {
    }
}
