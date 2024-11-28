<?php
/* Template Name: No Sidebar */ 
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
	<div class="col-sm-12 col-md-12 pad3">  
		<div class="ui segment basic slim">
		<?php
		while ( have_posts() ) :
			the_post();
			get_template_part( 'template-parts/content', 'page' );
		endwhile; // End of the loop.
		?>
		
		</div>
	</div>  <?php // End Content ?>
	
</div> <?php // End Row ?>
<?php get_footer(); ?>

