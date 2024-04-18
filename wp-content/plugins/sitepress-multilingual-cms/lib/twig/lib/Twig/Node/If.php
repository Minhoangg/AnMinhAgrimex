<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\IfNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\IfNode');
if (FALSE) {
    class Twig_Node_If extends IfNode
    {
    }
}
