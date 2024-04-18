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

use WPML\Core\Twig\Node\IncludeNode;
use WPML\Core\Twig\Token;
use function class_alias;

/**
 * Includes a template.
 *
 *   {% include 'header.html' %}
 *     Body
 *   {% include 'footer.html' %}
 */
class IncludeTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $expr = $this->parser->getExpressionParser()->parseExpression();
        [$variables, $only, $ignoreMissing] = $this->parseArguments();
        return new IncludeNode($expr, $variables, $only, $ignoreMissing, $token->getLine(), $this->getTag());
    }
    protected function parseArguments()
    {
        $stream = $this->parser->getStream();
        $ignoreMissing = FALSE;
        if ($stream->nextIf(Token::NAME_TYPE, 'ignore')) {
            $stream->expect(Token::NAME_TYPE, 'missing');
            $ignoreMissing = TRUE;
        }
        $variables = null;
        if ($stream->nextIf(Token::NAME_TYPE, 'with')) {
            $variables = $this->parser->getExpressionParser()->parseExpression();
        }
        $only = FALSE;
        if ($stream->nextIf(Token::NAME_TYPE, 'only')) {
            $only = TRUE;
        }
        $stream->expect(Token::BLOCK_END_TYPE);
        return [$variables, $only, $ignoreMissing];
    }
    public function getTag()
    {
        return 'include';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\IncludeTokenParser', 'WPML\\Core\\Twig_TokenParser_Include');
