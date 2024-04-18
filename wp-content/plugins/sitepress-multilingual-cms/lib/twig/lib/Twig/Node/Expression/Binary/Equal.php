<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\Binary\EqualBinary;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\Binary\\EqualBinary');
if (FALSE) {
    class Twig_Node_Expression_Binary_Equal extends EqualBinary
    {
    }
}
