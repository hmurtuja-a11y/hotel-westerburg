<?php
/**
 * PHP LOGIC
 * General WordPress hooks (actions and filters) for the site.
 * Add custom PHP behaviour here, or create a new file in /includes for a bigger feature
 * and load it from hotel-westerburg.php.
 */

defined( 'ABSPATH' ) || exit;

// Load translations from /languages (e.g. hotel-westerburg-de_DE.mo).
add_action(
	'init',
	function () {
		load_plugin_textdomain( 'hotel-westerburg', false, dirname( plugin_basename( HOTEL_WESTERBURG_PATH . 'hotel-westerburg.php' ) ) . '/languages' );
	}
);

// Remove the WordPress emoji script and styles from the front end (~6 KB per page, printed twice).
// Browsers show emoji natively. Each hook is looked up with its real priority, so this works
// whichever hook this WordPress version uses. Undo: delete this block and deploy.
add_action(
	'init',
	function () {
		$hooks = array(
			'wp_head'                 => 'print_emoji_detection_script',
			'wp_footer'               => 'print_emoji_detection_script',
			'wp_print_footer_scripts' => 'print_emoji_detection_script',
			'wp_print_styles'         => 'print_emoji_styles',
			'wp_enqueue_scripts'      => 'wp_enqueue_emoji_styles',
		);
		foreach ( $hooks as $hook => $callback ) {
			$priority = has_action( $hook, $callback );
			if ( false !== $priority ) {
				remove_action( $hook, $callback, $priority );
			}
		}
	}
);
