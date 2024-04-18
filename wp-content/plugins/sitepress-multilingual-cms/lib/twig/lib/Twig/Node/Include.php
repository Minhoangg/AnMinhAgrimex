<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\IncludeNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\IncludeNode');
if (FALSE) {
    class Twig_Node_Include extends IncludeNode
    {
    }
}
