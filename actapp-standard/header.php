<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package actionapptheme
 */

?>
<!doctype html>
<html <?php //twentytwentyone_the_html_classes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<script>
	ActionAppCore.nav = ActionAppCore.nav || {
		menu: false,
		toggleNav: function(){
			if( this.menu ){
				this.menu.sidebar('toggle');
			}
		},
		closeNav: function(){
			if( this.menu ){
				this.menu.sidebar('hide');
			}
		},
		openNav: function(){
			if( this.menu ){
				this.menu.sidebar('hide');
			}
		},
		onChange: function(){
			//--- Reset to the top level nav menu
			ThisApp.gotoTab({'group':'navtabs','item':'menu-top'});
			//--- Clear the esc bind
			this.unBindEsc();
		},
		onVisible: function(){
			this.bindEsc();
		},
		bindEsc: function(e) {
			$(document).keyup(this.onKeyProc);
		},
		unBindEsc: function(e) {
			$(document).unbind("keyup", this.onKeyProc);
		},
		onKeyUp: function(e) {
			if (e.key === "Escape") {
				//--- Clear the esc bind now to keep from double hitting it
				this.unBindEsc();
				ThisApp.actions.closeNav();
			}
		},
		onLoad: function(){
			this.menu = ThisApp.spot$('navmenu');
			this.menu.sidebar({
				onChange: this.onChange.bind(this),
				onVisible: this.onVisible.bind(this)
			});
			ThisApp.actions.toggleNav = this.toggleNav.bind(this);
			ThisApp.actions.closeNav = this.closeNav.bind(this);			
		},
		init: function(){
			this.onKeyProc = this.onKeyUp.bind(this);
			ActionAppCore.subscribe('app-loaded', this.onLoad.bind(this));
		}
	};
	ActionAppCore.nav.init();
</script>


<div spot="navmenu" class="ui sidebar overlay pad0" style="width:100%">

<div class="">

<?php 
echo ActAppTpl::get_mobile_nav_for_loc('menu-1'); 
?>


</div>








</div>
<?php 
$themeColor = get_theme_mod( 'color_theme' );
if( !($themeColor) ){
	$themeColor = 'black';
}

$themeInvert = get_theme_mod( 'inverted_theme' );
if( $themeInvert != 'light' ){
	$themeInvert = '';
} else {
	$themeInvert = '-' . $themeInvert;
}
$themeName = 'theme' . $themeInvert . '-' . $themeColor;
wp_body_open();
?>

<div id="page" class="pusher bootstrap-wrapper <?php echo($themeName); ?>">
	<?php get_template_part( 'template-parts/header/site-header' ); ?>
	<div class="hgroup full-container container">
	<div id="content" class="site-content">
		<div id="primary" class="content-area">			
			