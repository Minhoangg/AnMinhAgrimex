<?php

namespace Tino;

class BackendNotificationLoginSetting {
	public function __construct() {
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'menu_item_sub' ), 10, 2 );
		add_action( 'wp_update_nav_menu_item', array( $this, 'save_menu_item_sub' ), 10, 2 );
		add_action( 'admin_menu', array( $this, 'plugin_settings_menu_page' ) );
		add_action( 'admin_init', array( $this, 'plugin_register_settings' ) );
	}

	/**
	 * @return void
	 */
	public function plugin_settings_menu_page() {
		add_menu_page(
			__( 'Telegram Notification', 'backend-notification-login' ),
			__( 'Telegram Notification', 'backend-notification-login' ),
			'manage_options',
			'backend-notification-login',
			array( $this, 'plugin_settings_page_content' )
		);
	}

	/**
	 * @return void
	 */
	public function plugin_settings_page_content() { ?>
        <form action="options.php" method="post">
			<?php
			do_settings_sections( 'options_page' );
			settings_fields( 'option_group' );
			submit_button( __( 'Lưu lại', 'backend-notification-login' ) );
			?>
        </form>
		<?php
	}

	/**
	 * @return void
	 */
	public function plugin_register_settings() {
		register_setting( 'option_group', 'bnl_telegram_chat_id' );
		register_setting( 'option_group', 'bnl_telegram_bot_id' );
		add_settings_section(
			'section_id',
			__( 'Cài đặt thông báo đăng nhập cho Telegram', 'backend-notification-login' ),
			[],
			'options_page'
		);
		add_settings_field(
			'html_element',
			__( 'Nhập các thông tin sau để bật thông báo khi có người đăng nhập:', 'backend-notification-login' ),
			array( $this, 'render_field' ),
			'options_page',
			'section_id'
		);
	}


	/**
	 * @return void
	 */
	public function render_field() {
		$telegram_chat = get_option( 'bnl_telegram_chat_id' );
		$telegram_bot  = get_option( 'bnl_telegram_bot_id' );
		?>
        <div class="form-group">
            <label for="bnl_telegram_chat_id">Nhập Chat ID: </label>
            <input size="100" id="bnl_telegram_chat_id" placeholder="" type="text" name="bnl_telegram_chat_id"
                   value="<?= $telegram_chat ?? '' ?>"/>
        </div>
        <hr>
        <div class="form-group">
            <label for="bnl_telegram_bot_id">Nhập Bot ID: </label>
            <input size="100" id="bnl_telegram_bot_id" type="text" name="bnl_telegram_bot_id"
                   value="<?= $telegram_bot ?? '' ?>"/>
        </div>
        <hr>
        <div>
            <p>Hướng phát triển kế tiếp:</p>
            <ul>
                <li><strong>Backend: </strong>Xác thực BOT & Group Chat khi lưu trong backend có đúng hay chưa</li>
                <li><strong>Backend: </strong>Cập nhật lại giao diện trong backend</li>
                <li><strong>Backend: </strong>Phát triển song ngữ</li>
                <li><strong>Frontend: </strong>Cập nhật lại thông báo</li>
            </ul>
        </div>
		<?php
	}
}