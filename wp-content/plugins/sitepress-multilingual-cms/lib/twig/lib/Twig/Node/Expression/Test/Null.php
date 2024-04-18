<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\Expression\Test\NullTest;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\Expression\\Test\\NullTest');
if (FALSE) {
    class Twig_Node_Expression_Test_Null extends NullTest
    {
    }
}
