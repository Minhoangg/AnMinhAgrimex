<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\GetAttrExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\GetAttrExpression');
if (FALSE) {
    class Twig_Node_Expression_GetAttr extends GetAttrExpression
    {
    }
}
