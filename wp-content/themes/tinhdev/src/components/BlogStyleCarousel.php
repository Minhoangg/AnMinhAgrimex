<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class BlogStyleCarousel extends Base implements BaseInterface{

    public static function render(){
        $home_post_slide = get_field('home_post', 'option');
        if (!empty($home_post_slide)):
            foreach ($home_post_slide as $item):
                $argsPost   = [
                    'post_type'      => 'post',
                    'post_status'    => 'publish',
                    'offset'         => 0,
                    'orderby'        => 'ID',
                    'order'          => 'DESC',
                    'posts_per_page' => 6,
                    'tax_query'      => [
                        [
                            'taxonomy' => 'category',
                            'field'    => 'term_id', //This is optional, as it defaults to 'term_id'
                            'terms'    => $item->term_id,
                            'operator' => 'IN' // Possible values are 'IN', 'NOT IN', 'AND'.
                        ]
                    ]
                ];
                $list_posts = new WP_Query($argsPost);
                if ($list_posts->have_posts()):
                    ?>
					<section class="section-blog bg-light py-5">
						<div class="container">                

							<div class="text-center about-us">
								<h2 class="title-dancing ">
                                    <?= $item->name ?? '' ?>
								</h2>
								<h5 class="sub-title">
									CÔNG TY TNHH SOULEA
								</h5>
							</div>

							<div class="list-post owl-carousel list-post-carousel">
                                <?php while ($list_posts->have_posts()) :
                                    global $post;
                                    $list_posts->the_post();
                                    setup_postdata($post);
                                    $ID      = get_the_ID();
                                    $post    = setup_postdata($ID);
                                    $img     = get_the_post_thumbnail_url($ID, 'large');
                                    $title   = get_the_title($ID);
                                    $link    = get_permalink($ID);
                                    $excerpt = get_the_excerpt($ID);
                                    $date    = get_the_date('d/m/Y', $ID); ?>
									<div class="post-item border mb-5 rounded shadow bg-white">
										<a href="<?= $link ?>" class="position-relative" title="<?= $title ?>">
                                            <?php if (!empty($img)): ?>
												<div class="box-img">
													<img class="img-fluid" width="320" height="190" src="<?= $img ?>" alt="<?= $title ?>">
												</div>
                                            <?php endif; ?>
											<div class="info mb-3 p-3">
												<h3 class="title"><?= $title ?></h3>
												<p class="expert"><?= $excerpt ?></p>
											</div>
										</a>
									</div>
                                <?php
                                endwhile;
                                ?>
							</div>
						</div>
					</section>
                <?php
                endif;
            endforeach;
        endif;
    }
}