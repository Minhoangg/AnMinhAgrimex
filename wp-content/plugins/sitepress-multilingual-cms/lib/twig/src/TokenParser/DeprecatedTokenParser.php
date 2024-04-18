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

use WPML\Core\Twig\Node\DeprecatedNode;
use WPML\Core\Twig\Token;
use function class_alias;

/**
 * Deprecates a section of a template.
 *
 *    {% deprecated 'The "base.twig" template is deprecated, use "layout.twig" instead.' %}
 *    {% extends 'layout.html.twig' %}
 *
 * @author Yonel Ceruto <yonelceruto@gmail.com>
 *
 * @final
 */
class DeprecatedTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $expr = $this->parser->getExpressionParser()->parseExpression();
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        return new DeprecatedNode($expr, $token->getLine(), $this->getTag());
    }
    public function getTag()
    {
        return 'deprecated';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\DeprecatedTokenParser', 'WPML\\Core\\Twig_TokenParser_Deprecated');
