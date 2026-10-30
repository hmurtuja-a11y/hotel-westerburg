<?php
/**
 * Plugin Name:       Hotel Westerburg
 * Plugin URI:        https://github.com/hmurtuja-a11y/hotel-westerburg
 * Description:       Custom functionality for Wasserschloss Westerburg (hotel-westerburg.de).
 * Version:           1.9.0
 * Requires at least: 6.0
 * Requires PHP:      7.4
 * Author:            H. Murtuja
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       hotel-westerburg
 * Domain Path:       /languages
 *
 * MAIN PLUGIN FILE
 * WordPress reads the header above to show the plugin in Plugins > Installed Plugins.
 * This file only defines constants and loads the files in /includes.
 */

// Stop the file from being opened directly in a browser.
defined( 'ABSPATH' ) || exit;

// Bump this on every release so browsers load the new CSS/JS instead of a cached copy.
define( 'HOTEL_WESTERBURG_VERSION', '1.9.0' );
define( 'HOTEL_WESTERBURG_PATH', plugin_dir_path( __FILE__ ) );
define( 'HOTEL_WESTERBURG_URL', plugin_dir_url( __FILE__ ) );

require_once HOTEL_WESTERBURG_PATH . 'includes/hooks.php';
require_once HOTEL_WESTERBURG_PATH . 'includes/assets.php';
require_once HOTEL_WESTERBURG_PATH . 'includes/seo.php';
require_once HOTEL_WESTERBURG_PATH . 'includes/redirects.php';
require_once HOTEL_WESTERBURG_PATH . 'includes/diagnostics.php'; // Elementor save memory (256M).
