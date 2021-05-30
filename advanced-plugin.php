<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              faisal.com
 * @since             1.0.0
 * @package           Advanced_Plugin
 *
 * @wordpress-plugin
 * Plugin Name:       Advanced Plugin
 * Plugin URI:        advanced-plugin.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Faisal Mia
 * Author URI:        faisal.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       advanced-plugin
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'ADVANCED_PLUGIN_VERSION', '1.0.0' );
define( 'ADVANCED_PLUGIN_BOOK_URL', plugin_dir_url(__FILE__) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-advanced-plugin-activator.php
 */
function activate_advanced_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-advanced-plugin-activator.php';
	$activator = new Advanced_Plugin_Activator;
	$activator->activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-advanced-plugin-deactivator.php
 */
function deactivate_advanced_plugin() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-advanced-plugin-activator.php';
	$activator = new Advanced_Plugin_Activator;

	require_once plugin_dir_path( __FILE__ ) . 'includes/class-advanced-plugin-deactivator.php';
	$deactivator = new Advanced_Plugin_Deactivator($activator);
	$deactivator->deactivate();
}

register_activation_hook( __FILE__, 'activate_advanced_plugin' );
register_deactivation_hook( __FILE__, 'deactivate_advanced_plugin' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-advanced-plugin.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_advanced_plugin() {

	$plugin = new Advanced_Plugin();
	$plugin->run();

}
run_advanced_plugin();
