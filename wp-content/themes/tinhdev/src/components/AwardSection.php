<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class AwardSection extends Base implements BaseInterface
{

    /**
     * @return mixed|void
     */
    public static function render()
    {
?>
        <section class="py-3 container">
            <div class="d-flex justify-content-center align-items-center mb-3">
                <div class="intro-section">
                    <h3 class="fw-bold text-center">Chứng nhận, giải thưởng</h3>
                    <div class="d-flex justify-content-center">
                        <div class="contact_title_line">
                            <img src="wp-content/themes/tinhdev/src/assets/images/logo_title.svg" alt="" class="logo-image">
                        </div>
                    </div>
                </div>
            </div>
            <div class="slick">
                <?php $awards = get_field('giai_thuong','option')?>
                <?php foreach ($awards as $award):?>
                    <div>
                        <img src="<?= $award['url'] ?>" alt="" width="200">
                    </div>
                    <?php endforeach; ?>
            </div>
        </section>
<?php }
}
