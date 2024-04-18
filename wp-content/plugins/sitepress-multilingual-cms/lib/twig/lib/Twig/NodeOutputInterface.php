<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\NodeOutputInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\NodeOutputInterface');
if (FALSE) {
    class Twig_NodeOutputInterface extends NodeOutputInterface
    {
    }
}
