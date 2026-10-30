<?php
/**
 * ELEMENTOR SAVE MEMORY
 * Elementor saves run with only 128M on this server. The Galerie save ran out of memory
 * ("Allowed memory size of 134217728 bytes exhausted" in class-wpdb.php, found 30.10.2026 with a
 * temporary recorder). For Elementor save requests by editors only, allow the server's 256M.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'admin_init',
	function () {
		// Clean up the entry the temporary recorder (v1.7.0–1.8.0) left behind.
		delete_option( 'hotel_westerburg_last_fatal' );

		if ( ! wp_doing_ajax() || ! isset( $_REQUEST['action'] ) || 'elementor_ajax' !== $_REQUEST['action'] || ! current_user_can( 'edit_posts' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}
		if ( wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) ) < 256 * MB_IN_BYTES ) {
			ini_set( 'memory_limit', '256M' ); // phpcs:ignore WordPress.PHP.IniSet.memory_limit_Disallowed
		}
	}
);
