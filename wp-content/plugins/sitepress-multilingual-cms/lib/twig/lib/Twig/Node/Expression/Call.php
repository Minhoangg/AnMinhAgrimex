<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\CallExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\CallExpression');
if (FALSE) {
    class Twig_Node_Expression_Call extends CallExpression
    {
    }
}
