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

class ActAppThemeOptions
{
	private static $instance;
	public static function get_instance()
	{
		if (null == self::$instance) {
			self::$instance = new ActAppThemeOptions();
		}
		return self::$instance;
	}

	private $rootPath = '';

	public static function setup_scripts($hook) {}

	/**
	 * getif.
	 *
	 * @return mixed get from array if value present else ''
	 */
	public static function getif($theKey, $theArray)
	{
		if (array_key_exists($theKey, $theArray)) {
			return $theArray[$theKey];
		}
	}

	public static function write_log($log)
	{
		if (true === WP_DEBUG) {
			if (is_array($log) || is_object($log)) {
				error_log(print_r($log, true));
			} else {
				error_log($log);
			}
		}
	}

	public static function getCurrentLocation()
	{
		$path = home_url();
		$loc = get_permalink();
		return str_replace($path, '', $loc);
	}

	public static function getRootPath()
	{
		$path = home_url();
		return ($path);
	}


	public static function get_theme_colors()
	{
		$themeColor = get_theme_mod('color_theme');
		if (!($themeColor)) {
			$themeColor = 'black';
		}

		$themeInvert = get_theme_mod('inverted_theme');
		if ($themeColor == 'white') {
			$themeInvert = 'dark';
		}
		if ($themeInvert != 'light') {
			$themeInvert = '';
		}

		return array(
			"maincolor" => $themeColor,
			"inverted" => $themeInvert
		);
	}

