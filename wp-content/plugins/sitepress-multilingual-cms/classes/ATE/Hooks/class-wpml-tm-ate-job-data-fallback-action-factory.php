<?php

use function WPML\Container\make;

class WPML_TM_ATE_Job_Data_Fallback_Factory implements IWPML_Backend_Action_Loader, IWPML_REST_Action_Loader {
	/**
	 * @return WPML_TM_ATE_Job_Data_Fallback
	 */
	public function create() {
		return make( '\WPML_TM_ATE_Job_Data_Fallback' );
	}

}
