<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\MethodCallExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\MethodCallExpression');
if (FALSE) {
    class Twig_Node_Expression_MethodCall extends MethodCallExpression
    {
    }
}
