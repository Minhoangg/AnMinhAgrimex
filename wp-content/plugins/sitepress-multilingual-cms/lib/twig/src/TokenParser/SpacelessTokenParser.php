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

use WPML\Core\Twig\Node\SpacelessNode;
use WPML\Core\Twig\Token;
use function class_alias;

/**
 * Remove whitespaces between HTML tags.
 *
 *   {% spaceless %}
 *      <div>
 *          <strong>foo</strong>
 *      </div>
 *   {% endspaceless %}
 *   {# output will be <div><strong>foo</strong></div> #}
 *
 * @final
 */
class SpacelessTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideSpacelessEnd'], TRUE);
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        return new SpacelessNode($body, $lineno, $this->getTag());
    }
    public function decideSpacelessEnd(Token $token)
    {
        return $token->test('endspaceless');
    }
    public function getTag()
    {
        return 'spaceless';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\SpacelessTokenParser', 'WPML\\Core\\Twig_TokenParser_Spaceless');
