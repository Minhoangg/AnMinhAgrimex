<?php

namespace WPML\TranslationRoles;

use WPML_Manage_Translations_Role;

class RemoveManager extends Remove {
	protected static function getCap() {
		return WPML_Manage_Translations_Role::CAPABILITY;
	}
}
