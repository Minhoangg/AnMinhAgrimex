<?php

use WPML\Utils\DebugBackTrace;

class WPML_Elementor_Translate_IDs_Factory implements IWPML_Frontend_Action_Loader {

	public function create() {
		return new WPML_Elementor_Translate_IDs( new DebugBackTrace() );
	}
}
