<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class ContactPage extends Base implements BaseInterface
{

    /**
     * @return mixed|void
     */
    public static function render()
    {
        ?>


        <section class="container-fluid section_contact pt-3">
            <div class="container pb-5">
                <div class="row">
                    <div class="col-md-12 mb-3">
                        <div>
                            <?php if (function_exists('bcn_display')) {
                                bcn_display();
                            } ?>
                        </div>
                        <div class="d-flex justify-content-center align-items-center">
                            <div class="intro-section ">
                                <h3 class="fw-bold text-center">LIÊN HỆ</h3>
                                <div class="d-flex justify-content-center">
                                    <div class="contact_title_line">
                                        <img src="wp-content/themes/tinhdev/src/assets/images/logo_title.svg" alt=""
                                             class="logo-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <p>
                            Cám ơn Quý Khách đã quan tâm , Quý Khách vui lòng để lại thông tin yêu cầu, chúng tôi sẽ
                            liên hệ lại trong vòng 48 tiếng.
                            Mọi yêu cầu cần hỗ trợ gấp, xin vui lòng gọi số Hotline của Gạo A AN: 19006869 để được hỗ
                            trợ.
                        </p>

                        <?php
                        $contact_field = get_field('contact_form', 'option');

                        echo (do_shortcode($contact_field[0]['form']));
                        ?>

                    </div>
                    <div class="col-md-5">
                        <div class="address_contact" >
                            <h5 class="title"><?= $contact_field[0]['ten_cong_ty'] ?></h5>
                            <div class="list d-flex justify-content-start gap-3">
                                <i class="fa-solid fa-location-dot mt-3 fs-3"></i>
                                <div class="text mt-3">
                                    <h5>Địa chỉ</h5>
                                    <p>
                                        <?= $contact_field[0]['dia_chi'] ?>
                                    </p>
                                </div>
                            </div>
                            <div class="list d-flex justify-content-start gap-3">
                                <i class="fa-solid fa-envelope mt-3 fs-3"></i>
                                <div class="text mt-3">
                                    <h5>Email</h5>
                                    <p>
                                        <?= $contact_field[0]['email'] ?>
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


        <?php
    }
}
