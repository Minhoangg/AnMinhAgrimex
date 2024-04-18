<?php

namespace WPML\Core;

use WPML\Core\Twig\Extension\StagingExtension;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Extension\\StagingExtension');
if (FALSE) {
    class Twig_Extension_Staging extends StagingExtension
    {
    }
}
