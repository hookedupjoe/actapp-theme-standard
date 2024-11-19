<?php

/**
* Adds ActApp_RecentPosts widget.
*/
class ActApp_RecentPosts extends WP_Widget {
/**
* Register widget with WordPress.
*/
function __construct() {
parent::__construct(
'actapp_recent_posts', // Base ID
esc_html__( 'ActApp Recent Posts', 'text_domain' ), // Name
array( 'description' => esc_html__( 'Default Recent Posts for ActApp template', 'text_domain' ), ) // Args
);
}
/**
* Front-end display of the widget.
*
* @param array $args Widget arguments.
* @param array $instance Saved values from the database.
*
* @see WP_Widget::widget()
*
*/
public function widget( $args, $instance ) {
echo $args['before_widget'];
$tmpMax = 5;

if ( ! empty( $instance['max'] ) ) {
    $tmpMax = $instance['max'];
}

$tmpTitle = "Recent Posts";
if ( ! empty( $instance['title'] ) ) {
    $tmpTitle = $instance['title'];
}

//ActAppTpl::showRecentPosts($instance);
$tmpLatest = ActAppTpl::getRecentPosts($tmpMax);

$themeColors = ActAppThemeOptions::get_theme_colors();
$themeColor = $themeColors['maincolor'];
$themeInvert = $themeColors['inverted'];
if( $themeColor == 'white' ){
    $themeColor = 'black';
	$themeInvert = 'dark';
}
$theExtraClasses = '';
if( $themeInvert == 'light' ){
    $theExtraClasses = 'basic colored';
}

echo ('<div class="ui header center aligned mart2 medium">'.$tmpTitle.'</div>');

echo ('<div class="ui list pad0 mar0">');

foreach ($tmpLatest->posts as $aKey => $aPost) {
    //echo("<br/>".$value->guid);
    //var_dump($aPost);
    $tmpPostName = $aPost->post_name;
    $tmpPostTitle = $aPost->post_title;
    $tmpPostExcerpt = $aPost->post_excerpt;
    $tmpURL = site_url('/'.$tmpPostName);
    $tmpDate = date(get_option( 'date_format' ),strtotime($aPost->post_date));

    echo('<a href="'.$tmpURL.'" class="item">');
    echo('<div class="ui button circular pad8 ' . $themeColor . ' ' . $theExtraClasses . ' fluid">
    <div class="ui larger">'.$tmpPostTitle.'</div>
    <div class="pad5"></div>
    <div style="font-size:smaller;" class="">'.$tmpDate.'</div>
  </div>');
    echo ('</a>');

    
}
echo ('</div>');


echo $args['after_widget'];
}
/**
* Back-end widget form.
*
* @param array $instance Previously saved values from the database.
*
* @see WP_Widget::form()
*
*/
public function form( $instance ) {
$max = ! empty( $instance['max'] ) ? $instance['max'] : '';
$title = ! empty( $instance['title'] ) ? $instance['title'] : '';
?>
<!-- Title -->
<p>
<label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
Title
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text"
value="<?php echo esc_attr( $title ); ?>">

<label for="<?php echo esc_attr( $this->get_field_id( 'max' ) ); ?>">
Maximum posts to show
</label>
<input class="widefat" id="<?php echo esc_attr( $this->get_field_id( 'max' ) ); ?>"
name="<?php echo esc_attr( $this->get_field_name( 'max' ) ); ?>" type="text"
value="<?php echo esc_attr( $max ); ?>">
</p>


<?php
}
/**
* Sanitize widget form values as they are saved.
*
* @param array $new_instance Values just sent to be saved.
* @param array $old_instance Previously saved values from the database.
*
* @return array Updated safe values to be saved.
* @see WP_Widget::update()
*
*/
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['max'] = ( ! empty( $new_instance['max'] ) ) ? sanitize_text_field( $new_instance['max'] ) : '';
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? sanitize_text_field( $new_instance['title'] ) : '';
return $instance;
}
} // class ActApp_RecentPosts

function register_actapp_widget_recentposts() {
register_widget( 'ActApp_RecentPosts' );
}
add_action( 'widgets_init', 'register_actapp_widget_recentposts' );
