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

use WPML\Core\Twig\Node\Expression\AssignNameExpression;
use WPML\Core\Twig\Node\ImportNode;
use WPML\Core\Twig\Token;
use function class_alias;

/**
 * Imports macros.
 *
 *   {% import 'forms.html' as forms %}
 *
 * @final
 */
class ImportTokenParser extends AbstractTokenParser
{
    public function parse(Token $token)
    {
        $macro = $this->parser->getExpressionParser()->parseExpression();
        $this->parser->getStream()->expect(Token::NAME_TYPE, 'as');
        $var = new AssignNameExpression($this->parser->getStream()->expect(Token::NAME_TYPE)->getValue(), $token->getLine());
        $this->parser->getStream()->expect(Token::BLOCK_END_TYPE);
        $this->parser->addImportedSymbol('template', $var->getAttribute('name'));
        return new ImportNode($macro, $var, $token->getLine(), $this->getTag());
    }
    public function getTag()
    {
        return 'import';
    }
}
class_alias('WPML\\Core\\Twig\\TokenParser\\ImportTokenParser', 'WPML\\Core\\Twig_TokenParser_Import');
