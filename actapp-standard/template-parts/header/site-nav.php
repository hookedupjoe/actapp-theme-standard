<?php
/**
 * Displays the site navigation.
 *
 * @package SemActionStandardPage
 * @since 1.0.0
 */

?>

<?php if ( has_nav_menu( 'menu-1' ) ) : ?>
	<?php
	
	$menuname = ActAppTpl::get_menu_for_location( 'menu-1' );
	$tree = ActAppTpl::get_menu_tree( $menuname );
	$json = json_encode( $tree );

	?>
	<div class="nav-area noprint">
	<nav class="full-container">
    <div class="ui inverted horizontal top menu">
	
	<?php
	
	$ret = '<div action="toggleNav" class="ui item mobileonly">
		<i class="sidebar icon inverted"></i>
		&nbsp;Menu
		</div>';

	$ret .= ActAppTpl::get_menu_nav_for_loc('menu-1');

	$ret .= '<div class="right menu inverted">'.ActAppTpl::get_login_link().'</div>';

	echo $ret;

	echo ('<script>ActionAppCore.navMenu = '.$json.'</script>');
 
  ?>
	</div>
  </nav>
  </div>
  	<?php endif; ?>
