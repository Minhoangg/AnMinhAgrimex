<?php

namespace WPML\REST\XMLConfig\Custom;


use WPML_Config;
use WPML_Custom_XML;
use WPML_REST_Factory_Loader;
use WPML_XML_Config_Validate;

class Factory extends WPML_REST_Factory_Loader {
	public function create() {
		return new Actions( new WPML_Custom_XML(), new WPML_XML_Config_Validate( WPML_Config::PATH_TO_XSD ) );
	}
}
