<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\ProfilerExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\ProfilerExtension');
if (FALSE) {
    class Twig_Extension_Profiler extends ProfilerExtension
    {
    }
}
