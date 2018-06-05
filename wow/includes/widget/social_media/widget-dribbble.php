<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Widget Dribbble
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_Dribbble_Widget extends WP_Widget {
	/* ---------------------------------------------------------------------------
	 * init
	 * --------------------------------------------------------------------------- */
	function __construct() {
		$widget_ops = array(
			'classname'   => 'CH-dribbble',
			'description' => __( "CH Dribbble Shot", 'chfw-lang' )
		);
		parent::__construct( 'CHfw_Dribbble', esc_html__( 'CH Dribbble Shot', 'chfw-lang' ), $widget_ops );
	}


	/* ---------------------------------------------------------------------------
    * Deals with the settings when they are saved by the admin.
    * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance                                    = $old_instance;
		$instance['title']               = strip_tags( $new_instance['title'] );
		$instance['dribbble_id']               = strip_tags( $new_instance['dribbble_id'] );
		return $instance;
	}

	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {
		extract( $args );
		$title       = ( $instance['title'] ) ? $instance['title'] : __( 'Dribbble', 'chfw-lang' );
		$dribbble_id = ( $instance['dribbble_id'] ) ? $instance['dribbble_id'] : '';

		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;



		if ( isset( $dribbble_id ) && $dribbble_id != '' ) {

			$link          = wp_remote_get( 'http://api.dribbble.com/players/' . $dribbble_id . '/shots?per_page=1' );
			$dribbble_json = json_decode( $link['body'], true );
			echo '<a class="dribbble-image" href="' . $dribbble_json['shots'][0]['short_url'] . '"><img src="' . $dribbble_json['shots'][0]['image_400_url'] . '" alt="' . esc_html__( 'Latest Dribbble Project', 'chfw-lang' ) . '"></a>';
		}


		echo $after_widget;
	}
	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function form( $instance ) {

		$title       = isset( $instance['title'] ) ? $instance['title'] :__( 'Dribbble', 'chfw-lang' );
		$dribbble_id       = isset( $instance['dribbble_id'] ) ? $instance['dribbble_id'] :'';

		?>
		<b><label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>">
				<?php _e( 'Title ', 'chfw-lang' ) ?></label></b>
		<br/>
		<input type="text" class="input-text" value="<?php echo esc_attr( $title ); ?>"
		       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" id="<?php esc_attr($this->get_field_id( 'title' )); ?>"/>
		<br/>
		<b><label for="<?php echo esc_attr($this->get_field_id( 'dribbble_id' )); ?>">
				<?php _e( 'Dribbble ID ', 'chfw-lang' ) ?></label></b>
		<br/>
		<input type="text" class="input-text" value="<?php echo esc_attr( $dribbble_id ); ?>"
		       name="<?php echo esc_attr($this->get_field_name( 'dribbble_id' )); ?>"
		       id="<?php esc_attr($this->get_field_id( 'dribbble_id' )); ?>"/>
		<br/>
		<?php
	}
}
