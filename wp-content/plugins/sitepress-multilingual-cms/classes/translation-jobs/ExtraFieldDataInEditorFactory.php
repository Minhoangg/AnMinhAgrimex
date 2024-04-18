<?php

namespace WPML\TM\Jobs;

use IWPML_Backend_Action_Loader;
use WPML_Custom_Field_Editor_Settings;
use WPML_Custom_Field_Setting_Factory;

class ExtraFieldDataInEditorFactory implements IWPML_Backend_Action_Loader {
	/**
	 * @return ExtraFieldDataInEditor
	 */
	public function create() {
		return new ExtraFieldDataInEditor(
			new WPML_Custom_Field_Editor_Settings(
				new WPML_Custom_Field_Setting_Factory( wpml_load_core_tm() )
			)
		);
	}


}
