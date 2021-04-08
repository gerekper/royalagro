<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://www.themepunch.com
 * @since             1.0.0
 * @package           Rev_addon_prevnext_posts
 *
 * @wordpress-plugin
 * Plugin Name:       Slider Revolution Previous and Next Posts Add-On
 * Plugin URI:        http://revolution.themepunch.com
 * Description:       Add previous and next Posts to your single post with style & Slider Revolution
 * Version:           2.0.2
 * Author:            ThemePunch
 * Author URI:        http://www.themepunch.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rev_addon_prevnext_posts
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define("REV_ADDON_PREVNEXT_POSTS_VERSION", "2.0.2");
define("REV_ADDON_PREVNEXT_POSTS_URL", str_replace('index.php','',plugins_url( 'index.php', __FILE__ )));


/**
 * New "verify/notices" setup for all Global Addons
 * @since    2.0.0
 */
function run_rev_addon_prevnext_posts() {
	
	require_once plugin_dir_path( __FILE__ ) . 'includes/verify-addon.php';
	
	$verify = new Revslider_Prev_Next_Addon_Verify();
	if($verify->is_verified()) {
			
		/*
			RevSlider 5.0 to 6.0 update
		*/
		$options = get_option('rev_slider_addon_prevnext_posts');
		if($options !== false) {
			
			$options = str_replace('rs-addon-prevnext', 'revslider-prevnext-posts-addon', $options);
			update_option('revslider_prevnext_posts_addon', $options);
			delete_option('rev_slider_addon_prevnext_posts');
		
		}
		
		require_once plugin_dir_path( __FILE__ ) . 'includes/class-rev_addon_prevnext_posts.php';
		$plugin = new Rev_addon_prevnext_posts();
		$plugin->run();
		
	}

}
//run_rev_addon_prevnext_posts();
add_action('plugins_loaded', 'run_rev_addon_prevnext_posts');
register_activation_hook( __FILE__, 'run_rev_addon_prevnext_posts');
