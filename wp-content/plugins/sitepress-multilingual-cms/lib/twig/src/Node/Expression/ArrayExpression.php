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
use function array_chunk;
use function array_push;
use function class_alias;
use function ctype_digit;

class ArrayExpression extends AbstractExpression
{
    protected $index;
    public function __construct(array $elements, $lineno)
    {
        parent::__construct($elements, [], $lineno);
        $this->index = -1;
        foreach ($this->getKeyValuePairs() as $pair) {
            if ($pair['key'] instanceof ConstantExpression && ctype_digit((string) $pair['key']->getAttribute('value')) && $pair['key']->getAttribute('value') > $this->index) {
                $this->index = $pair['key']->getAttribute('value');
            }
        }
    }
    public function getKeyValuePairs()
    {
        $pairs = [];
        foreach (array_chunk($this->nodes, 2) as $pair) {
            $pairs[] = ['key' => $pair[0], 'value' => $pair[1]];
        }
        return $pairs;
    }
    public function hasElement(AbstractExpression $key)
    {
        foreach ($this->getKeyValuePairs() as $pair) {
            // we compare the string representation of the keys
            // to avoid comparing the line numbers which are not relevant here.
            if ((string) $key === (string) $pair['key']) {
                return TRUE;
            }
        }
        return FALSE;
    }
    public function addElement(AbstractExpression $value, AbstractExpression $key = null)
    {
        if (null === $key) {
            $key = new ConstantExpression(++$this->index, $value->getTemplateLine());
        }
        array_push($this->nodes, $key, $value);
    }
    public function compile(Compiler $compiler)
    {
        $compiler->raw('[');
        $first = TRUE;
        foreach ($this->getKeyValuePairs() as $pair) {
            if (!$first) {
                $compiler->raw(', ');
            }
            $first = FALSE;
            $compiler->subcompile($pair['key'])->raw(' => ')->subcompile($pair['value']);
        }
        $compiler->raw(']');
    }
}
class_alias('WPML\\Core\\Twig\\Node\\Expression\\ArrayExpression', 'WPML\\Core\\Twig_Node_Expression_Array');
