<?php

namespace WPML\PostTranslation\SpecialPage;

use IWPML_Backend_Action;
use WP_Screen;
use WPML_Pre_Option_Page;

class Hooks implements IWPML_Backend_Action {

	public function add_hooks() {
		add_action( 'current_screen', [ $this, 'deleteCacheOnSettingPage' ] );
	}

	public function deleteCacheOnSettingPage( WP_Screen $currentScreen ) {
		if ( 'options-reading' === $currentScreen->id ) {
			WPML_Pre_Option_Page::clear_cache();
		}
	}
}