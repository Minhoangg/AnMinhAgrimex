<?php

namespace WPML\Core;

use WPML\Core\Twig\TokenParser\SpacelessTokenParser;
use function class_exists;

class_exists('WPML\\Core\\Twig\\TokenParser\\SpacelessTokenParser');
if (FALSE) {
    class Twig_TokenParser_Spaceless extends SpacelessTokenParser
    {
    }
}
