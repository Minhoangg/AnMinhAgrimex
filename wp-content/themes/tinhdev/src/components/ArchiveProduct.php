<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;
use TinhDev\components\HomeContactUs;

class ArchiveProduct extends Base implements BaseInterface
{

	/**
	 * @return mixed|void
	 */
	public static function render()
	{
?>

		<section class="container section_products pt-3">
			<div class="row">
				<div class="col-md-12 mb-5">
					<?php if (function_exists('bcn_display')) {
						bcn_display();
					} ?>
				</div>
				<div class="col-md-3">
					<div class="container-fluid p-2 caterogy_list mb-4">
						<div class="line_title">
							<a href="#" class="d-flex justify-content-start gap-3">
								<p class="fs-5 fw-bold d-flex gap-2">
									<i class="ri-list-unordered"></i>
									Danh mục
								</p>
							</a>
						</div>
						<?php
						$product_categories = get_terms('product_cat', array(
							'orderby' => 'name',
							'order' => 'ASC',
							'hide_empty' => false,
						));

						foreach ($product_categories as $category) {
							echo '   
									<div class="line">
									<a href="' . get_term_link($category) . '" class="d-flex justify-content-start gap-3">
										= <p> ' . $category->name . '</p>
									</a>
								</div>
									
							';
						}
						?>
					</div>



					<div class="product_list_mini d-none d-sm-block">
						<div class="title d-flex justify-content-center align-content-center">
							Sản phẩm liên quan
						</div>
						<div class="product_item row d-flex justify-content-evenly">


							<?php

							$args = [
								'posts_per_page' => 4, 
								'post_type' => 'product',
								'post_status' => 'publish', 

							];
							$list_product = new WP_Query($args);
							if ($list_product->have_posts()) : ?>

								<?php while ($list_product->have_posts()) : global $product;
									$list_product->the_post();
									setup_postdata($product);
									$ID = get_the_ID();
									$img = get_the_post_thumbnail_url($ID, 'full');
									$title = get_the_title($ID);
									$link = get_permalink($ID);
									$product = wc_get_product($ID);
									$max_percentage = parent::getProductPercentage($product)
								?>

									<div class="products_box_item col-md-6 p-0 overflow-hidden">
										<div class="product_img ">
											<a href="<?= $link ?>">

												<img src="<?= $img ?>" alt="" class="w-100">
											</a>
										</div>
										<div class="product_info p-1">
											<a href="<?= $link ?> " class="product_name fw-bold "><?= $title ?></a>
											<div class="product_price"><?php if ($max_percentage > 0) : ?>
													<div class="price d-flex justify-content-between align-items-center">
														<span class="fw-light"><?= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></span>
													</div>
												<?php elseif ($product->get_regular_price() != 0) : ?>
													<div class="price">
														<ins class="text-decoration-none text-primary">
															<strong><?= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></strong>
														</ins>
													</div>
												<?php else : ?>
													<div class="price">
														<ins class="text-decoration-none">
															<strong><?= __('Liên hệ', 'tinhdev') ?></strong>
														</ins>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>

								<?php endwhile ?>


							<?php endif ?>


						</div>
					</div>

				</div>
				<div class="col-md-9">
					<h5 class="fw-bold"><?php the_archive_title(); ?></h5>
					<hr>
					<div class="product_list d-flex justify-content-between row">
						<?php if (have_posts()) :
							while (have_posts()) : the_post();
								$ID = get_the_ID();
								$img = get_the_post_thumbnail_url($ID, 'full');
								$title = get_the_title($ID);
								$link = get_permalink($ID);
								$product = wc_get_product($ID);
								$max_percentage = parent::getProductPercentage($product)
						?>
								<div class="col-md-3 mb-3">
									<div class="product-card">
										<div class="product-card-img">
											<a href="<?= $link ?>">
												<img src="<?= $img ?>" alt="">
											</a>
										</div>
										<div class="product-card-info">
											<a href="<?= $link ?>" class="product-card-title text-black ">
												<?= $title ?>
											</a>
											<?php if ($max_percentage > 0) : ?>
												<div class="price d-flex justify-content-between align-items-center">
													<ins class="text-decoration-line-through text-black-50 ">
														<strong><?= number_format($product->get_sale_price()) . get_woocommerce_currency_symbol(); ?></strong>
													</ins>

													<span class="text-primary fw-bold"><?= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></span>
												</div>
											<?php elseif ($product->get_regular_price() != 0) : ?>
												<div class="price">
													<ins class="text-decoration-none text-primary">
														<strong><?= number_format($product->get_regular_price()) . get_woocommerce_currency_symbol(); ?></strong>
													</ins>
												</div>
											<?php else : ?>
												<div class="price">
													<ins class="text-decoration-none">
														<strong><?= __('Liên hệ', 'tinhdev') ?></strong>
													</ins>
												</div>
											<?php endif; ?>

										</div>
									</div>
								</div>


							<?php endwhile; ?>
					</div>
					<div class="mb-3 product_pagenavi d-flex justify-content-center align-items-center gap-2">
						<?php wp_pagenavi();
						?>
					</div>
				</div>
			</div>
		</section>


	<?php else : ?>
		<div class="col-12">
			<p class="btn"><?= __(
								'Nội dung đang được cập nhật vui lòng quay lại sau!',
								'tinhdev'
							) ?></p>
		</div>
	<?php endif;
						$contact_us = get_field('contact_us', 'option');
	?>
	</div>
	</div>
	</div>
	</div>
	</section>


<?php }
}
