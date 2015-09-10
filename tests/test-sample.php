<?php

class SampleTest extends WP_UnitTestCase {

	function test_sample() {
		// replace this with some actual testing code
		$this->assertTrue( true );
	}

	/**
	 * Ensure that the plugin has been installed and activated.
	 */
	function test_plugin_activated() {
		// $this->assertTrue( is_plugin_active( 'plugin-template/class-plugin.php' ) );
		$this->assertTrue( 'Russell' == wp_get_theme() );
	}
}

