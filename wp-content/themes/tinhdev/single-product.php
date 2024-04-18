<?php

remove_action(
	'woocommerce_after_single_product_summary',
	'woocommerce_output_related_products',
	20
);

add_filter('woocommerce_product_tabs', 'my_remove_reviews_tab');

function my_remove_reviews_tab($tabs)
{
	unset($tabs['reviews']);

	return $tabs;
}

// add_action('wp_footer', 'ts_quantity_plus_minus');


add_action('woocommerce_share', 'tinhdev_woocommerce_template_single_policy', 60);
function tinhdev_woocommerce_template_single_policy()
{
	$contact_us = get_field('dat_hang','option');

	var_dump($contact_us);
?>
	<button class="btn btn-primary w-25 my-2" data-toggle="modal" data-bs-toggle="modal" data-bs-target="#checkoutModal" data-bs-whatever="@mdo">
		<span><?= __('ĐẶT HÀNG', 'tinhdev') ?></span>
	</button>

	<div class="modal fade" id="checkoutModal" tabindex="-1" aria-labelledby="searchModal" aria-hidden="true" style="z-index: 9999">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-body">

					<?= do_shortcode($contact_us['form']) ?>
				</div>
			</div>
		</div>
	</div>
<?php
}

remove_action('genesis_loop', 'genesis_do_loop');
genesis();
