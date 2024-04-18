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
                                        <img src="wp-content/themes/tinhdev/src/assets/images/logo_title.svg" alt="" class="logo-image">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <h5>GỬI THÔNG TIN YÊU CẦU HỖ TRỢ</h5>
                        <p>
                            Cám ơn Quý Khách đã quan tâm , Quý Khách vui lòng để lại thông tin yêu cầu, chúng tôi sẽ liên hệ lại trong vòng 48 tiếng.
                            Mọi yêu cầu cần hỗ trợ gấp, xin vui lòng gọi số Hotline của Gạo A AN: 19006869 để được hỗ trợ.
                        </p>
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label for="inputName4" class="form-label">Họ và tên <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="inputName4">
                            </div>
                            <div class="col-md-6">
                                <label for="inputPhone4" class="form-label">Số điện thoại <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="inputPhone4">
                            </div>
                            <div class="col-md-12">
                                <label for="inputEmail4" class="form-label">Email <a class="text-danger">*</a></label>
                                <input type="email" class="form-control" id="inputEmail4">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Địa chỉ <a class="text-danger">*</a></label>
                                <input type="text" class="form-control" id="inputAddress">
                            </div>
                            <div class="col-12">
                                <label for="inputAddress" class="form-label">Nội dung <a class="text-danger">*</a></label>
                                <textarea class="col-12 form-control" rows="9" cols="70"> </textarea>
                            </div>

                            <div class="col-12 mb-5">
                                <button type="submit" class="btn btn-primary">Gửi</button>
                            </div>
                        </form>
                    </div>
                    <div class="col-md-4">
                        <div class="address_contact">
                            <h5 class="title">CÔNG TY CỔ PHẦN LƯƠNG THỰC AN MINH</h5>
                            <div class="list d-flex justify-content-start gap-3">
                                <i class="ri-map-pin-2-line fs-1"></i>
                                <div class="text mt-3">
                                    <h5>Địa chỉ</h5>
                                    <p>
                                        Tầng 14, Tòa nhà Diamond Flower, Số 48 đường Lê Văn Lương, Khu đô thị mới N1, Phường Nhân Chính, Quận Thanh Xuân
                                    </p>
                                </div>
                            </div>
                            <div class="list d-flex justify-content-start gap-3">
                                <i class="ri-mail-line fs-1"></i>
                                <div class="text mt-3">
                                    <h5>Email</h5>
                                    <p>
                                        tranhdmpc06159@fpt.edu.vn
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
