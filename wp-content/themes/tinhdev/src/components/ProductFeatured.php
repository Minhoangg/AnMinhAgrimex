<?php

namespace TinhDev\components;

use TinhDev\base\Base;
use TinhDev\base\BaseInterface;
use WP_Query;

class ProductFeatured extends Base implements BaseInterface
{

	public static function render()
	{
		$args         = [
			'posts_per_page' => 10, // Grabs all of the featured products. Limit if needed
			'post_type'      => 'product', // Ensures the post type is a product
			'post_status'    => 'publish', // Ensures the product is published
		];
		$list_product = new WP_Query($args);
		if ($list_product->have_posts()) : ?>

			<div class="container mb-3">
				<div class="d-flex justify-content-center align-items-center mb-3">
					<div class="intro-section">
						<h3 class="fw-bold text-center">SẢN PHẨM</h3>
						<div class="d-flex justify-content-center">
							<div class="contact_title_line">
								<img src="wp-content/themes/tinhdev/src/assets/images/logo_title.svg" alt="" class="logo-image">
							</div>
						</div>
					</div>
				</div>
				<div class="product-slide">
					<?php while ($list_product->have_posts()) : global $product;
						$list_product->the_post();
						setup_postdata($product);
						$ID    = get_the_ID();
						$img   = get_the_post_thumbnail_url($ID, 'full');
						$title = get_the_title($ID);
						$link  = get_permalink($ID);
						$product        = wc_get_product($ID);
						$max_percentage = parent::getProductPercentage($product)
					?>

						<div class="product-card">
							<div class="product-card-img">
								<img src="<?= $img ?>" alt="">
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
			</div>
<?php endif;
	}
}
