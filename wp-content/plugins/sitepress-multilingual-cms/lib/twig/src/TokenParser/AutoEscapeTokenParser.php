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
use WPML\Core\Twig\Node\AutoEscapeNode;
use WPML\Core\Twig\Node\Expression\ConstantExpression;
use WPML\Core\Twig\Token;
use function class_alias;
use function trigger_error;
use const E_USER_DEPRECATED;

/**
 * Marks a section of a template to be escaped or not.
 *
 *   {% autoescape true %}
 *     Everything will be automatically escaped in this block
 *   {% endautoescape %}
 *
 *   {% autoescape false %}
 *     Everything will be outputed as is in this block
 *   {% endautoescape %}
 *
 *   {% autoescape true js %}
 *     Everything will be automatically escaped in this block
 *     using the js escaping strategy
 *   {% endautoescape %}
 *
 * @final
 */
class AutoEscapeTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $stream = $this->parser->getStream();
        if ($stream->test(Token::BLOCK_END_TYPE)) {
            $value = 'html';
        } else {
            $expr = $this->parser->getExpressionParser()->parseExpression();
            if (!$expr instanceof ConstantExpression) {
                throw new SyntaxError('An escaping strategy must be a string or a bool.', $stream->getCurrent()->getLine(), $stream->getSourceContext());
            }
            $value = $expr->getAttribute('value');
            $compat = TRUE === $value || FALSE === $value;
            if (TRUE === $value) {
                $value = 'html';
            }
            if ($compat && $stream->test(Token::NAME_TYPE)) {
                @trigger_error('Using the autoescape tag with "true" or "false" before the strategy name is deprecated since version 1.21.', E_USER_DEPRECATED);
                if (FALSE === $value) {
                    throw new SyntaxError('Unexpected escaping strategy as you set autoescaping to false.', $stream->getCurrent()->getLine(), $stream->getSourceContext());
                }
                $value = $stream->next()->getValue();
            }
        }
        $stream->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideBlockEnd'], TRUE);
        $stream->expect(Token::BLOCK_END_TYPE);
        return new AutoEscapeNode($value, $body, $lineno, $this->getTag());
    }
    public function decideBlockEnd(Token $token)
    {
        return $token->test('endautoescape');
    }
    public function getTag()
    {
        return 'autoescape';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\AutoEscapeTokenParser', 'WPML\\Core\\Twig_TokenParser_AutoEscape');
