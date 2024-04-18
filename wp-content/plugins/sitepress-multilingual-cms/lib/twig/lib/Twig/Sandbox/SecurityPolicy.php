<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityPolicy;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityPolicy');
if (FALSE) {
    class Twig_Sandbox_SecurityPolicy extends SecurityPolicy
    {
    }
}
