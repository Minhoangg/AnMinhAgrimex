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

use WPML\Core\Twig\Error\SyntaxError;
use WPML\Core\Twig\Node\BodyNode;
use WPML\Core\Twig\Node\MacroNode;
use WPML\Core\Twig\Node\Node;
use WPML\Core\Twig\Token;
use function class_alias;
use function sprintf;

/**
 * Defines a macro.
 *
 *   {% macro input(name, value, type, size) %}
 *      <input type="{{ type|default('text') }}" name="{{ name }}" value="{{ value|e }}" size="{{ size|default(20) }}" />
 *   {% endmacro %}
 *
 * @final
 */
class MacroTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        $name = $stream->expect(Token::NAME_TYPE)->getValue();
        $arguments = $this->parser->getExpressionParser()->parseArguments(TRUE, TRUE);
        $stream->expect(Token::BLOCK_END_TYPE);
        $this->parser->pushLocalScope();
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], TRUE);
        if ($token = $stream->nextIf(Token::NAME_TYPE)) {
            $value = $token->getValue();
            if ($value != $name) {
                throw new SyntaxError(sprintf('Expected endmacro for macro "%s" (but "%s" given).', $name, $value), $stream->getCurrent()->getLine(), $stream->getSourceContext());
            }
        }
        $this->parser->popLocalScope();
        $stream->expect(Token::BLOCK_END_TYPE);
        $this->parser->setMacro($name, new MacroNode($name, new BodyNode([$body]), $arguments, $lineno, $this->getTag()));
        return new Node();
    }
    public function decideBlockEnd(Token $token)
    {
        return $token->test('endmacro');
    }
    public function getTag()
    {
        return 'macro';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\MacroTokenParser', 'WPML\\Core\\Twig_TokenParser_Macro');
