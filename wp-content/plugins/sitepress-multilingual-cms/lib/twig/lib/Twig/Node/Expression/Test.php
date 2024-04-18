<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\TestExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\TestExpression');
if (FALSE) {
    class Twig_Node_Expression_Test extends TestExpression
    {
    }
}
