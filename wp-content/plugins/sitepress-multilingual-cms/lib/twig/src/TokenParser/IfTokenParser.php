<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 * (c) Armin Ronacher
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\TokenParser;

use WPML\Core\Twig\Error\SyntaxError;
use WPML\Core\Twig\Node\IfNode;
use WPML\Core\Twig\Node\Node;
use WPML\Core\Twig\Token;
use function class_alias;
use function sprintf;

/**
 * Tests a condition.
 *
 *   {% if users %}
 *    <ul>
 *      {% for user in users %}
 *        <li>{{ user.username|e }}</li>
 *      {% endfor %}
 *    </ul>
 *   {% endif %}
 *
 * @final
 */
class IfTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $lineno = $token->getLine();
        $expr = $this->parser->getExpressionParser()->parseExpression();
        $stream = $this->parser->getStream();
        $stream->expect(Token::BLOCK_END_TYPE);
        $body = $this->parser->subparse([$this, 'decideIfFork']);
        $tests = [$expr, $body];
        $else = null;
        $end = FALSE;
        while (!$end) {
            switch ($stream->next()->getValue()) {
                case 'else':
                    $stream->expect(Token::BLOCK_END_TYPE);
                    $else = $this->parser->subparse([$this, 'decideIfEnd']);
                    break;
                case 'elseif':
                    $expr = $this->parser->getExpressionParser()->parseExpression();
                    $stream->expect(Token::BLOCK_END_TYPE);
                    $body = $this->parser->subparse([$this, 'decideIfFork']);
                    $tests[] = $expr;
                    $tests[] = $body;
                    break;
                case 'endif':
                    $end = TRUE;
                    break;
                default:
                    throw new SyntaxError(sprintf('Unexpected end of template. Twig was looking for the following tags "else", "elseif", or "endif" to close the "if" block started at line %d).', $lineno), $stream->getCurrent()->getLine(), $stream->getSourceContext());
            }
        }
        $stream->expect(Token::BLOCK_END_TYPE);
        return new IfNode(new Node($tests), $else, $lineno, $this->getTag());
    }
    public function decideIfFork(Token $token)
    {
        return $token->test(['elseif', 'else', 'endif']);
    }
    public function decideIfEnd(Token $token)
    {
        return $token->test(['endif']);
    }
    public function getTag()
    {
        return 'if';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\IfTokenParser', 'WPML\\Core\\Twig_TokenParser_If');
