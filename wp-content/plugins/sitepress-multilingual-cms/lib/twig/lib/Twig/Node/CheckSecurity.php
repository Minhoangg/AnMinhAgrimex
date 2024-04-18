<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\CheckSecurityNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\CheckSecurityNode');
if (FALSE) {
    class Twig_Node_CheckSecurity extends CheckSecurityNode
    {
    }
}
