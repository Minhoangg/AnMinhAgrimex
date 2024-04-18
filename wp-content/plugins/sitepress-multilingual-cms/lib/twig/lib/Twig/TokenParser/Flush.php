<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\FlushTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\FlushTokenParser');
if (FALSE) {
    class Twig_TokenParser_Flush extends FlushTokenParser
    {
    }
}
