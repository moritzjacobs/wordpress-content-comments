<?php
/**
 * @package   ContentComments
 * @author    @moritzjacobs
 * @license   GPL-2.0+
 * @link      http://moritzjacobs.de
 *
 * @wordpress-plugin
 * Plugin Name: WP Content Comments
 * Description: TODO
 * Version:     1.0.0
 * Author:      TODO
 * Author URI:  TODO
 * Text Domain: content-comments-locale
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /lang
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// TODO: replace `class-content-comments.php` with the name of the actual plugin's class file
require_once( plugin_dir_path( __FILE__ ) . 'class-content-comments.php' );

// Register hooks that are fired when the plugin is activated, deactivated, and uninstalled, respectively.
// TODO: replace PluginName with the name of the plugin defined in `class-content-comments.php`
register_activation_hook( __FILE__, array( 'ContentComments', 'activate' ) );
register_deactivation_hook( __FILE__, array( 'ContentComments', 'deactivate' ) );

// TODO: replace PluginName with the name of the plugin defined in `class-content-comments.php`
ContentComments::get_instance();