<?php

class WCML_Compatibility {

	/**
	 * SitePress object.
	 *
	 * @var SitePress
	 */
	private $sitepress;
	/**
	 * Woocommerce_WPML object.
	 *
	 * @var woocommerce_wpml
	 */
	private $woocommerce_wpml;
	/**
	 * Database object.
	 *
	 * @var wpdb
	 */
	private $wpdb;
	/**
	 * Element Translation Package.
	 *
	 * @var WPML_Element_Translation_Package
	 */
	private $tp;
	/**
	 * WPML Post Translation.
	 *
	 * @var WPML_Post_Translation
	 */
	private $wpml_post_translations;

	public function __construct(
		SitePress                        $sitepress,
		woocommerce_wpml                 $woocommerce_wpml,
		wpdb                             $wpdb,
		WPML_Element_Translation_Package $tp,
		WPML_Post_Translation            $wpml_post_translations
	) {
		$this->sitepress              = $sitepress;
		$this->woocommerce_wpml       = $woocommerce_wpml;
		$this->wpdb                   = $wpdb;
		$this->tp                     = $tp;
		$this->wpml_post_translations = $wpml_post_translations;
		$this->init();
	}

	/**
	 * Initialize class
	 */
	public function init() {
		// hardcoded list of extensions and check which ones the user has and then include the corresponding file from the ‘compatibility’ folder.
		global $woocommerce;

		// WooCommerce Tab Manager plugin.
		if ( class_exists( 'WC_Tab_Manager' ) ) {
			$tab_manager = new WCML_Tab_Manager( $this->sitepress, $woocommerce, $this->woocommerce_wpml, $this->wpdb, $this->tp );
			$tab_manager->add_hooks();
		}

		// WooCommerce Table Rate Shipping plugin.
		if ( defined( 'TABLE_RATE_SHIPPING_VERSION' ) ) {
			$table_rate_shipping = new WCML_Table_Rate_Shipping( $this->sitepress, $this->woocommerce_wpml, $this->wpdb );
			$table_rate_shipping->add_hooks();
		}

		// WooCommerce Subscriptions.
		if ( class_exists( 'WC_Subscriptions' ) ) {
			$wp_subscriptions = new WCML_WC_Subscriptions( $this->woocommerce_wpml, $this->wpdb );
			$wp_subscriptions->add_hooks();
		}

		// WooCommerce Name Your Price.
		if ( class_exists( 'WC_Name_Your_Price' ) ) {
			$name_your_price = new WCML_WC_Name_Your_Price();
		}

		// Product Bundle.
		if ( class_exists( 'WC_Product_Bundle' ) && function_exists( 'WC_PB' ) ) {
			$product_bundle_items = new WCML_WC_Product_Bundles_Items();
			new WCML_Product_Bundles( $this->sitepress, $this->woocommerce_wpml, $product_bundle_items, $this->wpdb );
		}

		// WooCommerce Variation Swatches and Photos.
		if ( class_exists( 'WC_SwatchesPlugin' ) ) {
			$variation_sp = new WCML_Variation_Swatches_And_Photos( $this->woocommerce_wpml );
			$variation_sp->add_hooks();
		}

		// Product Add-ons.
		if ( defined( 'WC_PRODUCT_ADDONS_VERSION' ) || class_exists( 'Product_Addon_Display' ) ) {
			$product_addons = new WCML_Product_Addons( $this->sitepress, $this->woocommerce_wpml );
			$product_addons->add_hooks();
		}

		// Product Per Product Shipping.
		if ( defined( 'PER_PRODUCT_SHIPPING_VERSION' ) ) {
			new WCML_Per_Product_Shipping();
		}
		// Store Exporter plugin.
		if ( defined( 'WOO_CE_PATH' ) ) {
			$wc_exporter = new WCML_wcExporter( $this->sitepress, $this->woocommerce_wpml );
			$wc_exporter->add_hooks();
		}

		// Gravity Forms.
		if ( class_exists( 'GFForms' ) ) {
			$gravityforms = new WCML_gravityforms( $this->sitepress, $this->woocommerce_wpml );
			$gravityforms->add_hooks();
		}

		// Sensei WooThemes.
		if ( class_exists( 'WooThemes_Sensei' ) ) {
			$sensei = new WCML_Sensei(
				$this->sitepress,
				$this->wpdb,
				new WPML_Custom_Columns( $this->sitepress )
			);
			$sensei->add_hooks();
		}

		// Extra Product Options.
		if ( class_exists( 'TM_Extra_Product_Options' ) ) {
			new WCML_Extra_Product_Options();
		}

		// Dynamic Pricing.
		if ( class_exists( 'WC_Dynamic_Pricing' ) ) {
			$dynamic_pricing = new WCML_Dynamic_Pricing( $this->sitepress );
			$dynamic_pricing->add_hooks();
		}

		// WooCommerce Bookings.
		if ( defined( 'WC_BOOKINGS_VERSION' ) && version_compare( WC_BOOKINGS_VERSION, '1.7.8', '>=' ) ) {
			$bookings = new WCML_Bookings( $this->sitepress, $this->woocommerce_wpml, $woocommerce, $this->wpdb, $this->tp, $this->wpml_post_translations );
			$bookings->add_hooks();

			// WooCommerce Accommodation Bookings.
			if ( defined( 'WC_ACCOMMODATION_BOOKINGS_VERSION' ) ) {
				new WCML_Accommodation_Bookings( $this->woocommerce_wpml, $bookings );
			}
		}

		// WOOBE WooCommerce Bulk Editor.
		if ( defined( 'WOOBE_PATH' ) ) {
			$woobe = new WCML_Woobe( $this->sitepress, $this->wpml_post_translations );
			$woobe->add_hooks();
		}

		// WooCommerce Checkout Field Editor.
		if ( function_exists( 'woocommerce_init_checkout_field_editor' ) ) {
			$checkout_field_editor = new WCML_Checkout_Field_Editor();
			$checkout_field_editor->add_hooks();
		}

		if ( class_exists( 'WC_Bulk_Stock_Management' ) ) {
			new WCML_Bulk_Stock_Management();
		}

		// WooCommerce Advanced Ajax Layered Navigation.
		require_once ABSPATH . 'wp-admin/includes/plugin.php';
		if ( is_plugin_active( 'woocommerce-ajax-layered-nav/ajax_layered_nav-widget.php' ) ) {
			new WCML_Ajax_Layered_Nav_Widget();
		}

		// woocommerce composite products.
		if ( isset( $GLOBALS['woocommerce_composite_products'] ) ) {
			$wc_composite_products = new WCML_Composite_Products( $this->sitepress, $this->woocommerce_wpml, $this->tp );
			$wc_composite_products->add_hooks();
		}

		if ( class_exists( 'WC_Checkout_Add_Ons_Loader' ) ) {
			$wc_checkout_addons = new WCML_Checkout_Addons();
			$wc_checkout_addons->add_hooks();
		}

		if ( class_exists( 'WC_Mix_and_Match' ) ) {
			new WCML_Mix_and_Match_Products();
		}

		if ( defined( 'WPSEO_VERSION' ) ) {
			new WCML_WPSEO();
		}

		// Adventure Tours theme.
		if ( function_exists( 'adventure_tours_check' ) ) {
			$adventure_tours = new WCML_Adventure_tours( $this->woocommerce_wpml, $this->sitepress, $this->tp );
			$adventure_tours->add_hooks();
		}

		// flatsome theme.
		if ( wp_get_theme()->get( 'Name' ) === 'Flatsome' ) {
			new WCML_Flatsome();
		}

		// Aurum Theme.
		if ( wp_get_theme()->get( 'Name' ) === 'Aurum' ) {
			new WCML_Aurum();
		}

		// WooCommerce Show Single Variations.
		if ( defined( 'JCK_WSSV_PATH' ) ) {
			new WCML_JCK_WSSV();
		}

		// WooCommerce Print Invoices.
		if ( class_exists( 'WC_PIP' ) ) {
			new WCML_Pip();
		}

		// The Events Calendar.
		if ( class_exists( 'Tribe__Events__Main' ) ) {
			new WCML_The_Events_Calendar( $this->sitepress, $this->woocommerce_wpml );
		}

		// Klarna Gateway.
		if ( class_exists( 'WC_Gateway_Klarna' ) ) {
			$klarna_gateway = new WCML_Klarna_Gateway();
			$klarna_gateway->add_hooks();
		}

		// YITH_WCQV.
		if ( class_exists( 'YITH_WCQV' ) ) {
			$yith_wcqv = new WCML_YITH_WCQV();
			$yith_wcqv->add_hooks();
		}

		// Woocommerce Memberships.
		if ( class_exists( 'WC_Memberships' ) ) {
			$wc_memberships = new WCML_WC_Memberships( $this->sitepress->get_wp_api() );
			$wc_memberships->add_hooks();
		}

		// MaxStore-Pro Theme.
		if ( function_exists( 'maxstore_pro_setup' ) ) {
			$maxstore = new WCML_MaxStore();
			$maxstore->add_hooks();
		}

		// WPBakery Page Builder.
		if ( defined( 'WPB_VC_VERSION' ) ) {
			$wpb_vc = new WCML_Wpb_Vc();
			$wpb_vc->add_hooks();
		}

		// WOOF Woocommerce Product Filter.
		if ( defined( 'WOOF_PLUGIN_NAME' ) ) {
			$woof_product_filter = new WCML\Compatibility\WOOF\WooCommerceProductFilter();
			$woof_product_filter->addHooks();
		}

		// Relevanssi plugin.
		if ( function_exists( 'relevanssi_insert_edit' ) ) {
			$relevanssi = new WCML_Relevanssi();
			$relevanssi->add_hooks();
		}

		// Woo Variations Table.
		if ( defined( 'WOO_VARIATIONS_TABLE_VERSION' ) ) {
			$wpb_woo_var_table = new WCML_Woo_Var_Table( $this->sitepress->get_current_language() );
			$wpb_woo_var_table->add_hooks();
		}

		// LiteSpeed Cache.
		if ( class_exists( 'LiteSpeed_Cache' ) ) {
			$litespeed_cache = new WCML_LiteSpeed_Cache();
			$litespeed_cache->add_hooks();
		}

		// WpFastest Cache.
		if ( class_exists( 'WpFastestCache' ) ) {
			$wpfastestcache = new WCML_WpFastest_Cache();
			$wpfastestcache->add_hooks();
		}

		// WooCommerce Product Type Column.
		if ( class_exists( 'WC_Product_Type_Column' ) ) {
			$wc_type_column = new WCML_WC_Product_Type_Column();
			$wc_type_column->add_hooks();
		}

		// Custom Product Tabs PRO.
		if ( class_exists( 'YIKES_Custom_Product_Tabs' ) ) {
			$custom_product_tabs = new WCML_YIKES_Custom_Product_Tabs( $this->woocommerce_wpml, $this->sitepress, $this->tp );
			$custom_product_tabs->add_hooks();
		}

		// WooCommerce Order Status Manager.
		if ( class_exists( 'WC_Order_Status_Manager' ) ) {
			$wc_order_status_manager = new WCML_Order_Status_Manager( new WP_Query() );
			$wc_order_status_manager->add_hooks();
		}

	}

}
