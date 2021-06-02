<?php
/**
 * The template for displaying the footer
 * @package actapptpl
 * @since 1.0.0
 */

?>


			
		</div><!-- #primary -->		
		</div><!-- content -->	
		</div><!-- container -->	
	


<div class="page-footer noprint">
  <div class="full-container">
<!-- Footer Start -->
<?php if ( is_active_sidebar( 'sidebar-f' ) ) {?>
	<?php dynamic_sidebar( 'sidebar-f' ); ?>
<?php }?>
<!-- Footer End -->
  </div>
</div>

	
<?php wp_footer(); ?>

</div><!-- #page -->
</body>
</html>


