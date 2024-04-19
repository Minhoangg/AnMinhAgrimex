<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Footer extends Base implements BaseInterface
{

    /**
     * @return mixed|void
     */
    public static function render()
    {
        $footer = get_field('footer_contact', 'option');
?>
        <footer>
            <div class="container">
                <div class="row">
                    <div class="col-md-4 d-flex justify-content-center align-items-center">
                        <div class="">
                            <div class="text-center">
                                <img src="<?= $footer['logo']['url'] ?>" style="width: 50%">
                                <div class="hr_footer_1"></div>
                                <h4 class="title_footer">Công Ty Cổ Phần An Minh</h4>
                            </div>
                            <div class="footer_contact">
                                <div class="footer_contact_icon">
                                    <p><i class="fa-solid fa-location-dot"></i>Tòa nhà FPT Polytechnic, đường số 22, phường Thường Thạnh, Quận Cái Răng, TP.Cần Thơ</p>
                                </div>
                                <div class="footer_contact_icon">
                                    <p><i class="fa-solid fa-envelope"></i>abc@gmail.com</p>
                                </div>
                                <div class="footer_contact_icon">
                                    <p><i class="fa-solid fa-phone"></i>123 456 789</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center footer_information">
                        <div class="w-100">
                            <div class="d-flex justify-content-between">
                                <div class="">
                                    <h5>Danh mục</h5>
                                    <p>
                                        <a href="/cua-hang"><i class="fa-solid fa-arrow-right"></i> Sản phẩm</a>
                                    </p>
                                    <p>
                                        <a href="/bai-viet"><i class="fa-solid fa-arrow-right"></i> Bài viết</a>
                                    </p>
                                    <p>
                                        <a href="/gioi-thieu"><i class="fa-solid fa-arrow-right"></i> Giới thiệu</a>
                                    </p>
                                    <p>
                                        <a href="#"><i class="fa-solid fa-arrow-right"></i> Liên hệ</a>
                                    </p>
                                </div>
                                <div class="">
                                    <h5>Thông tin</h5>
                                    <p>
                                        <a href="#"><i class="fa-solid fa-arrow-right"></i> Hồ sơ tập đoàn</a>
                                    </p>
                                    <p>
                                        <a href="#"><i class="fa-solid fa-arrow-right"></i> Dự án sản xuất</a>
                                    </p>
                                    <p>
                                        <a href="#"><i class="fa-solid fa-arrow-right"></i> Thị trường xuất khẩu</a>
                                    </p>
                                </div>
                            </div>
                            <div class="hr_footer"></div>
                            <div class="footer_social d-flex justify-content-start">
                                <a href="#">
                                    <img src="./assets/image/Facebook - Original.svg" alt="">
                                </a>
                                <a href="#">
                                    <img src="./assets/image/Vector.svg" alt="">
                                </a>
                                <a href="#">
                                    <img src="./assets/image/Instagram - Original.svg" alt="">
                                </a>
                                <a href="#">
                                    <img src="./assets/image/Google - Original.svg" alt="">
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 d-flex justify-content-center align-items-center footer_map">
                        <div class="container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d15717
                            .77587889344!2d105.74685399999998!3d9.9801365!2m3!1f0!2f0!3f0!3m2!1i1024
                            !2i768!4f13.1!5e0!3m2!1svi!2s!4v1713168641293!5m2!1svi!2s" style="border:0; border-radius: 15px;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
                            </iframe>
                        </div>
                    </div>
                </div>

            </div>
            <div class="text-white text-center border-top border-white py-2">
                
                <div class="container">Copyright © 2024 AnMinh, All Rights Reserved.</div>
            </div>
        </footer>
<?php }
}
