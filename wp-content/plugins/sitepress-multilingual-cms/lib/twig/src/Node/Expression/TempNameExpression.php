<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Node\Expression;

use WPML\Core\Twig\Compiler;
use function class_alias;

class TempNameExpression extends AbstractExpression
{
    public function __construct($name, $lineno)
    {
        parent::__construct([], ['name' => $name], $lineno);
    }
    public function compile(Compiler $compiler)
    {
        $compiler->raw('$_')->raw($this->getAttribute('name'))->raw('_');
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\TempNameExpression', 'WPML\\Core\\Twig_Node_Expression_TempName');
