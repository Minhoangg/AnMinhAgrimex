<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class SingleProduct extends Base implements BaseInterface
{

	/**
	 * @return mixed
	 */
	public static function render()
	{
		global $product;
		if (is_woocommerce() || is_search()) {
			$product = wc_get_product(get_the_ID());
		}

		$args = [
			'category__in' => wp_get_post_categories(get_the_ID()),
			'numberposts'  => 5,
			'post_type'    => 'product', // Ensures the post type is a product
			'post_status'  => 'publish', // Ensures the product is published
			'post__not_in' => [get_the_ID()]
		];

?>

		<section class="single-product section-product">
			<div class="container">
				<div class="breadcrumbs py-3">
					<?php if (function_exists('bcn_display')) {
						bcn_display();
					} ?>
				</div>
				<div class="row">

					<?php wc_get_template_part('content', 'single-product'); ?>

				</div>

				<?php $list_product = new WP_Query($args);
				if ($list_product->have_posts()) : ?>
					<h2 class="title-dancing text-center">Sản phẩm liên quan</h2>
					<div class="slick">
						<?php while ($list_product->have_posts()) : $list_product->the_post();
							$ID    = get_the_ID();
							$img   = get_the_post_thumbnail_url($ID, 'full');
							$title = get_the_title($ID);
							$link  = get_permalink($ID);

							$product        = wc_get_product($ID);
							$max_percentage = parent::getProductPercentage($product)
						?>
							<div class="product-card">
								<div class="product-card-img">
									<a href="<?= $link ?>">
										<img src="<?= $img ?>" alt="">
									</a>
								</div>
								<div class="product-card-info">
									<a href="<?= $link ?>" class="product-card-title text-black ">
										<?= $title  ?>
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
						<?php endwhile; ?>
					</div>
				<?php endif; ?>
			</div>
		</section>
<?php
	}
}
