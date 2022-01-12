<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://wecodify.co/
 * @since             1.0.0
 * @package           Trackr
 *
 * @wordpress-plugin
 * Plugin Name:       Trackr - Simple Tracking Addon For WooCommerce
 * Plugin URI:        https://trackr.wecodify.co/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            We Codify Co.
 * Author URI:        https://wecodify.co/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       trackr
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
    die;
}

// Currently plugin version. Start at version 1.0.0 and use SemVer - https://semver.org
define('TRACKR_VERSION', '1.0.0');

// Get the filesystem directory path (with trailing slash) for the plugin __FILE__ passed in.
define( 'TRACKR_PATH', plugin_dir_path( __FILE__ ) );

// Get the URL directory path (with trailing slash) for the plugin __FILE__ passed in.
define( 'TRACKR_URL', plugin_dir_url( __FILE__ ) );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'classes/class-trackr.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_trackr() {
    $plugin = new Trackr();
    $plugin->run();
}

run_trackr();
