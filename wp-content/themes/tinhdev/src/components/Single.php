<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class Single extends Base implements BaseInterface{

    /**
     * @return mixed
     */
    public static function render(){
        ?>
		<div class="section-single section-page">
			<div class="title-breadcrumb">
				<div class="container">
					<div class="py-5">
						<h1 class="">
                            <?php the_title(); ?>
						</h1>
						<div class="d-flex flex-wrap justify-content-end">
							<div><?= __('Bạn đang ở:', 'tinhdev') ?>&nbsp;</div>
							<div class="breadcrumbs text-right" typeof="BreadcrumbList" vocab="https://schema.org/">
                                <?php if (function_exists('bcn_display')){
                                    bcn_display();
                                } ?>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="container">
				<div class="py-5">
                    <?php the_content(); ?>
				</div>
			</div>
		</div>
    <?php }
}