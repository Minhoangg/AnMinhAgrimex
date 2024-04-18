<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\Binary\ConcatBinary;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\Binary\\ConcatBinary');
if (FALSE) {
    class Twig_Node_Expression_Binary_Concat extends ConcatBinary
    {
    }
}
