<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\BlockTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\BlockTokenParser');
if (FALSE) {
    class Twig_TokenParser_Block extends BlockTokenParser
    {
    }
}
