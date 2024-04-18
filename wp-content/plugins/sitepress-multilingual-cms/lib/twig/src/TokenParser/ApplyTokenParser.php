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

use WPML\Core\Twig\Node\Expression\TempNameExpression;
use WPML\Core\Twig\Node\Node;
use WPML\Core\Twig\Node\PrintNode;
use WPML\Core\Twig\Node\SetNode;
use WPML\Core\Twig\Token;
/**
 * Applies filters on a section of a template.
 *
 *   {% apply upper %}
 *      This text becomes uppercase
 *   {% endapplys %}
 */
final class ApplyTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $name = $this->parser->getVarName();
        $ref = new TempNameExpression($name, $lineno);
        $ref->setAttribute('always_defined', TRUE);
        $filter = $this->parser->getExpressionParser()->parseFilterExpressionRaw($ref, $this->getTag());
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideApplyEnd'], TRUE);
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        return new Node([new SetNode(TRUE, $ref, $body, $lineno, $this->getTag()), new PrintNode($filter, $lineno, $this->getTag())]);
    }
    public function decideApplyEnd(Token $token)
    {
        return $token->test('endapply');
    }
    public function getTag()
    {
        return 'apply';
    }
}
