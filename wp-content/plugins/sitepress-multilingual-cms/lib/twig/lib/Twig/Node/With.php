<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\WithNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\WithNode');
if (FALSE) {
    class Twig_Node_With extends WithNode
    {
    }
}
