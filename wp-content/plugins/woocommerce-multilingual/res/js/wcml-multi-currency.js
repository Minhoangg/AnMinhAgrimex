jQuery(function () {

	jQuery(document).on('click', '.wcml_currency_switcher a', wcml_switch_currency_handler);

});

var wcml_switch_currency_handler = function (event) {
	event.preventDefault();
	if (jQuery(this).is(':disabled') || jQuery(this).parent().hasClass('wcml-cs-active-currency') || jQuery(this).hasClass('wcml-cs-active-currency')) {
		return false;
	} else {
		jQuery(this).off(event);
	}

	wcml_load_currency(jQuery(this).attr('rel'));
}

function wcml_load_currency(currency, force_switch) {
	var ajax_loader = jQuery('<img class=\"wcml-spinner\" width=\"16\" heigth=\"16\" src=\"' + wcml_mc_settings.wcml_spinner + '\" />');
	jQuery('.wcml_currency_switcher').append(ajax_loader);

	if (typeof force_switch === 'undefined') force_switch = 0;

	jQuery.ajax({
		type: 'post',
		url: woocommerce_params.ajax_url,
		dataType: "json",
		data: {
			action: 'wcml_switch_currency',
			currency: currency,
			force_switch: force_switch,
			params: window.location.search.substr(1)
		},
		success: function (response) {
			if (typeof response.error !== 'undefined') {
				alert(response.error);
			} else if (typeof response.data.prevent_switching !== 'undefined') {
				jQuery('body').append(response.data.prevent_switching);
			} else {

				var target_location = window.location.href;
				if (-1 !== target_location.indexOf('#') || wcml_mc_settings.cache_enabled) {

					var url_dehash = target_location.split('#');
					var hash = url_dehash.length > 1 ? '#' + url_dehash[1] : '';

					target_location = url_dehash[0]
							.replace(/&wcmlc(\=[^&]*)?(?=&|$)|wcmlc(\=[^&]*)?(&|$)/, '')
							.replace(/\?$/, '');

					var url_glue = target_location.indexOf('?') != -1 ? '&' : '?';
					target_location += url_glue + 'wcmlc=' + currency + hash;

				}

				wcml_reset_cart_fragments();

				target_location = wcml_maybe_adjust_widget_price(target_location, response.data);

				window.location = target_location;
			}
		}
	});
}

function wcml_maybe_adjust_widget_price(target_location, response) {

	if (typeof response.min_price !== 'undefined') {
		target_location = target_location.replace(/(min_price=)(\d+)/, "$1" + response.min_price);
	}

	if (typeof response.max_price !== 'undefined') {
		target_location = target_location.replace(/(max_price=)(\d+)/, "$1" + response.max_price);
	}

	return target_location;
}
