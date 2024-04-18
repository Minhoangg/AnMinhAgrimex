<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\FilterExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\FilterExpression');
if (FALSE) {
    class Twig_Node_Expression_Filter extends FilterExpression
    {
    }
}
