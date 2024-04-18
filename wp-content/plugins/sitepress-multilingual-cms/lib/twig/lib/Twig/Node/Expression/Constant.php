<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\ConstantExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\ConstantExpression');
if (FALSE) {
    class Twig_Node_Expression_Constant extends ConstantExpression
    {
    }
}
