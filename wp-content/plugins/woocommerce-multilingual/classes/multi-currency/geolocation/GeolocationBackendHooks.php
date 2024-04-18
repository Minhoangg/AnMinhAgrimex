<?php

namespace WCML\MultiCurrency;

use IWPML_Backend_Action;

class GeolocationBackendHooks implements IWPML_Backend_Action {

	public function add_hooks() {
		add_filter( 'wcml_geolocation_is_used', [ Geolocation::class, 'isUsed' ] );
	}
}
