<?php
/**
 * Server Side Look And Feel Manager: ActAppThemeOptions
 * 
 * Copyright (c) 2024 Joseph Francis / hookedup, inc. 
 *
 * This code is released under the GNU General Public License.
 * See COPYRIGHT.txt and LICENSE.txt.
 *
 * This code is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * This header and all notices must be kept intact.
 *
 * @author Joseph Francis
 * @package SemActionStandard
 * @since SemActionStandard 1.0.12
 */

class ActAppThemeOptions {
	private static $instance;
	public static function get_instance() {
		if ( null == self::$instance ) {
			self::$instance = new ActAppThemeOptions();
		}
		return self::$instance;
	}

	private $rootPath = '';
		
	public static function setup_scripts($hook) {
	
	
	
	}

	 /**
	 * getif.
	 *
	 * @return mixed get from array if value present else ''
	 */
	public static function getif( $theKey, $theArray ) {
		if( array_key_exists($theKey, $theArray) ){
			return $theArray[$theKey];
		} 
	}

	
	public static function getCurrentLocation(){
		$path = home_url();
		$loc = get_permalink();
		return str_replace($path,'',$loc);
	}

	public static function getRootPath(){
		$path = home_url();
		return ($path);
	}
	
	


	public static function setup_theme_options( $wp_customize ){

		

		
		//Settings
		$wp_customize->add_setting( 'color_theme', array( 'default' => 'black' ) );
		$wp_customize->add_setting( 'inverted_theme', array( 'default' => 'dark' ) );
		
		
		//Sections
		$wp_customize->add_section(
			'look-and-feel-options',
			array(
				'title' => __( 'Look and Feel', '_s' ),
				'priority' => 30,
				'description' => __( 'Theme look and feel options.', '_s' )
			)
		);
		
		

		
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'inverted_theme',
				array(
					'label'          => __( 'Light or Dark?', '_s' ),
					'section' => 'look-and-feel-options',
					'settings'       => 'inverted_theme',
					'type'           => 'radio',
					'choices'        => array(
						'dark'   => __( 'Dark' ),
						'light'  => __( 'Light' )
					)
				)
			)
		);
			
		$wp_customize->add_control( new ActAppSt_Color_Picker( $wp_customize, 'color_theme',
		array(
		   'label' => __( 'Select a theme color' ),
		   'description'  => esc_html__( 'This sets the overall theme color for this site.' ),
		   'section' => 'look-and-feel-options',
		)
	 ) );
		

		
	}

	public static function init() {
		global $ActAppThemeOptions;
		$ActAppThemeOptions = array();
		add_action('customize_register', array( 'ActAppThemeOptions', 'setup_theme_options') );
	}

}
add_action( 'init', array( 'ActAppThemeOptions', 'init' ) );

