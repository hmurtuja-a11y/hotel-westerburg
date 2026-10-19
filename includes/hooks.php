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
