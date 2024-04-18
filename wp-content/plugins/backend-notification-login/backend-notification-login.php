<?php
/**
 * Plugin Name:       Auth Notification Website For Telegram
 * Plugin URI:        https://tinhdev.com/my-plugin/
 * Description:       Plugin này được viết với mục đích làm chơi không có ý nghĩa gì hết
 * Version:           1.0.1
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Phan Văn Tính
 * Author URI:        https://tinhdev.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Update URI:        https://tinhdev.com/my-plugin/
 * Text Domain:       backend-notification-login
 */


require __DIR__ . '/vendor/autoload.php';

use Tino\BackendNotificationLoginSetting;
use Tino\BackendNotificationLogin;

new BackendNotificationLoginSetting;

/**
 * @param $user_login
 * @param $user
 *
 * @return void
 */
function custom_login_function( $user_login, $user ) {
	$user_login = $user->data->user_email;
	$text       = 'Người dùng ' . $user_login . ' đã đăng nhập vào website ' . get_home_url() . ' với ip ' . BackendNotificationLogin::get_the_user_ip();
	$bot_id     = get_option( 'bnl_telegram_bot_id' );
	$chat_id    = get_option( 'bnl_telegram_chat_id' );
	if ( ! empty( $bot_id ) && ! empty( $chat_id ) ) {
		$curl = curl_init();
		curl_setopt_array( $curl, array(
			CURLOPT_URL            => 'https://api.telegram.org/bot' . $bot_id . '/sendMessage?chat_id=' . $chat_id . '&text=' . $text,
			CURLOPT_RETURNTRANSFER => true,
			CURLOPT_ENCODING       => '',
			CURLOPT_MAXREDIRS      => 10,
			CURLOPT_TIMEOUT        => 0,
			CURLOPT_FOLLOWLOCATION => true,
			CURLOPT_HTTP_VERSION   => CURL_HTTP_VERSION_1_1,
			CURLOPT_CUSTOMREQUEST  => 'POST',
		) );
		curl_exec( $curl );
		curl_close( $curl );
	}
}

add_action( 'wp_login', 'custom_login_function', 10, 2 );
