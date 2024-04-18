<?php

namespace WPML\Core;

use WPML\Core\Twig\Sandbox\SecurityPolicyInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Sandbox\\SecurityPolicyInterface');
if (FALSE) {
    class Twig_Sandbox_SecurityPolicyInterface extends SecurityPolicyInterface
    {
    }
}
