<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Widget Adsense
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_Advertisement_Widget extends WP_Widget {
	/* ---------------------------------------------------------------------------
	 * INIT
	 * --------------------------------------------------------------------------- */
	function __construct() {

		$widget_ops = array(
			'classname'   => 'CHfw_Advertisement_Widget',
			'description' => __( "CH Advertisement Widget", 'chfw-lang' )
		);
		parent::__construct( 'CHfw_Advertisement_Widget', esc_html__( 'CH Advertisement Widget', 'chfw-lang' ), $widget_ops );

	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['title'] = strip_tags( $new_instance['title'] );
		$instance['link']   = strip_tags( $new_instance['link'] );
		$instance['img_href']  = strip_tags( $new_instance['img_href'] );
		$instance['class'] = strip_tags( $new_instance['class'] );

		return $instance;
	}

	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {
		extract( $args );
		$title = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Advertisement', 'chfw-lang' );
		$link   = isset( $instance['link'] ) ? $instance['link'] : '#';
		$img_href  = isset( $instance['img_href'] ) ? $instance['img_href'] : '';
		$class = isset( $instance['class'] ) ? $instance['class'] : '';

		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		/**
		 * Widget Content
		 */

		?>


		<?php if ( isset( $link ) && $link != '' ) {

			echo '<a class="ads-widget-wrapper thickbox ' . $class . '" href="' . $link . '"><img src="' .  $img_href  . '" alt="' .  $title  . '" /></a>';

		} ?>

		<?php

		echo $after_widget;
	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function form( $instance ) {

		$link = isset( $instance['link'] ) ? esc_attr( $instance['link'] ) : '#';
		$img_href = isset( $instance['img_href'] ) ? esc_attr( $instance['img_href'] ) : '';
		$class = isset( $instance['class'] ) ? esc_attr( $instance['class'] ) : '';
		$title= isset( $instance['title'] ) ? esc_attr( $instance['title'] ) :esc_html__( 'Advertisement', 'chfw-lang' );

		?>

		<div id="advertisement-upload-image_<?php echo esc_attr( $this->id ); ?>">
			<b><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">
					<?php _e( 'Title ', 'chfw-lang' ) ?></label></b>
			<br/>

			<input type="text" class="input-text" value="<?php echo esc_attr( $title ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       id="<?php esc_attr( $this->get_field_id( 'title' ) ); ?>"/>
			<br/>

			<b><label for="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>">
					<?php _e( 'Link ', 'chfw-lang' ) ?></label></b>
			<br/>

			<input type="text" class="input-text" value="<?php echo esc_attr( $link ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'link' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'link' ) ); ?>"/>
			<br/>

			<label for="<?php echo $this->get_field_id( 'class' ); ?>">
				<br/>
				<b><label for="<?php echo esc_attr( $this->get_field_id( 'class' ) ); ?>">
						<?php _e( 'Class', 'chfw-lang' ) ?></label></b>
				<br/>

				<input type="text" class="input-text" value="<?php echo esc_attr( $class); ?>"
				       name="<?php echo esc_attr( $this->get_field_name( 'class' ) ); ?>"
				       id="<?php echo esc_attr( $this->get_field_id( 'class' ) ); ?>"/>
				<br/>

				<img src="<?php echo esc_attr( $img_href); ?>" class="advertisement-image responsive-image"
				     alt="<?php echo esc_attr( $title) ?>"/>

				<input class="advertisement-image-field input-text" type="text"
				       value="<?php echo esc_attr( $img_href ); ?>"
				       name="<?php echo esc_attr( ( $this->get_field_name( 'img_href' ) ) ); ?>"
				       id="<?php echo esc_attr( $this->get_field_id( 'img_href' ) ); ?>"/>


				<a style=" clear: both;" img_href="#" target="advertisement-upload-image_<?php echo $this->id; ?>"
				   class="advertisement-upload-image"><?php _e( 'Add Image ', 'chfw-lang' ) ?></a>

		</div>

		<?php
	}
}

