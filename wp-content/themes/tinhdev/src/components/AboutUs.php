<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class AboutUs extends Base implements BaseInterface{

    /**
     * @return mixed|void
     */
    public static function render(){
        $about_us = get_field('about_us', 'option');
        if (!empty($about_us)):
            ?>
			<section class="about-us ">
				<div class="container">
					<div class="row">
                        <?php foreach ($about_us as $about): ?>
							<div class="col-lg-4">
								<div class="py-5">
									<h3 class="title">
                                        <?= $about['title'] ?? '' ?>
									</h3>
									<div class="description">
                                        <?= $about['description'] ?? '' ?>
									</div>

									<a href="<?= $about['link']['url'] ?? '' ?>" title="<?= $about['link']['title'] ?? '' ?>" class="btn-link"><span><?= $about['link']['title'] ?? '' ?></span></a>
								</div>
							</div>
                        <?php endforeach; ?>
					</div>
				</div>
			</section>

        <?php endif;
    }
}