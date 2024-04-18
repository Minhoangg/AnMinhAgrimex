<?php

namespace WPML\Core;

use WPML\Core\Twig\Profiler\Dumper\BlackfireDumper;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Profiler\\Dumper\\BlackfireDumper');
if (FALSE) {
    class Twig_Profiler_Dumper_Blackfire extends BlackfireDumper
    {
    }
}