	public static function setup_theme_options($wp_customize)
	{

		//=== Add Settings ================= 

		$wp_customize->add_setting('color_theme', array('default' => 'black'));
		$wp_customize->add_setting('inverted_theme', array('default' => 'light'));

		//--- Header Options
		$wp_customize->add_setting('actappstd_show_header', array('default' => true));
		$wp_customize->add_setting('actappstd_header_color', array('default' => 'default'));
		$wp_customize->add_setting('actappstd_header_size', array('default' => 'large'));
		$wp_customize->add_setting('actappstd_header_underlined', array('default' => false));

		//--- Sidebar Options
		$wp_customize->add_setting('actappstd_show_sidebar', array('default' => true));

		//--- Site Border Options
		$wp_customize->add_setting('actappstd_segmented_content', array('default' => true));
		$wp_customize->add_setting('actappstd_segmented_sidebar', array('default' => true));
		$wp_customize->add_setting('actappstd_segmented_theme_color', array('default' => true));

		$wp_customize->add_setting('actappstd_content_padding', array('default' => 'pad8'));
		$wp_customize->add_setting('actappstd_sidebar_padding', array('default' => 'pad0'));
		$wp_customize->add_setting('actappstd_sidebar_spacing', array('default' => 'sitepad8'));

		//--- Other Site Options
		$wp_customize->add_setting('actappstd_disabled_widgets', array('default' => ''));
		$wp_customize->add_setting('actappstd_hide_login', array('default' => 'yes'));

		$paddingChoices = array(
			'pad0' => '0px',
			'pad1' => '1px',
			'pad2' => '2px',
			'pad3' => '4px',
			'pad4' => '5px',
			'pad5' => '6px',
			'pad6' => '7px',
			'pad7' => '8px',
			'pad8' => '8px',
			'pad9' => '9px',
			'pad10' => '10px',
			'pad11' => '11px',
			'pad12' => '12px',
			'pad13' => '13px',
			'pad14' => '14px',
			'pad15' => '15px',
		);

		//=== Add Sections ================= 

		$wp_customize->add_section(
			'actapp-theme-color',
			array(
				'title' => __('Theme Color', '_s'),
				'priority' => 30,
				'description' => __('Theme color options.', '_s')
			)
		);

		$wp_customize->add_section(
			'actapp-site-layout',
			array(
				'title' => __('Site Layout Options', '_s'),
				'priority' => 30,
				'description' => __('These options control the makeup of your content pages.', '_s')
			)
		);

		$wp_customize->add_section(
			'actapp-site-header',
			array(
				'title' => __('Site Header Options', '_s'),
				'priority' => 30,
				'description' => __('These options control the makeup of your content pages.', '_s')
			)
		);




		//=== Add Controls ================= 


		//----- SITE HEADER CONTROLS


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_show_header',
				array(
					'label'          => __('Include header on pages (except home)?', '_s'),
					'section' => 'actapp-site-header',
					'settings'       => 'actappstd_show_header',
					'type'           => 'checkbox'
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_header_underlined',
				array(
					'label'          => __('Show line under page headers?', '_s'),
					'section' => 'actapp-site-header',
					'settings'       => 'actappstd_header_underlined',
					'type'           => 'checkbox'
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_header_size',
				array(
					'label'          => __('Size of page headers for this site', '_s'),
					'section' => 'actapp-site-header',
					'settings'       => 'actappstd_header_size',
					'type'    => 'select',
					'choices' => array(
						'small' => 'Small',
						'medium' => 'Medium',
						'large' => 'Large',
						'huge' => 'Huge',
					)
				)
			)
		);

		$wp_customize->add_control(new ActAppSt_Color_Picker(
			$wp_customize,
			'actappstd_header_color',
			array(
				'label' => __('Select a header color, default will use theme color'),
				'description'  => esc_html__('This sets the page header color for this site.'),
				'section' => 'actapp-site-header',
				'include_template' => true
			)
		));


		//----- SITE LAYOUT CONTROLS

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_show_sidebar',
				array(
					'label'          => __('Show sidebar by default?', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_show_sidebar',
					'type'           => 'checkbox'
				)
			)
		);





		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_content_padding',
				array(
					'label'          => __('Padding for content area', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_content_padding',
					'type'    => 'select',
					'choices' => $paddingChoices
				)
			)
		);

		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_sidebar_padding',
				array(
					'label'          => __('Padding for sidebar area', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_sidebar_padding',
					'type'    => 'select',
					'choices' => $paddingChoices
				)
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_sidebar_spacing',
				array(
					'label'          => __('Space between content and sidebar', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_sidebar_spacing',
					'type'    => 'select',
					'choices' => array(
						'sitepad0' => '0px',
						'sitepad1' => '1px',
						'sitepad2' => '2px',
						'sitepad3' => '4px',
						'sitepad4' => '5px',
						'sitepad6' => '7px',
						'sitepad7' => '8px',
						'sitepad8' => '8px',
						'sitepad9' => '9px',
						'sitepad10' => '10px',
						'sitepad15' => '15px',
						'sitepad20' => '20px',
					)
				)
			)
		);


		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_segmented_content',
				array(
					'label'          => __('Border content area?', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_segmented_content',
					'type'           => 'checkbox'
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_segmented_sidebar',
				array(
					'label'          => __('Border sidebar area?', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_segmented_sidebar',
					'type'           => 'checkbox'
				)
			)
		);
		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_segmented_theme_color',
				array(
					'label'          => __('Add line at top of Borders?', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_segmented_theme_color',
					'type'           => 'checkbox'
				)
			)
		);



		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'actappstd_hide_login',
				array(
					'label'          => __('Hide Login Link?', '_s'),
					'section' => 'actapp-site-layout',
					'settings'       => 'actappstd_hide_login',
					'type'           => 'checkbox'
				)
			)
		);




		$wp_customize->add_control(
			new WP_Customize_Control(
				$wp_customize,
				'inverted_theme',
				array(
					'label'          => __('Light or Dark?', '_s'),
					'section' => 'actapp-theme-color',
					'settings'       => 'inverted_theme',
					'type'           => 'radio',
					'choices'        => array(
						'dark'   => __('Dark'),
						'light'  => __('Light')
					)
				)
			)
		);

		$wp_customize->add_control(new ActAppSt_Color_Picker(
			$wp_customize,
			'color_theme',
			array(
				'label' => __('Select a theme color'),
				'description'  => esc_html__('This sets the overall theme color for this site.'),
				'section' => 'actapp-theme-color',
			)
		));
	}

	/**
	 * Filters the list of allowed block types based on user capabilities.
	 *
	 * This function checks if the current user has the 'edit_theme_options' capability.
	 * If the user does not have this capability, certain blocks are removed from the
	 * list of allowed block types in the Editor.
	 *
	 * @param array|bool $allowed_block_types Array of block type slugs, or boolean to enable/disable all.
	 * @param object     $block_editor_context The current block editor context.
	 *
	 * @return array The filtered list of allowed block types. If the current user does not have
	 *               the 'edit_theme_options' capability, the list will exclude the disallowed blocks.
	 */
	public static function disallow_block_types($allowed_block_types, $block_editor_context)
	{

		// If the current user doesn't have the correct permissions, disallow blocks.
		//--> can be ... -> ! current_user_can( 'edit_theme_options' )
		if (true) {
			$disallowed_blocks = get_option('actappstd_disabled_widgets');

			if (!($disallowed_blocks)) {
				return;
			}

			// Get all registered blocks if $allowed_block_types is not already set.
			if (! is_array($allowed_block_types) || empty($allowed_block_types)) {
				$registered_blocks   = WP_Block_Type_Registry::get_instance()->get_all_registered();
				$allowed_block_types = array_keys($registered_blocks);
			}

			// Create a new array for the allowed blocks.
			$filtered_blocks = array();

			// Loop through each block in the allowed blocks list.
			foreach ($allowed_block_types as $block) {

				// Check if the block is not in the disallowed blocks list.
				if (! in_array($block, $disallowed_blocks, true)) {

					// If it's not disallowed, add it to the filtered list.
					$filtered_blocks[] = $block;
				}
			}

			// Return the filtered list of allowed blocks
			return $filtered_blocks;
		}

		return $allowed_block_types;
	}

	public static function allowed_block_types($allowed_block_types, $block_editor_context)
	{
		$showAllWidgets = false;
		//To-Do: Make this a setting / dynamic based on user and/or location

		if (!($showAllWidgets)) {
			$tmpCoreAllowed = array(
				'core/paragraph',
				'core/image',
				'core/list',
				'core/list-item',
				'core/quote',
				'core/columns',
				'core/column',
				'core/file',
				'core/video',
				'core/columns',
				'core/details',
				'core/pullquote',
				'core/legacy-widget',
				'core/freeform',
				'core/separator',
				'core/spacer',
				'core/shortcode',
				'core/html'
			);

			$tmpCustomWidgets = ActAppWidgetManager::get_custom_widget_list(true);
			//var_dump($tmpCustomWidgets);
			return array_merge($tmpCoreAllowed, $tmpCustomWidgets);
		}

		// The user has the correct permissions, so allow all blocks.
		return true;
	}


	public static function setup_widget_access()
	{
		//---> ToDo: Setup widgets from options, not hard coded in theme options here.

		// $disableWidgets = array
		// (
		// 	'core/navigation',
		// 	'core/query',
		// 	'core/archives',
		// );
		// update_option('actappstd_disabled_widgets', $disableWidgets);


		// add_filter( 'allowed_block_types_all', array( 'ActAppThemeOptions', 'disallow_block_types'), 10, 2 );


	}

	public static function init()
	{
		global $ActAppThemeOptions;
		$ActAppThemeOptions = array();
		add_action('customize_register', array('ActAppThemeOptions', 'setup_theme_options'), 999);
		self::setup_widget_access();
		add_filter('allowed_block_types_all', array('ActAppThemeOptions', 'allowed_block_types'), 10, 2);
		add_filter('should_load_remote_block_patterns', '__return_false');
	}
}
add_action('init', array('ActAppThemeOptions', 'init'));
