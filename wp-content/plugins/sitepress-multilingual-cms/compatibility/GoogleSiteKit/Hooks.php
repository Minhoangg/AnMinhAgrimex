<?php

namespace WPML\Compatibility\GoogleSiteKit;

use IWPML_Backend_Action;
use WPML_URL_Filters;
use function WPML\Container\make;

class Hooks implements IWPML_Backend_Action {

	public function add_hooks() {
		add_filter( 'googlesitekit_canonical_home_url', [ $this, 'getCanonicalHomeUrl' ] );
	}

	/**
	 * @return string
	 */
	public function getCanonicalHomeUrl() {
		$wpml_url_filters = make( WPML_URL_Filters::class );

		$wpml_url_filters->remove_global_hooks();
		$unfilteredHomeUrl = home_url();
		$wpml_url_filters->add_global_hooks();

		return $unfilteredHomeUrl;
	}
}
