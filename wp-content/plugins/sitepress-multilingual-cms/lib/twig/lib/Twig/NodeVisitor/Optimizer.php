<?php

namespace WPML\Core;

use WPML\Core\Twig\NodeVisitor\OptimizerNodeVisitor;
use function class_exists;

class_exists('WPML\\Core\\Twig\\NodeVisitor\\OptimizerNodeVisitor');
if (FALSE) {
    class Twig_NodeVisitor_Optimizer extends OptimizerNodeVisitor
    {
    }
}
