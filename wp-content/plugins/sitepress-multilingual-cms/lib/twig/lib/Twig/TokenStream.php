<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenStream;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenStream');
if (FALSE) {
    class Twig_TokenStream extends TokenStream
    {
    }
}
