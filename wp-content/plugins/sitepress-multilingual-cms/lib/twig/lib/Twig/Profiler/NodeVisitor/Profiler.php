<?php

namespace WPML\Core;

use WPML\Core\Twig\Profiler\NodeVisitor\ProfilerNodeVisitor;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Profiler\\NodeVisitor\\ProfilerNodeVisitor');
if (FALSE) {
    class Twig_Profiler_NodeVisitor_Profiler extends ProfilerNodeVisitor
    {
    }
}
