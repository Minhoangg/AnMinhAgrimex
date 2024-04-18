<?php

namespace WPML\Core;

use WPML\Core\Twig\NodeVisitor\SafeAnalysisNodeVisitor;
use function class_exists;

class_exists('WPML\\Core\\Twig\\NodeVisitor\\SafeAnalysisNodeVisitor');
if (FALSE) {
    class Twig_NodeVisitor_SafeAnalysis extends SafeAnalysisNodeVisitor
    {
    }
}
