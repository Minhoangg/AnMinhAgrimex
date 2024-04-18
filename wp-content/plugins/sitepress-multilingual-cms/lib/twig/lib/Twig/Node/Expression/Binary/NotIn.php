<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\Binary\NotInBinary;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\Binary\\NotInBinary');
if (FALSE) {
    class Twig_Node_Expression_Binary_NotIn extends NotInBinary
    {
    }
}
