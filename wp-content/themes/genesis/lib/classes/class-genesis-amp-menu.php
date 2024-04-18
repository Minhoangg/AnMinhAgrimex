<?php
/**
 * Genesis Framework.
 *
 * WARNING: This file is part of the core Genesis Framework. DO NOT edit this file under any circumstances.
 * Please do all modifications in the form of a child theme.
 *
 * @package StudioPress\Genesis
 * @author  StudioPress
 * @license GPL-2.0-or-later
 * @link    https://my.studiopress.com/themes/genesis/
 */

/**
 * Genesis AMP Menu.
 *
 * @since 3.0.0
 */
class Genesis_AMP_Menu {

	/**
	 * Name of the active theme.
	 *
	 * @var string
	 */
	protected $theme_name;

	/**
	 * Array of responsive menu configuration parameters.
	 *
	 * @var array
	 */
	protected $responsive_config = [];

	/**
	 * Array of script configurations parameters.
	 *
	 * @var array
	 */
	protected $script_config;

	/**
	 * Array of extra configuration parameters.
	 *
	 * @var array
	 */
	protected $extras_config;

	/**
	 * Array of configuration parameters for the hamburger menu.
	 *
	 * @var array
	 */
	protected $hamburger_config;

	/**
	 * Indexer for the submenu.
	 *
	 * @var int
	 */
	private $submenu_index = 0;

	/**
	 * The data for submenu <amp-state> elements.
	 *
	 * There's only one <amp-state> for each submenu depth in a given menu.
	 * For example, all menu items with a depth of 0 will have the same <amp-state>.
	 * This allows collapsing another submenu when a submenu is expanded.
	 *
	 * @var array[][] {
	 *     The <amp-state> for a submenu.
	 *
	 *     @type string $id   The ID of the <amp-state>.
	 *     @type string $data The JSON data inside the <amp-state>.
	 * }
	 */
	private $submenu_states = [];

	/**
	 * The <amp-state> value for a submenu that is not expanded.
	 *
	 * @var int
	 */
	private $submenu_not_expanded = 0;

	/**
	 * Genesis_Responsive_Menu_Handler constructor.
	 *
	 * @since 0.1.0
	 *
	 * @param string $theme_name    Name of the active theme.
	 * @param array  $script_config Array of script configurations parameters.
	 * @param array  $extras_config Array of extra configuration parameters.
	 */
	public function __construct( $theme_name, array $script_config, array $extras_config ) {

		$this->theme_name    = $theme_name;
		$this->script_config = $script_config;
		$this->extras_config = $extras_config;

		$this->init_responsive_config();
		$this->init_hamburger_config();

	}

	/**
	 * Initialize responsive menu configurations to this format:
	 *
	 *      ID/class attribute => theme_location
	 */
	protected function init_responsive_config() {

		foreach ( $this->script_config['menuClasses'] as $menus ) {
			foreach ( $menus as $nav ) {
				$attribute                             = ltrim( $nav, '.' );
				$theme_location                        = ltrim( $nav, '.nav-' );
				$this->responsive_config[ $attribute ] = $theme_location;
			}
		}

	}

	/**
	 * Initialize the AMP menu's configuration parameters.
	 */
	protected function init_hamburger_config() {

		// Get the hamburger target menu, i.e. main menu.
		$theme_location = reset( $this->responsive_config );
		$target_menu    = key( $this->responsive_config );

		// Initialize the hamburger's configuration.
		$this->hamburger_config = [
			'theme_location'  => $theme_location,
			'label'           => $this->script_config['mainMenu'],
			'icon_closed'     => $this->script_config['menuIconClass'],
			'icon_opened'     => isset( $this->script_config['menuIconOpenedClass'] ) ? $this->script_config['menuIconOpenedClass'] : $this->script_config['menuIconClass'],
			'filter_location' => '',
			'state_id'        => $this->convert_to_camel_case( "{$target_menu}Expanded" ),
			'state'           => false,
		];

		if ( 'primary' === $theme_location ) {
			$filter_location = 'do_nav';
		} elseif ( 'secondary' === $theme_location ) {
			$filter_location = 'do_subnav';
		} else {
			$filter_location = "{$theme_location}_nav";
		}
		$this->hamburger_config['filter_location'] = $filter_location;

	}

