<?php

namespace WPML\TM\Menu\TranslationServices;

use IWPML_Backend_Action_Loader;
use WPML_TP_Client_Factory;

class ActivationAjaxFactory implements IWPML_Backend_Action_Loader {

	/**
	 * @return ActivationAjax
	 */
	public function create() {
		$tp_client_factory = new WPML_TP_Client_Factory();
		return new ActivationAjax( $tp_client_factory->create() );
	}
}
