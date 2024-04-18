<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\NullCoalesceExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\NullCoalesceExpression');
if (FALSE) {
    class Twig_Node_Expression_NullCoalesce extends NullCoalesceExpression
    {
    }
}