	/**
	 * Hook into WordPress.
	 *
	 * @since 0.1.0
	 */
	public function add_hooks() {

		add_action( 'wp_enqueue_scripts', [ $this, 'add_custom_css' ], 20 );

		foreach ( $this->script_config['menuClasses'] as $combine_or_other ) {
			foreach ( $combine_or_other as $theme_location ) {
				$theme_location = ltrim( $theme_location, '.' );
				add_filter( "genesis_attr_{$theme_location}", [ $this, 'add_nav_class_attribute' ] );
			}
		}

		add_filter( "genesis_{$this->hamburger_config['filter_location']}", [ $this, 'add_hamburger_button' ] );
		add_filter( "genesis_attr_nav-{$this->hamburger_config['theme_location']}-toggle", [ $this, 'add_hamburger_attributes' ] );
		add_filter( "genesis_attr_nav-{$this->hamburger_config['theme_location']}", [ $this, 'add_hamburger_target_menu_attributes' ] );
		add_filter( 'walker_nav_menu_start_el', [ $this, 'add_nav_submenu_toggle' ], 10, 4 );
		add_filter( 'genesis_attr_sub-menu-toggle', [ $this, 'add_submenu_toggle_attributes' ], 10, 3 );
		add_action( 'genesis_after', [ $this, 'output_submenu_amp_states' ] );

	}

	/**
	 * Adds the menu's custom CSS to the child theme's stylesheet.
	 */
	public function add_custom_css() {

		$media_query = esc_attr( $this->extras_config['media_query_width'] );
		$extra       = $this->extras_config['css'];

		$css = sprintf(
			'
			/* Genesis+AMP responsive menu styles.
			--------------------------------------------- */
			@media only screen and (min-width: %1$s) {
				.menu-item.genesis-amp-combined { display: none }
			}

			@media only screen and (max-width: %1$s) {
				.header-menu .genesis-responsive-menu,
				.genesis-responsive-menu {
					display: block;
					position: absolute;
					left: -9999px;
					opacity: 0;
					-webkit-transform: scaleY(0);
					-moz-transform: scaleY(0);
					-ms-transform: scaleY(0);
					-o-transform: scaleY(0);
					transform: scaleY(0);
					transform-origin: top;
					-webkit-transition: transform 0.2s ease;
					-moz-transition: transform 0.2s ease;
					o-transition: transform 0.2s ease;
					transition: transform 0.2s ease;
				}

				.genesis-nav-menu.responsive-menu.toggled-on,
				.genesis-responsive-menu.toggled-on {
					opacity: 1;
					position: relative;
					left: auto;
					-webkit-transform: scaleY(1);
					-moz-transform: scaleY(1);
					-ms-transform: scaleY(1);
					-o-transform: scaleY(1);
					transform: scaleY(1);
				}

				.genesis-responsive-menu.toggled-on .menu-item .sub-menu,
				.genesis-responsive-menu.toggled-on .menu-item:hover > .sub-menu {
					display: none;
				}

				.genesis-responsive-menu.toggled-on .sub-menu-toggle.toggled-on + .sub-menu {
					display: block;
					width: 100%%;
					-webkit-transform: scaleY(1);
					-moz-transform: scaleY(1);
					-ms-transform: scaleY(1);
					-o-transform: scaleY(1);
					transform: scaleY(1);
				}

				%2$s

			}',
			$media_query,
			$extra
		);

		/**
		 * Filter the CSS output.
		 *
		 * @since 3.1.1
		 *
		 * @param string $css         The default CSS output.
		 * @param string $media_query The media query set in theme config.
		 * @param string $extra       The extra CSS set in theme config.
		 */
		$css = apply_filters( 'genesis_amp_menu_css', $css, $media_query, $extra );

		wp_add_inline_style( genesis_get_theme_handle(), $css );

	}

