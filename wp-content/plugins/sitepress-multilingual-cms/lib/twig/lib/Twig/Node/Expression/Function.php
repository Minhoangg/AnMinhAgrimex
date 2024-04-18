<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\FunctionExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\FunctionExpression');
if (FALSE) {
    class Twig_Node_Expression_Function extends FunctionExpression
    {
    }
}
