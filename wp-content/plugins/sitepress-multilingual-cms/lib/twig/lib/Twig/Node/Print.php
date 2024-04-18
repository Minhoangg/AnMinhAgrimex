<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\PrintNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\PrintNode');
if (FALSE) {
    class Twig_Node_Print extends PrintNode
    {
    }
}
