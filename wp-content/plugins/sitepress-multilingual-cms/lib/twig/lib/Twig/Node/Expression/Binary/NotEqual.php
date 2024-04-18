<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\Binary\NotEqualBinary;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\Binary\\NotEqualBinary');
if (FALSE) {
    class Twig_Node_Expression_Binary_NotEqual extends NotEqualBinary
    {
    }
}
