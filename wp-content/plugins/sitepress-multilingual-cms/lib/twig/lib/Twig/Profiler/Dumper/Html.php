<?php

namespace WPML\Core;

use WPML\Core\Twig\Profiler\Dumper\HtmlDumper;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Profiler\\Dumper\\HtmlDumper');
if (FALSE) {
    class Twig_Profiler_Dumper_Html extends HtmlDumper
    {
    }
}
