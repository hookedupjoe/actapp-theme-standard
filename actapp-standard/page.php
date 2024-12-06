<?php
/**
 * The template for displaying all pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site may use a
 * different template.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package actionapptheme
 */

 
 	$themeShowSidebar = get_theme_mod( 'actappstd_show_sidebar' );
	$tmpPageType = '';
	if( $themeShowSidebar == false ){
		$tmpPageType = 'full';
	}
	get_header();
	ActAppTpl::showContentHeader($tmpPageType);

	while ( have_posts() ){
		the_post();
		get_template_part( 'template-parts/content', 'page' );
	}

	ActAppTpl::showContenSidebar($tmpPageType);

	ActAppTpl::showContenFooter($tmpPageType);
	get_footer(); 

?>

