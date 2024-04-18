<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\EmbedTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\EmbedTokenParser');
if (FALSE) {
    class Twig_TokenParser_Embed extends EmbedTokenParser
    {
    }
}
