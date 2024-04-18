<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\AutoEscapeNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\AutoEscapeNode');
if (FALSE) {
    class Twig_Node_AutoEscape extends AutoEscapeNode
    {
    }
}
