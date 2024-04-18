<?php

namespace WPML\TranslateLinkTargets;

use IWPML_Backend_Action_Loader;
use IWPML_Frontend_Action_Loader;
use WPML\LIB\WP\Hooks as WPHooks;
use WPML\LIB\WP\Post;
use WPML_Links_Fixed_Status_For_Posts;
use function WPML\FP\spreadArgs;

class Hooks implements IWPML_Backend_Action_Loader, IWPML_Frontend_Action_Loader {

	public function create() {
		return [ self::class, 'add_hooks' ];
	}

	public static function add_hooks() {
		WPHooks::onAction( 'wpml_pro_translation_completed', 10, 1 )
			   ->then( spreadArgs( [ self::class, 'clearStatus' ] ) );
	}

	public static function clearStatus( $postId ) {
		WPML_Links_Fixed_Status_For_Posts::clear( $postId, 'post_' . Post::getType( $postId ) );
	}
}
