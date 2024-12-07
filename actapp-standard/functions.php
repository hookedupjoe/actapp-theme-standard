<?php
/*!
 * Theme Name: Semantic Action Theme
 * Theme URI: https://hookedup.com/
 * Author: Joseph Francis
 * Author URI: https://hookedup.com/
 * Description: Theme for Semantic UI / ActApp based websites
 * 
 * License: GNU General Public License v2 or later
 * License URI: LICENSE
 * Text Domain: SemActionStandard
 * Tags: developer-library
 *
 * @package SemActionStandard
 */

if ( ! defined( 'ACTAPPSTD_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( 'ACTAPPSTD_VERSION', '1.0.12' );
}

if ( !defined( 'ACTAPPSTD_BASE_DIR' ) ) {
	define( 'ACTAPPSTD_BASE_DIR', get_template_directory() );
}

add_filter( 'body_class','actapp_body_classes' );
function actapp_body_classes( $classes ) {
	
	if( class_exists('Kodeo_Admin_UI') ){
		$classes[] = 'kodeo-ui-active';
	}
    return $classes;
}

if ( ! function_exists( 'actapptpl_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function actapptpl_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on SemActionStandard, use a find and replace
		 * to change '_actapptpl' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( '_actapptpl', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		//add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', '_actapptpl' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// // Set up the WordPress core custom background feature.
		// add_theme_support(
		// 	'custom-background',
		// 	apply_filters(
		// 		'actapptpl_custom_background_args',
		// 		array(
		// 			'default-color' => 'ffffff',
		// 			'default-image' => '',
		// 		)
		// 	)
		// );

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'actapptpl_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
// function actapptpl_content_width() {
// 	$GLOBALS['content_width'] = apply_filters( 'actapptpl_content_width', 640 );
// }
// add_action( 'after_setup_theme', 'actapptpl_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function actapptpl_widgets_init() {

	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', '_actapptpl' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', '_actapptpl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Footer', '_actapptpl' ),
			'id'            => 'sidebar-f',
			'description'   => esc_html__( 'Add widgets here to appear in your footer.', '_actapptpl' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);

	register_sidebar(
		array(
			'name'          => esc_html__( 'Header', '_actapptpl' ),
			'id'            => 'sidebar-h',
			'description'   => esc_html__( 'Add widgets here to appear as your header.', '_actapptpl' ),
			'before_widget' => '',
			'after_widget'  => '',
			'before_title'  => '',
			'after_title'   => '',
		)
	);

}
add_action( 'widgets_init', 'actapptpl_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function actapptpl_scripts() {
	wp_enqueue_style( 'actapptpl-style', get_stylesheet_uri(), array(), ACTAPPSTD_VERSION );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	remove_action('wp_head', '_admin_bar_bump_cb');
    wp_enqueue_style( 'admin_css_wp', get_template_directory_uri() . '/wp-widgets.css', false, '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'actapptpl_scripts' );

add_action( 'admin_enqueue_scripts', 'actapptpl_admin_style' );
function actapptpl_admin_style() {
    wp_enqueue_style( 'admin_css_wp', get_template_directory_uri() . '/wp-widgets.css', false, '1.0.0' );

}





//-------------   ADD OPTION TO CUSTOMIZE THEME AREA 



function actappstd_theme_options( $wp_customize ){
			
	


	
}







//-------------   ADD OPTION TO CUSTOMIZE THEME AREA - END








/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Widget for recent posts
 */
require get_template_directory() . '/inc/widgets/actappw-recent-posts.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customthemecontrols.php';
require get_template_directory() . '/inc/customizer.php';


/**
 * Action App Template Entrypoint.
 */
require get_template_directory() . '/inc/actapptpl.php';

/**
 * Action App Site Entrypoint (customize template here).
 */
require get_template_directory() . '/inc/actappsite.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/**
 * Load WooCommerce compatibility file.
 */
if ( class_exists( 'WooCommerce' ) ) {
	require get_template_directory() . '/inc/woocommerce.php';
}

add_action('customize_register', 'actappstd_theme_options');

/**
 * Standard disable of stuff we don't want in the admin area
 */
function actapptpl_remove_dashboard_meta() {
    remove_meta_box('dashboard_incoming_links', 'dashboard', 'normal'); //Removes the 'incoming links' widget
    remove_meta_box('dashboard_primary', 'dashboard', 'normal'); //Removes the 'WordPress News' widget
    remove_meta_box('dashboard_secondary', 'dashboard', 'normal'); //Removes the secondary widget
    remove_meta_box('dashboard_quick_press', 'dashboard', 'side'); //Removes the 'Quick Draft' widget
    remove_meta_box('dashboard_recent_drafts', 'dashboard', 'side'); //Removes the 'Recent Drafts' widget
    remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal'); //Removes the 'Activity' widget
    remove_meta_box('dashboard_right_now', 'dashboard', 'normal'); //Removes the 'At a Glance' widget
    remove_meta_box('dashboard_activity', 'dashboard', 'normal'); //Removes the 'Activity' widget (since 3.8)
}
add_action('admin_init', 'actapptpl_remove_dashboard_meta');

function actapptpl_remove_admin_bar() {
	if (!current_user_can('administrator') && !current_user_can('editor') && !is_admin()) {
		show_admin_bar(false);
	}
}

add_action('after_setup_theme', 'actapptpl_remove_admin_bar');

add_filter('get_the_archive_title', function ($title) {
    return preg_replace('/^\w+: /', '', $title);
});



add_shortcode('homehref', 'actapp_home_link');
function actapp_home_link($atts) {
  $html = home_url();
  return $html;
}

add_shortcode('themehref', 'actapp_theme_link');
function actapp_theme_link($atts) {
  $html = get_bloginfo('template_directory');
  return $html;
}

	
add_shortcode( 'bluebutton', 'actapp_theme_bluebutton' );
function actapp_theme_bluebutton( $atts, $content = "" ) {
    $atts = shortcode_atts( array(
        'external' => false,
        'color' => 'blue',
        'link' => ''
    ), $atts, 'bluebutton' );
 
	$tmpTarget = '';
	if( $atts['color'] == true ){
		$tmpTarget = ' target="_blank" ';
	}
	$tmpLink = $atts['color'];
	if( $tmpLink == '' || $tmpLink == null ){
		return 'MISSING LINK';
	}

	return '<a href="'.$tmpLink.'" class="ui button basic circular '.$atts['color'] . '"' . $tmpTarget . '>' . $content . '</a>';
	
}

function actappstd_current_year( $atts ){
    return date('Y');
}
add_shortcode( 'current_year', 'actappstd_current_year' );


add_filter( 'widget_text', 'shortcode_unautop');
add_filter( 'widget_text', 'do_shortcode');

function actapptpl_redirect_non_admin_user(){
    if ( is_user_logged_in() ) {
        if ( !defined( 'DOING_AJAX' ) && !current_user_can('administrator') && !current_user_can('author') && !current_user_can('editor') && !current_user_can('contributor') ){
            wp_redirect( site_url() );  exit;
        }
    }
}
add_action( 'admin_init', 'actapptpl_redirect_non_admin_user' );

function actapptpl_change_lost_your_password ($text) {

	if ($text == 'Lost your password?'){
		$text = 'Request Password Reset';
	} else if ($text == 'Register'){
		$text = 'Create New Username';
	} else if ($text == 'Register For This Site'){
		$text = 'Create New Username';
	}
	return $text;
}

add_filter( 'gettext', 'actapptpl_change_lost_your_password' );


// Removes from admin menu
add_action( 'admin_menu', 'actapptpl_remove_admin_menus' );
function actapptpl_remove_admin_menus() {
    remove_menu_page( 'edit-comments.php' );
}
// Removes from post and pages
add_action('init', 'actapptpl_remove_comment_support', 100);

function actapptpl_remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
// Removes from admin bar
function actapptpl_admin_bar_render() {
    global $wp_admin_bar;
    $wp_admin_bar->remove_menu('comments');
}
add_action( 'wp_before_admin_bar_render', 'actapptpl_admin_bar_render' );



function actapptpl_filter_media_comment_status( $open, $post_id ) {
    $post = get_post( $post_id );
    if( $post->post_type == 'attachment' ) {
        return false;
    }
    return $open;
}
add_filter( 'comments_open', 'actapptpl_filter_media_comment_status', 10 , 2 );

add_action( 'wp_head', function() {
    echo ('<meta name="google" content="notranslate" />');
});

function actapp_customizer_remove_sections( $wp_customize ) {

	//--- Adding a panel to override the widgets one that is not supported to hide it
	$wp_customize->add_panel( 'nav_menus', array(
		'title' => __( 'Custom Menus' ),
		'theme_supports' => 'hiddenpanels',
		'priority' => 10
    ) );
	$wp_customize->add_panel( 'widgets', array(
		'title' => __( 'Custom Widgets' ),
		'theme_supports' => 'hiddenpanels',
		'priority' => 10
    ) );

	$wp_customize->remove_section('background_image');
	$wp_customize->remove_section('title_tagline');	
}
add_action( 'customize_register', 'actapp_customizer_remove_sections',100);
	


define( 'DISALLOW_FILE_EDIT', true );



require_once ACTAPPSTD_BASE_DIR . '/cls/ActAppThemeOptions.php';
