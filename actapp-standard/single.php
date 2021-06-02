<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package SemActionStandardPage
 */

get_header();
$tmpShown = false;
?>

<div class="row">
	<div class="col-sm-12 col-md-9 pad3">  
		<div class="ui segment black">
	

	<main id="primary" class="site-main">

		<?php
		$tmpThisTitle = "";
		while ( have_posts() ) :
			the_post();
			$tmpPostType = get_post_type_object( get_post_type($post) );
			$tmpPostArchiveList = $tmpPostType->has_archive;
			$tmpThisTitle = get_the_title();
			echo ('<div class="ui header medium black">'.$tmpThisTitle.'</div>');
			get_template_part( 'template-parts/content', get_post_type() );

			// // If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) :
			// 	comments_template();
			// endif;
		endwhile; // End of the loop.
		
		?>

	</main><!-- #main -->

	
	</div>
	</div>  <?php // End Content ?>
	<div class="col-sm-12 col-md-3 pad3">
	
	<div class="ui segment black">

	<?php
		
		
				
				get_sidebar(); 
			?>
				
	</div>
	
</div>

</div>


<?php

get_footer();
