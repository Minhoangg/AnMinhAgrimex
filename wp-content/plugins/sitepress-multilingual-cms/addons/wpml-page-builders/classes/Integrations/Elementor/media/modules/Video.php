<?php

namespace WPML\PB\Elementor\Media\Modules;

use WPML_Elementor_Media_Node_With_Image_Property;

class Video extends WPML_Elementor_Media_Node_With_Image_Property {

	public function get_property_name() {
		return 'image_overlay';
	}
}