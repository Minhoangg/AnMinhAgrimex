<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\FlushNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\FlushNode');
if (FALSE) {
    class Twig_Node_Flush extends FlushNode
    {
    }
}
