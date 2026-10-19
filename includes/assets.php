<?php
/**
 * CSS / JS LOADER
 * Tells WordPress to load assets/css/frontend.css and assets/js/frontend.js on every front-end page.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'wp_enqueue_scripts',
	function () {
		wp_enqueue_style(
			'hotel-westerburg',
			HOTEL_WESTERBURG_URL . 'assets/css/frontend.css',
			array(),
			HOTEL_WESTERBURG_VERSION
		);

		wp_enqueue_script(
			'hotel-westerburg',
			HOTEL_WESTERBURG_URL . 'assets/js/frontend.js',
			array(),
			HOTEL_WESTERBURG_VERSION,
			true // Load in the footer so it doesn't slow down page rendering.
		);
	}
);
