<?php
/**
 * REDIRECTS
 * Sends page URLs written with capital letters to their lower-case address with a 301,
 * e.g. /Raeumlichkeiten/ -> /raeumlichkeiten/ and /Burg-Package/ -> /burg-package/.
 *
 * WordPress page slugs are always lower case, but WordPress still serves a page when the
 * URL uses capitals. That creates duplicate URLs for search engines. This rule removes them.
 *
 * Safety: only GET/HEAD requests on the public site, only when the lower-case path is an
 * existing published page, never for wp-admin, AJAX, REST, feeds, previews or files.
 */

defined( 'ABSPATH' ) || exit;

add_action(
	'template_redirect',
	function () {
		if ( is_admin() || wp_doing_ajax() || ( defined( 'REST_REQUEST' ) && REST_REQUEST ) || is_preview() || is_customize_preview() ) {
			return;
		}

		$method = isset( $_SERVER['REQUEST_METHOD'] ) ? strtoupper( $_SERVER['REQUEST_METHOD'] ) : 'GET';
		if ( 'GET' !== $method && 'HEAD' !== $method ) {
			return;
		}

		$uri  = isset( $_SERVER['REQUEST_URI'] ) ? wp_unslash( $_SERVER['REQUEST_URI'] ) : '';
		$path = (string) wp_parse_url( $uri, PHP_URL_PATH );

		// Nothing to do when the path is already lower case.
		if ( '' === $path || strtolower( $path ) === $path ) {
			return;
		}

		// Never touch WordPress system paths, files or percent-encoded paths (umlauts are encoded with capitals).
		if ( false !== strpos( $path, '%' ) || preg_match( '#^/(wp-|xmlrpc|feed)#i', $path ) || preg_match( '#\.[a-z0-9]{2,5}$#i', $path ) ) {
			return;
		}

		$page = get_page_by_path( trim( strtolower( $path ), '/' ) );
		if ( ! $page || 'publish' !== $page->post_status ) {
			return;
		}

		$target = get_permalink( $page );
		if ( ! $target ) {
			return;
		}

		$query = wp_parse_url( $uri, PHP_URL_QUERY );
		if ( $query ) {
			$target .= '?' . $query;
		}

		wp_safe_redirect( $target, 301 );
		exit;
	},
	1
);
