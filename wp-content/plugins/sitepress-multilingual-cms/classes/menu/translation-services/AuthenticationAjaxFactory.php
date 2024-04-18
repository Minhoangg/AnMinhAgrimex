<?php

namespace WPML\TM\Menu\TranslationServices;

use IWPML_Backend_Action_Loader;
use function WPML\Container\make;

class AuthenticationAjaxFactory implements IWPML_Backend_Action_Loader {
	/**
	 * @return AuthenticationAjax
	 */
	public function create() {
		return make( AuthenticationAjax::class );
	}
}
