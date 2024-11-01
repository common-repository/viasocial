<?php
class V_widget extends WP_Widget {

function __construct() {
parent::__construct(
// Base ID of your widget
'V_widget', 

// Widget name will appear in UI
__('Viasocial Widget', 'Viasocial'), 

// Widget description
array( 'description' => __( 'Facebook Recents Comments', 'Viasocial' ), ) 
);
}

// Creating widget front-end
// This is where the action happens
public function widget( $args, $instance ) {
$title = apply_filters( 'widget_title', $instance['title'] );
// before and after widget arguments are defined by themes
echo $args['before_widget'];
if ( ! empty( $title ) )
echo $args['before_title'] . $title . $args['after_title'];

// Viasocial pure class
include_once('facebook.class.php');
$viasocial = new Facebook('1643748329236477','fa5b4d442159618712b259a41bd757dc');
$viasocial->count('commentCount');
if ($viasocial->count('commentCount') !==0 ) {
	$viasocial->fetch('all','4');
}
elseif ($viasocial->count('commentCount') == 0) {
	_e( 'No comments have been published yet.', 'Viasocial' );
}
else{
	_e( 'Viasocial Error ! please contact developper.viaprestige[@]gmail.com', 'Viasocial' );
	return false;
}
echo $args['after_widget'];
}
		
// Widget Backend 
public function form( $instance ) {
if ( isset( $instance[ 'title' ] ) ) {
$title = $instance[ 'title' ];
}
else {
$title = __( 'Facebook comments', 'Viasocial' );
}
// Widget admin form
?>
<p>
<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
</p>
<?php
}
	
// Updating widget replacing old instances with new
public function update( $new_instance, $old_instance ) {
$instance = array();
$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
return $instance;
}
} // Class V_widget ends here

// Register and load the widget
function v_load_widget() {
	register_widget( 'V_widget' );
}
add_action( 'widgets_init', 'v_load_widget' );

?>