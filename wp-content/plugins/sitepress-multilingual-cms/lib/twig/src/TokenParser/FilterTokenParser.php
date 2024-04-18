<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\TokenParser;

use WPML\Core\Twig\Node\BlockNode;
use WPML\Core\Twig\Node\Expression\BlockReferenceExpression;
use WPML\Core\Twig\Node\Expression\ConstantExpression;
use WPML\Core\Twig\Node\PrintNode;
use WPML\Core\Twig\Token;
use function class_alias;

/**
 * Filters a section of a template by applying filters.
 *
 *   {% filter upper %}
 *      This text becomes uppercase
 *   {% endfilter %}
 *
 * @final
 */
class FilterTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $name = $this->parser->getVarName();
        $ref = new BlockReferenceExpression(new ConstantExpression($name, $token->getLine()), null, $token->getLine(), $this->getTag());
        $filter = $this->parser->getExpressionParser()->parseFilterExpressionRaw($ref, $this->getTag());
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], TRUE);
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $block = new BlockNode($name, $body, $token->getLine());
        $this->parser->setBlock($name, $block);
        return new PrintNode($filter, $token->getLine(), $this->getTag());
    }
    public function decideBlockEnd(Token $token)
    {
        return $token->test('endfilter');
    }
    public function getTag()
    {
        return 'filter';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\FilterTokenParser', 'WPML\\Core\\Twig_TokenParser_Filter');
