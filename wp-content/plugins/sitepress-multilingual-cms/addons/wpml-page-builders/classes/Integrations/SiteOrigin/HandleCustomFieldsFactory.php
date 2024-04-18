<?php

namespace WPML\PB\SiteOrigin;

use IWPML_AJAX_Action_Loader;
use IWPML_Backend_Action_Loader;
use IWPML_Frontend_Action_Loader;
use WPML_PB_Handle_Custom_Fields;

class HandleCustomFieldsFactory implements IWPML_Backend_Action_Loader, IWPML_AJAX_Action_Loader, IWPML_Frontend_Action_Loader {

	/**
	 * @return \WPML_PB_Handle_Custom_Fields
	 */
	public function create() {
		return new WPML_PB_Handle_Custom_Fields( new DataSettings() );
	}

}
