<?php
/**
 * SEO RULES
 * Pages listed here are hidden from search engines:
 *   - a "noindex, follow" robots meta tag (via Rank Math),
 *   - removed from the Rank Math XML sitemap,
 *   - any "Disallow: /<slug>" line removed from robots.txt, so Google can read the noindex.
 *
 * To hide a page: add its slug. To make it indexable again: remove the slug and deploy.
 */

defined( 'ABSPATH' ) || exit;

/**
 * Slugs of pages that must not appear in Google.
 *
 * feedback        Internal staff feedback form, not for guests.
 * neujahrspackage Shows Halloween content by mistake; remove from this list once the New Year content is fixed.
 * sommerspas-abkuhlung-package  Summer package, off-season with no card on Unsere Packages. Remove from this
 *                 list next summer when its card is added back (also set it to "Index" in Rank Math).
 * danke-kontakt, danke-arrangement, danke-blaue-lagune  Thank-you pages after the enquiry forms; they only
 *                 count conversions for the new Google Ads campaigns and are not for search.
 */
function hotel_westerburg_noindex_slugs() {
	return array(
		'feedback',
		'neujahrspackage',
		'sommerspas-abkuhlung-package',
		'danke-kontakt',
		'danke-arrangement',
		'danke-blaue-lagune',
	);
}

/**
 * True when the current request is one of the hidden pages.
 */
function hotel_westerburg_is_noindex_page() {
	return is_page( hotel_westerburg_noindex_slugs() );
}

// Robots meta tag: noindex, but keep following links.
add_filter(
	'rank_math/frontend/robots',
	function ( $robots ) {
		if ( hotel_westerburg_is_noindex_page() ) {
			$robots['index']  = 'noindex';
			$robots['follow'] = 'follow';
		}
		return $robots;
	}
);

// Remove the hidden pages from the Rank Math sitemap.
add_filter(
	'rank_math/sitemap/entry',
	function ( $url, $type, $post ) {
		// Rank Math passes a plain row object (not WP_Post), so only rely on its fields.
		if ( 'post' === $type && is_object( $post ) && isset( $post->post_name, $post->post_type )
			&& 'page' === $post->post_type
			&& in_array( $post->post_name, hotel_westerburg_noindex_slugs(), true ) ) {
			return false;
		}
		return $url;
	},
	10,
	3
);

// robots.txt: drop "Disallow: /<slug>" lines for hidden pages. A blocked page cannot be read,
// so Google would never see its noindex tag.
add_filter(
	'robots_txt',
	function ( $output ) {
		foreach ( hotel_westerburg_noindex_slugs() as $slug ) {
			$output = preg_replace( '#^\s*Disallow:\s*/' . preg_quote( $slug, '#' ) . '/?\s*$\R?#mi', '', $output );
		}
		return $output;
	},
	999
);
