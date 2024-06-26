<?php

namespace WPML\Core;

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use function trigger_error;
use const E_USER_DEPRECATED;

@trigger_error('The Twig_Filter_Node class is deprecated since version 1.12 and will be removed in 2.0. Use \\Twig\\TwigFilter instead.', E_USER_DEPRECATED);
/**
 * Represents a template filter as a node.
 *
 * Use \Twig\TwigFilter instead.
 *
 * @author Fabien Potencier <fabien@symfony.com>
 *
 * @deprecated since 1.12 (to be removed in 2.0)
 */
class Twig_Filter_Node extends Twig_Filter
{
    protected $class;
    public function __construct($class, array $options = [])
    {
        parent::__construct($options);
        $this->class = $class;
    }
    public function getClass()
    {
        return $this->class;
    }
    public function compile()
    {
    }
}
