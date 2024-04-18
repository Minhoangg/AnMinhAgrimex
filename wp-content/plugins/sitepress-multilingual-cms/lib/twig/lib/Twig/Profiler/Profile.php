<?php

namespace WPML\Core;

use WPML\Core\Twig\Profiler\Profile;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Profiler\\Profile');
if (FALSE) {
    class Twig_Profiler_Profile extends Profile
    {
    }
}
