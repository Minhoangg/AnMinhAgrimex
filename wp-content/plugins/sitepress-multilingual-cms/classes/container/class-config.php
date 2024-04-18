<?php

namespace WPML\Container;

use TranslationManagement;
use WP_Filesystem_Direct;
use WPML_Locale;
use WPML_Post_Status;
use WPML_Post_Translation;
use WPML_REST_Request_Analyze;
use WPML_REST_Request_Analyze_Factory;
use WPML_Term_Translation;
use WPML_URL_Converter;
use WPML_URL_Filters;

class Config {

	public static function getSharedInstances() {
		global $wpdb;

		return [
			$wpdb,
		];
	}

	public static function getSharedClasses() {
		return [
			'\SitePress',
			'\WPML\WP\OptionManager',
			'\WP_Http',
			'\WPML_WP_User_Query_Factory',
			'\WPML_WP_User_Factory',
			'\WPML_Notices',
			WPML_Locale::class,
			WPML_URL_Filters::class,
		];
	}

	public static function getAliases() {
		global $wpdb;

		$aliases = [];

		$wpdb_class = get_class( $wpdb );

		if ( 'wpdb' !== $wpdb_class ) {
			$aliases['wpdb'] = $wpdb_class;
		}

		return $aliases;
	}

	public static function getDelegated() {
		return [
			'\WPML_Notices'                   => 'wpml_get_admin_notices',
			WPML_REST_Request_Analyze::class => [ WPML_REST_Request_Analyze_Factory::class, 'create' ],
			WP_Filesystem_Direct::class      => 'wpml_get_filesystem_direct',
			WPML_Locale::class               => [ WPML_Locale::class, 'get_instance_from_sitepress' ],
			WPML_Post_Translation::class     => [ WPML_Post_Translation::class, 'getGlobalInstance' ],
			WPML_Term_Translation::class     => [ WPML_Term_Translation::class, 'getGlobalInstance' ],
			WPML_URL_Converter::class        => [ WPML_URL_Converter::class, 'getGlobalInstance' ],
			WPML_Post_Status::class          => 'wpml_get_post_status_helper',
			'\WPML_Language_Resolution'       => function () {
				global $wpml_language_resolution;

				return $wpml_language_resolution;
			},
			TranslationManagement::class     => 'wpml_load_core_tm',
		];
	}
}
