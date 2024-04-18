<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\TokenParserInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\TokenParserInterface');
if (FALSE) {
    class Twig_TokenParserInterface extends TokenParserInterface
    {
    }
}
