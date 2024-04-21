<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Header extends Base implements BaseInterface
{

    /**
     * @return void
     */
    public static function render()
    {
        $header = get_field('header', 'option');
?>
        <header class="">
            <div id="header-top" class="d-none d-lg-block bg-white ">
                <div class="container">
                    <div class="  align-items-center justify-content-between row">
                        <div class="col-3">
                            <i class="fa-solid fa-phone text-primary"></i>
                            <?= $header['number_phone']; ?>
                        </div>
                        <div class="col-6 text-center">
                            <a href="/">
                                <img src="<?= $header['logo_desktop']; ?>" alt="" width="100">
                            </a>
                        </div>
                        <div class="col-3">
                            <img src="./assets/images/vn-flag.svg" alt="" width="50" class="me-1">
                            <img src="./assets/images/en-flag.svg" alt="" width="50">
                        </div>
                    </div>
                </div>
            </div>
            <div id="header-bottom" class="  position-relative ">
                <div class="container">
                    <div class="row row-cols-md-3 row-cols-lg-2 align-items-center justify-content-between  ">
                        <div class="col p-0">
                            <div class="header-bottom-left">
                                <button class=" d-block d-lg-none text-white open-nav-menu-btn"><i class="fa-solid fa-bars"></i></button>
                                <?php
                                if (has_nav_menu('primary_menu')) {
                                    wp_nav_menu([
                                        'theme_location'  => 'primary_menu',
                                        'container'       => 'nav',
                                        'container_class' => 'header-menu-nav',
                                        'menu_class'      => 'd-flex align-items-center justify-content-between mb-0 ps-0',
                                    ]);
                                }
                                ?>
                                <button class=" close-nav-menu-btn px-2">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>

                            </div>
                        </div>
                        <div class="col d-block d-lg-none text-center">
                            <a href="/">
                                <img src="<?= $header['logo_mobile']['url']; ?>" alt="" width="70">
                            </a>
                        </div>
                        <div class="col">
                            <div class="d-flex align-items-center justify-content-end ">
                                <form role="search" method="get" id="search-form" class="search-form" action="<?php echo home_url('/'); ?>">
                                    
                                        <input type="hidden" value="product" name="post_type">
                                        <input type="search" id="search-input" class="" aria-describedby="button-addon2" placeholder="<?= __('Tìm kiếm', 'tinhdev') ?>" value="<?php echo get_search_query() ?>" name="s" title="<?= __('Tìm kiếm', 'tinhdev') ?>" />
                                        <button class="btn " type="submit" id="button-addon2">
                                            <i class="fa-solid fa-magnifying-glass" aria-hidden="true"></i>
                                        </button>


                                    <!-- <input type="text" placeholder="Tìm kiếm" name="search" id="search-input" class="sssss">
                                    <button type="submit" id="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button> -->
                                </form>
                                <!-- <form action="" id="search-form" class="search-form">
                                    <input type="text" placeholder="Tìm kiếm" name="search" id="search-input" class="sssss">
                                    <button type="submit" id="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                                </form> -->
                                <button class="open-search-btn text-white py-3 d-lg-none d-block"><i class="fa-solid fa-magnifying-glass"></i></button>
                                <div class=" d-block d-md-none">
                                    <img src="./assets/images/vn-flag.svg" alt="" width="50" class="me-1">
                                    <img src="./assets/images/en-flag.svg" alt="" width="50">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </header>


<?php }
}
