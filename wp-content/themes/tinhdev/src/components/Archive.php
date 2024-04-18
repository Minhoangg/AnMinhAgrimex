<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;

class Archive extends Base implements BaseInterface{

    /**
     * @return mixed
     */
    public static function render(){ ?>
		<div class="archive">
			<div class="title-breadcrumb">
				<div class="container">
					<div class="py-5">
						<h1 class="text-center">
                            <?php the_archive_title(); ?>
						</h1>
						<div class="d-flex flex-wrap justify-content-center">
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
				<div class="row">
					<div class="col-lg-8">
						<div class="row">
                            <?php if (have_posts()): while (have_posts()) : 
                                the_post();
                                $ID      = get_the_ID();
                                $img     = get_the_post_thumbnail_url($ID, 'large');
                                $title   = get_the_title($ID);
                                $link    = get_permalink($ID);
                                $excerpt = get_the_excerpt($ID);
                                $date    = get_the_date('d/m/Y', $ID);
                                $author  = get_the_author_meta('user_email');
								?>
								<div class="col-md-6">
									<div class="post-item border my-3 rounded shadow bg-white">
										<h3 class="title p-3"><?= $title ?></h3>
										<a href="<?= $link ?>" title="<?= $title ?>">
                                            <?php if (!empty($img)): ?>
												<div class="box-img">
													<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
												</div>
                                            <?php endif; ?>
											<div class="info p-3">
												<p class="expert"><?= $excerpt ?></p>
											</div>
											<div class="meta border p-2 d-flex align-items-center">&nbsp;&nbsp;&nbsp;
												<i class="fa-solid fa-envelope"> </i><span> &nbsp; <?= $author ?></span>&nbsp;
												<i class="fa-solid fa-calendar-days"></i><span> &nbsp;<?= $date ?></span>
											</div>
										</a>
									</div>
								</div>
                            <?php
                            endwhile;
                                wp_pagenavi();
                            else: ?>
								<div class="col-12">
									<p class="btn"><?= __('Nội dung đang được cập nhật vui lòng quay lại sau!',
                                            'tinhdev') ?></p>
								</div>
                            <?php endif; ?>
						</div>

					</div>
					<div class="col-lg-4">

					</div>
				</div>
			</div>
		</div>
        <?php
    }
}