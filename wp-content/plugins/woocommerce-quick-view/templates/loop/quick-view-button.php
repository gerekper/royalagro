<?php
/**
 * Quick View Button
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

echo apply_filters(
	'woocommerce_loop_quick_view_button',
	sprintf(
		'<a href="#" title="%s" data-product_id="%s" class="quick-view-button button"><span></span>%s</a>',
		esc_attr( $product->get_title() ),
		$product->get_id(),
		esc_html__( 'Quick View', 'wc_quick_view' )
	)
);
