<?php

namespace WPML\PB\SiteOrigin;

use WPML_Page_Builders_Register_Strings;

class RegisterStrings extends WPML_Page_Builders_Register_Strings {

    public function register_strings_for_modules( array $data_array, array $package ) {
		foreach ( $data_array as $data ) {
			if ( isset( $data[ TranslatableNodes::SETTINGS_FIELD ] ) ) {
				$this->register_strings_for_node( $data[ TranslatableNodes::SETTINGS_FIELD ]['class'], $data, $package );
			} elseif ( is_array( $data ) ) {
				$this->register_strings_for_modules( $data, $package );
			}
		}
    }

}
