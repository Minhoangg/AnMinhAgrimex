<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Slider extends Base implements BaseInterface
{

  /**
   * @return mixed|void
   */
  public static function render()
  { ?>
		
                <?= do_shortcode(get_field('slider', 'option') ?? '') ?>
		
    <?php }
}
