<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\TextNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\TextNode');
if (FALSE) {
    class Twig_Node_Text extends TextNode
    {
    }
}
