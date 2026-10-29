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

// Booking bar on the homepage hero (Planet WBE search mask). The CSS used to sit inline in the
// Elementor HTML widget 7bd9229 on Home; it is printed in the footer so it keeps the same place
// in the cascade (after Elementor's CSS) as the inline block had.
add_action(
	'wp_footer',
	function () {
		if ( is_front_page() ) {
			wp_enqueue_style(
				'hotel-westerburg-booking-bar',
				HOTEL_WESTERBURG_URL . 'assets/css/booking-bar.css',
				array(),
				HOTEL_WESTERBURG_VERSION
			);
		}
	},
	1
);
