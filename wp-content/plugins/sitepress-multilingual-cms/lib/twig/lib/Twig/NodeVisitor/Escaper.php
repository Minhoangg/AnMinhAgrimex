<?php

namespace WPML\Core;

use WPML\Core\Twig\NodeVisitor\EscaperNodeVisitor;
use function class_exists;

class_exists('WPML\\Core\\Twig\\NodeVisitor\\EscaperNodeVisitor');
if (FALSE) {
    class Twig_NodeVisitor_Escaper extends EscaperNodeVisitor
    {
    }
}
