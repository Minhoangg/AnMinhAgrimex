<?php

namespace WPML\Core;

use WPML\Core\Twig\FileExtensionEscapingStrategy;
use function class_exists;

class_exists('WPML\\Core\\Twig\\FileExtensionEscapingStrategy');
if (FALSE) {
    class Twig_FileExtensionEscapingStrategy extends FileExtensionEscapingStrategy
    {
    }
}
