<?php

/*
 * This file is part of Twig.
 *
 * (c) Fabien Potencier
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
namespace WPML\Core\Twig\Profiler\Dumper;

use WPML\Core\Twig\Profiler\Profile;
use function class_alias;
use function count;
use function sprintf;

/**
 * @author Fabien Potencier <fabien@symfony.com>
 */
abstract class BaseDumper
{
    private $root;
    public function dump(Profile $profile)
    {
        return $this->dumpProfile($profile);
    }
    protected abstract function formatTemplate(Profile $profile, $prefix);
    protected abstract function formatNonTemplate(Profile $profile, $prefix);
    protected abstract function formatTime(Profile $profile, $percent);
    private function dumpProfile(Profile $profile, $prefix = '', $sibling = FALSE)
    {
        if ($profile->isRoot()) {
            $this->root = $profile->getDuration();
            $start = $profile->getName();
        } else {
            if ($profile->isTemplate()) {
                $start = $this->formatTemplate($profile, $prefix);
            } else {
                $start = $this->formatNonTemplate($profile, $prefix);
            }
            $prefix .= $sibling ? '│ ' : '  ';
        }
        $percent = $this->root ? $profile->getDuration() / $this->root * 100 : 0;
        if ($profile->getDuration() * 1000 < 1) {
            $str = $start . "\n";
        } else {
            $str = sprintf("%s %s\n", $start, $this->formatTime($profile, $percent));
        }
        $nCount = count($profile->getProfiles());
        foreach ($profile as $i => $p) {
            $str .= $this->dumpProfile($p, $prefix, $i + 1 !== $nCount);
        }
        return $str;
    }
}
class_alias('WPML\\Core\\Twig\\Profiler\\Dumper\\BaseDumper', 'WPML\\Core\\Twig_Profiler_Dumper_Base');
