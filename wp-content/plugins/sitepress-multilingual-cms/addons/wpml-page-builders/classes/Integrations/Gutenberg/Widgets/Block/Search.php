<?php


namespace WPML\PB\Gutenberg\Widgets\Block;


use IWPML_Frontend_Action;
use WPML\LIB\WP\Hooks;
use WPML\PB\Gutenberg\Integration;
use function WPML\FP\spreadArgs;

class Search implements IWPML_Frontend_Action, Integration {

	public function add_hooks() {
		global $sitepress;

		Hooks::onFilter( 'render_block_core/search' )
		     ->then( spreadArgs( [ $sitepress, 'get_search_form_filter' ] ) );
	}

}