<?php

use WPML\Media\Duplication\AbstractFactory;
use function WPML\Container\make;

class WPML_Media_Attachments_Duplication_Factory extends AbstractFactory {

	public function create() {
		if ( self::shouldActivateHooks() ) {
			return make( WPML_Media_Attachments_Duplication::class );
		}

		return null;
	}
}
