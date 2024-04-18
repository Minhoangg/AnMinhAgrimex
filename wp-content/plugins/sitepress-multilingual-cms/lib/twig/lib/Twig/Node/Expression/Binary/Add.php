<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\Binary\AddBinary;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\Binary\\AddBinary');
if (FALSE) {
    class Twig_Node_Expression_Binary_Add extends AddBinary
    {
    }
}
