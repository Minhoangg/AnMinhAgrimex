<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\SandboxTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\SandboxTokenParser');
if (FALSE) {
    class Twig_TokenParser_Sandbox extends SandboxTokenParser
    {
    }
}
