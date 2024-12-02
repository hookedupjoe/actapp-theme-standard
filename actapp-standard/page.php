<?php
/* Template Name: Standard Page */ 
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

get_header();
?>

<div class="row">
	<div class="col-sm-12 col-md-9 pad3">  
		<div class="ui segment black blue slim">
			<?php 
				$themeShowHeader = get_theme_mod( 'actappstd_show_header' );
				if( $themeShowHeader != 'no'){
					echo( '<div class="ui header large blue">' . get_the_title() . '</div>');
				}
			?>
			<?php
		while ( have_posts() ) :
			the_post();


		//	echo('<div class="ui header blue large">' . single_post_title() . '</div>');
			get_template_part( 'template-parts/content', 'page' );
			// // If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;

		endwhile; // End of the loop.
		?>
		
		</div>
	</div>  <?php // End Content ?>
	<div class="col-sm-12 col-md-3 pad3">
	<div class="ui segment basic slim">
		<?php get_sidebar(); ?>
		</div>
	</div> <?php // End Sidebar ?>
</div> <?php // End Row ?>
<?php get_footer(); ?>