	/**
	 * Add 'genesis-responsive-menu' class attribute to the `<nav>` element.
	 *
	 * @since 0.1.0
	 *
	 * @param array $attributes Existing attributes for primary navigation element.
	 *
	 * @return array Amended attributes for primary navigation element.
	 */
	public function add_nav_class_attribute( array $attributes ) {

		$attributes['class'] .= ' genesis-responsive-menu';

		return $attributes;

	}

	/**
	 * Add the hamburger button's HTML to the nav.
	 *
	 * @since 0.1.0
	 *
	 * @param string $nav_output Opening container markup, nav, closing container markup.
	 *
	 * @return string
	 */
	public function add_hamburger_button( $nav_output ) {

		$nav_name     = "nav-{$this->hamburger_config['theme_location']}";
		$state_output = sprintf(
			'<amp-state id="%s"><script type="application/json">%s</script></amp-state>',
			esc_attr( $this->hamburger_config['state_id'] ),
			wp_json_encode( $this->hamburger_config['state'] )
		);

		$hamburger_output = genesis_markup(
			[
				'open'    => '<button %s>',
				'close'   => '</button>',
				'context' => "{$nav_name}-toggle",
				'content' => $this->hamburger_config['label'],
				'echo'    => false,
			]
		);

		return $state_output . $hamburger_output . $nav_output;

	}

	/**
	 * Add the hamburger attributes.
	 *
	 * @param array $attributes Array of attributes.
	 *
	 * @return array Amended array of attributes.
	 */
	public function add_hamburger_attributes( array $attributes ) {

		$hamburger_state_id   = esc_attr( $this->hamburger_config['state_id'] );
		$closed_icon_classes  = esc_attr( $this->hamburger_config['icon_closed'] );
		$opened_icon_classes  = esc_attr( $this->hamburger_config['icon_opened'] );
		$submenu_state_id     = esc_attr( $this->get_submenu_state_id( 0 ) );
		$submenu_on_attribute = sprintf( '%1$s: !%2$s ? %1$s : %3$s', $submenu_state_id, $hamburger_state_id, $this->submenu_not_expanded );

		$attributes['id']            = 'genesis-mobile-nav-' . esc_attr( $this->hamburger_config['theme_location'] );
		$attributes['class']         = "menu-toggle {$closed_icon_classes}";
		$attributes['aria-controls'] = "{$this->hamburger_config['theme_location']}-menu";
		$attributes['aria-expanded'] = 'false';
		$attributes['aria-pressed']  = 'false';

		// Add the AMP event bindings.
		$attributes['on']              = sprintf( 'tap:AMP.setState( { %1$s: !%1$s, %2$s } )', $hamburger_state_id, $submenu_on_attribute );
		$attributes['[class]']         = "{$hamburger_state_id} ? 'menu-toggle {$opened_icon_classes}' : 'menu-toggle {$closed_icon_classes}'";
		$attributes['[aria-expanded]'] = "{$hamburger_state_id} ? 'true' : 'false'";
		$attributes['[aria-pressed]']  = $attributes['[aria-expanded]'];

		return $attributes;
	}

	/**
	 * Add attributes for the hamburger button's target navigation menu.
	 *
	 * @param array $attributes Array of attributes.
	 *
	 * @return array Amended array of attributes.
	 */
	public function add_hamburger_target_menu_attributes( array $attributes ) {

		$attributes['[class]'] = "'{$attributes['class']}' + ( {$this->hamburger_config['state_id']} ? ' toggled-on' : '' )";

		return $attributes;

	}

