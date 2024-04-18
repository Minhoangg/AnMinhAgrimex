<?php

use function WPML\Container\make;

class WPML_TM_REST_ATE_API_Factory extends WPML_REST_Factory_Loader {

	/**
	 * @return \WPML_TM_REST_ATE_API
	 * @throws \Auryn\InjectionException
	 */
	public function create() {
		return make( '\WPML_TM_REST_ATE_API' );
	}
}
