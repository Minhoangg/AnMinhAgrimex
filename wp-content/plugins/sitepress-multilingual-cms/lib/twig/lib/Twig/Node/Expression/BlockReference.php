<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\BlockReferenceExpression;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\BlockReferenceExpression');
if (FALSE) {
    class Twig_Node_Expression_BlockReference extends BlockReferenceExpression
    {
    }
}
