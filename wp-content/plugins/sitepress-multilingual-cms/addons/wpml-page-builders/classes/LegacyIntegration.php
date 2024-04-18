<?php

namespace WPML\PB;

use WPML\Compatibility\Divi\Builder;
use WPML\Compatibility\Divi\DisplayConditions;
use WPML\Compatibility\Divi\DiviOptionsEncoding;
use WPML\Compatibility\Divi\DoubleQuotes;
use WPML\Compatibility\Divi\DynamicContent;
use WPML\Compatibility\Divi\Hooks\Editor;
use WPML\Compatibility\Divi\Search;
use WPML\Compatibility\Divi\ThemeBuilderFactory;
use WPML\Compatibility\Divi\TinyMCE;
use WPML\Compatibility\FusionBuilder\Backend\Hooks;
use WPML\Compatibility\FusionBuilder\FormContent;
use WPML\Compatibility\WPBakery\Styles;
use WPML_Action_Filter_Loader;
use WPML_Compatibility_Divi;
use WPML_Compatibility_Plugin_Fusion_Hooks_Factory;
use WPML_Compatibility_Plugin_Visual_Composer;
use WPML_Compatibility_Plugin_Visual_Composer_Grid_Hooks;
use WPML_Compatibility_Theme_Enfold;
use WPML_Debug_BackTrace;
use WPML_Translation_Element_Factory;
use function WPML\Container\make;

class LegacyIntegration {

	public static function load() {
		/** @var \SitePress $sitepress */
		global $sitepress;

		$integrationClasses = [];

		// WPBakery Page Builder (a.k.a. Visual Composer).
		if ( defined( 'WPB_VC_VERSION' ) ) {
			$wpml_visual_composer = new WPML_Compatibility_Plugin_Visual_Composer( new WPML_Debug_BackTrace( null, 12 ) );
			$wpml_visual_composer->add_hooks();

			$wpml_visual_composer_grid = new WPML_Compatibility_Plugin_Visual_Composer_Grid_Hooks(
				$sitepress,
				new WPML_Translation_Element_Factory( $sitepress )
			);
			$wpml_visual_composer_grid->add_hooks();

			make( Styles::class )->add_hooks();
		}

		if ( defined( 'FUSION_BUILDER_VERSION' ) ) {
			$integrationClasses[] = WPML_Compatibility_Plugin_Fusion_Hooks_Factory::class;
			$integrationClasses[] = \WPML\Compatibility\FusionBuilder\Frontend\Hooks::class;
			$integrationClasses[] = Hooks::class;
			$integrationClasses[] = \WPML\Compatibility\FusionBuilder\DynamicContent::class;
			$integrationClasses[] = FormContent::class;
			$integrationClasses[] = \WPML\Compatibility\FusionBuilder\Hooks\Editor::class;
		}

		if ( function_exists( 'avia_lang_setup' ) ) {
			// phpcs:disable WordPress.NamingConventions.ValidVariableName
			global $iclTranslationManagement;
			$enfold = new WPML_Compatibility_Theme_Enfold( $iclTranslationManagement );
			// phpcs:enable
			$enfold->init_hooks();
		}

		if ( defined( 'ET_BUILDER_THEME' ) || defined( 'ET_BUILDER_PLUGIN_VERSION' ) ) {
			$integrationClasses[] = WPML_Compatibility_Divi::class;
			$integrationClasses[] = DynamicContent::class;
			$integrationClasses[] = Search::class;
			$integrationClasses[] = DiviOptionsEncoding::class;
			$integrationClasses[] = ThemeBuilderFactory::class;
			$integrationClasses[] = Builder::class;
			$integrationClasses[] = TinyMCE::class;
			$integrationClasses[] = DisplayConditions::class;
			$integrationClasses[] = DoubleQuotes::class;
			$integrationClasses[] = Editor::class;
		}

		$loader = new WPML_Action_Filter_Loader();
		$loader->load( $integrationClasses );
	}
}
