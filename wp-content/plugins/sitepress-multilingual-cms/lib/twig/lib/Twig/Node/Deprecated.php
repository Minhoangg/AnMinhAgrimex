<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\DeprecatedNode;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\DeprecatedNode');
if (FALSE) {
    class Twig_Node_Deprecated extends DeprecatedNode
    {
    }
}
