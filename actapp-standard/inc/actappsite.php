<?php
/*
Customizable entry point specific to this template
*/

/* package: SemActionStandardPage */

class ActAppSite {
	private static $instance;
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new ActAppTpl();
		}
		return self::$instance;
	}

	/**
	 * Initialize ... usually run in 'init' add_action
	 */
	public static function init() {
		//self::do_something_on_startup();
	}
}

add_action( 'init', array( 'ActAppSite', 'init' ) );
