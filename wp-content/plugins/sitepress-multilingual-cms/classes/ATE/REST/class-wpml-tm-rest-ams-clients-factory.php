<?php

use function WPML\Container\make;

class WPML_TM_REST_AMS_Clients_Factory extends WPML_REST_Factory_Loader {

	/**
	 * @return \WPML_TM_REST_AMS_Clients
	 * @throws \Auryn\InjectionException
	 */
	public function create() {
		return make( '\WPML_TM_REST_AMS_Clients' );
	}
}