	/**
	 * Add toggle buttons to the submenus that are in the target menu.
	 *
	 * @since 0.1.0
	 *
	 * @param string   $item_output The menu item's starting HTML output.
	 * @param WP_Post  $item        Menu item data object.
	 * @param int      $depth       Depth of menu item. Used for padding.
	 * @param stdClass $args        An object of wp_nav_menu() arguments.
	 *
	 * @return string Amended HTML output when target menu.
	 */
	public function add_nav_submenu_toggle( $item_output, $item, $depth, $args ) {

		// Skip when not a responsive nav.
		if ( ! in_array( $args->theme_location, $this->responsive_config, true ) ) {
			return $item_output;
		}

		// Skip when the item has no sub-menu.
		if ( ! in_array( 'menu-item-has-children', $item->classes, true ) ) {
			return $item_output;
		}

		// Generate a unique submenu index.
		$this->submenu_index++;

		// Generate a unique state ID for the submenu level.
		$state_id = $this->get_submenu_state_id( $depth );

		/*
		 * There is only one <amp-state> for each submenu depth in a given menu.
		 * For example, menu items with a depth of 0 will share an <amp-state>.
		 */
		$current_menu_exists = in_array( 'current-menu-ancestor', $item->classes, true );
		if ( ! isset( $this->submenu_states[ $state_id ] ) ) {
			$this->submenu_states[ $state_id ] = $current_menu_exists ? $this->submenu_index : $this->submenu_not_expanded;
		} elseif ( $current_menu_exists ) {
			$this->submenu_states[ $state_id ] = $this->submenu_index;
		}

		// Create the toggle button.
		$item_output .= genesis_markup(
			[
				'open'           => '<button %s>',
				'close'          => '</button>',
				'context'        => 'sub-menu-toggle',
				'content'        => sprintf( '<span class="screen-reader-text">%s</span>', esc_html__( 'Submenu', 'genesis' ) ),
				'echo'           => false,
				'state_id'       => $state_id,
				'theme_location' => $args->theme_location,
				'submenu_index'  => $this->submenu_index,
			]
		);

		return $item_output;

	}

	/**
	 * Add attributes to the submenu toggle.
	 *
	 * @since 0.1.0
	 *
	 * @param array  $attributes Array of attributes.
	 * @param string $context    The given context (not used).
	 * @param array  $args       Array of arguments.
	 *
	 * @return array Amended array of attributes.
	 */
	public function add_submenu_toggle_attributes( $attributes, $context, $args ) {

		$state_id      = esc_attr( $args['state_id'] );
		$submenu_index = esc_attr( $args['submenu_index'] );
		$classes       = isset( $attributes['class'] ) ? $attributes['class'] : $context;
		$classes       = esc_attr( "{$classes} {$this->script_config['subMenuIconClass']}" );

		$attributes['class']         = $classes;
		$attributes['aria-expanded'] = 'false';
		$attributes['aria-pressed']  = 'false';

		/*
		 * Add the AMP event bindings.
		 * In the 'on' attribute, toggle between the $submenu_index and 0 (not expanded).
		 * There can only be one menu item in each menu depth expanded at a time.
		 * For example, if there are 4 primary menu items, only one of them can have its submenu expanded.
		 */
		$attributes['on']              = "tap:AMP.setState( { {$state_id}: {$state_id} == {$submenu_index} ? {$this->submenu_not_expanded} : {$submenu_index} } )";
		$attributes['[class]']         = "{$state_id} == {$submenu_index} ? '{$classes} activated toggled-on' : '{$classes}'";
		$attributes['[aria-expanded]'] = "{$state_id} == {$submenu_index} ? 'true' : 'false'";
		$attributes['[aria-pressed]']  = $attributes['[aria-expanded]'];

		return $attributes;

	}

	/**
	 * Convert the given string into camelCase, which is used by JavaScript for targeting state controls.
	 *
	 * @param string $string String to convert.
	 *
	 * @return string camelCase string.
	 */
	protected function convert_to_camel_case( $string ) {

		return preg_replace_callback(
			'/[_,-](.?)/',
			static function( $matches ) {
				return strtoupper( $matches[1] );
			},
			$string
		);

	}

	/**
	 * Get the <amp-state> ID for a submenu, given its depth.
	 *
	 * @param int $depth The depth of the submenu.
	 *
	 * @return string The <amp-state> ID for the submenu.
	 */
	public function get_submenu_state_id( $depth ) {

		return $this->convert_to_camel_case( "nav-{$this->hamburger_config['theme_location']}SubmenuExpanded{$depth}Depth" );

	}

	/**
	 * Output the <amp-state> for each submenu level.
	 */
	public function output_submenu_amp_states() {

		foreach ( $this->submenu_states as $id => $value ) {
			printf(
				'<amp-state id="%s"><script type="application/json">%s</script></amp-state>',
				esc_attr( $id ),
				wp_json_encode( $value )
			);
		}

	}

}
