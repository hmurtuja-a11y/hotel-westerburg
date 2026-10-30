<?php
/**
 * TEMPORARY DIAGNOSTICS
 * Records the PHP fatal error that breaks the Elementor "Update" of the Galerie page (HTTP 500),
 * because the server error log is only reachable in cPanel. Only runs for logged-in editors during
 * Elementor's save request, stores one entry (message, file, line, time) and shows it to admins
 * on the dashboard. Remove this file and its require line once the cause is known.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'admin_init',
	function () {
		if ( ! wp_doing_ajax() || ! isset( $_REQUEST['action'] ) || 'elementor_ajax' !== $_REQUEST['action'] || ! current_user_can( 'edit_posts' ) ) { // phpcs:ignore WordPress.Security.NonceVerification
			return;
		}
		// Elementor saves run with only 128M here; the Galerie save ran out of memory
		// (30.10.2026, class-wpdb.php). Allow the server's 256M for editor saves only.
		if ( wp_convert_hr_to_bytes( ini_get( 'memory_limit' ) ) < 256 * MB_IN_BYTES ) {
			ini_set( 'memory_limit', '256M' ); // phpcs:ignore WordPress.PHP.IniSet.memory_limit_Disallowed
		}
		register_shutdown_function(
			function () {
				$error = error_get_last();
				if ( ! $error || ! in_array( $error['type'], array( E_ERROR, E_PARSE, E_CORE_ERROR, E_COMPILE_ERROR, E_USER_ERROR, E_RECOVERABLE_ERROR ), true ) ) {
					return;
				}
				update_option(
					'hotel_westerburg_last_fatal',
					array(
						'time'    => gmdate( 'Y-m-d H:i:s' ) . ' UTC',
						'message' => substr( $error['message'], 0, 2000 ),
						'file'    => str_replace( ABSPATH, '', $error['file'] ),
						'line'    => $error['line'],
						'memory'  => size_format( memory_get_peak_usage( true ) ) . ' of ' . ini_get( 'memory_limit' ),
					),
					false
				);
			}
		);
	}
);

add_action(
	'admin_notices',
	function () {
		$error = get_option( 'hotel_westerburg_last_fatal' );
		if ( ! $error || ! current_user_can( 'manage_options' ) ) {
			return;
		}
		printf(
			'<div class="notice notice-warning" id="hotel-westerburg-fatal"><p><strong>Hotel Westerburg diagnostics – last Elementor save error (%s)</strong><br><code>%s</code><br>%s:%d · peak memory %s</p></div>',
			esc_html( $error['time'] ),
			esc_html( $error['message'] ),
			esc_html( $error['file'] ),
			(int) $error['line'],
			esc_html( $error['memory'] )
		);
	}
);
