<?php

namespace WPML\Core;

use WPML\Core\Twig\Node\NodeCaptureInterface;
use function class_exists;

class_exists('WPML\\Core\\Twig\\Node\\NodeCaptureInterface');
if (FALSE) {
    class Twig_NodeCaptureInterface extends NodeCaptureInterface
    {
    }
}
