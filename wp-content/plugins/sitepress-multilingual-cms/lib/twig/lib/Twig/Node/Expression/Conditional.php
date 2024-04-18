<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\ConditionalExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\ConditionalExpression');
if (FALSE) {
    class Twig_Node_Expression_Conditional extends ConditionalExpression
    {
    }
}
