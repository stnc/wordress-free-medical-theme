<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Widget Author informatoin
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_AuthorInfo extends WP_Widget {
	/* ---------------------------------------------------------------------------
	 * INIT
	 * --------------------------------------------------------------------------- */
	function __construct() {
		$widget_ops = array(
			'classname'   => 'CHfwAuthorInfo',
			'description' => __( "CH Author", 'chfw-lang' )
		);
		parent::__construct( 'CHfwAuthorInfo', esc_html__( 'CH Author', 'chfw-lang' ), $widget_ops );
		// add image js

	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance                 = $old_instance;
		$instance['title']        = strip_tags( $new_instance['title'] );
		$instance['author_name']  = strip_tags( $new_instance['author_name'] );
		$instance['author_bio']   = strip_tags( $new_instance['author_bio'] );
		$instance['author_image'] = strip_tags( $new_instance['author_image'] );

		$instance['facebook_show']  = strip_tags( $new_instance['facebook_show'] );
		$instance['twitter_show']   = strip_tags( $new_instance['twitter_show'] );
		$instance['instagram_show'] = strip_tags( $new_instance['instagram_show'] );
		$instance['pinterest_show'] = strip_tags( $new_instance['pinterest_show'] );
		$instance['flicker_show']   = strip_tags( $new_instance['flicker_show'] );

		$instance['facebook_link']  = strip_tags( $new_instance['facebook_link'] );
		$instance['twitter_link']   = strip_tags( $new_instance['twitter_link'] );
		$instance['instagram_link'] = strip_tags( $new_instance['instagram_link'] );
		$instance['pinterest_link'] = strip_tags( $new_instance['pinterest_link'] );
		$instance['flicker_link']   = strip_tags( $new_instance['flicker_link'] );

		$instance['image_auto_width']     = strip_tags( $new_instance['image_auto_width'] );
		/*$instance['author_image_cover']   = strip_tags( $new_instance['author_image_cover'] );*/
		$instance['author_bgcolor']       = strip_tags( $new_instance['author_bgcolor'] );
		$instance['author_title_color']   = strip_tags( $new_instance['author_title_color'] );
		$instance['author_comment_color'] = strip_tags( $new_instance['author_comment_color'] );


		return $instance;
	}

	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {

		extract( $args );
		$title        = isset( $instance['title'] ) ? $instance['title'] : '';
		$author_name  = isset( $instance['author_name'] ) ? $instance['author_name'] : __( 'Author Name', 'chfw-lang' );
		$author_bio   = isset( $instance['author_bio'] ) ? $instance['author_bio'] : __( 'About The Author', 'chfw-lang' );
		$author_image = isset( $instance['author_image'] ) ? $instance['author_image'] : '';

		$facebook_show  = isset( $instance['facebook_show'] ) ? $instance['facebook_show'] : '';
		$twitter_show   = isset( $instance['twitter_show'] ) ? $instance['twitter_show'] : '';
		$instagram_show = isset( $instance['instagram_show'] ) ? $instance['instagram_show'] : '';
		$pinterest_show = isset( $instance['pinterest_show'] ) ? $instance['pinterest_show'] : '';
		$flicker_show   = isset( $instance['flicker_show'] ) ? $instance['flicker_show'] : '';

		$facebook_link      = isset( $instance['facebook_link'] ) ? $instance['facebook_link'] : '';
		$twitter_link       = isset( $instance['twitter_link'] ) ? $instance['twitter_link'] : '';
		$instagram_link     = isset( $instance['instagram_link'] ) ? $instance['instagram_link'] : '';
		$pinterest_link     = isset( $instance['pinterest_link'] ) ? $instance['pinterest_link'] : '';
		$flicker_link       = isset( $instance['flicker_link'] ) ? $instance['flicker_link'] : '';
		$author_image_cover = isset( $instance['author_image_cover'] ) ? $instance['author_image_cover'] : '';

		$image_auto_width = '';
		if ( isset( $instance['image_auto_width'] ) ) {
			$image_auto_width = $instance['image_auto_width'] ? $instance['image_auto_width'] : 'checked';
		}
		/*
		if ( isset( $instance['image_auto_width'] ) ) {
			$image_auto_width = $instance['image_auto_width'] ;
		} else {
			$image_auto_width =  'checked';
		}*/


		$author_title_color   = '';
		$author_bgcolor       = '';
		$author_comment_color = '';

		if ( isset( $instance['author_bgcolor'] ) ) {
			$author_bgcolor = 'background:' . $instance['author_bgcolor'];
		}


		if ( isset( $instance['author_title_color'] ) ) {
			$author_title_color = 'color:' . $instance['author_title_color'];
		}

		if ( isset( $instance['author_comment_color'] ) ) {
			$author_comment_color = 'color:' . $instance['author_comment_color'];
		}


		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		/**
		 * Widget Content
		 */

		?>
		<div class="widget-author-card hovercard" style="<?php echo $author_bgcolor ?>">
			<div class="cardheader" style="background: url('<?php echo $author_image_cover ?>'); background-size: cover;">
            </div>
			<?php if ( isset( $author_image ) && $author_image != '' ) : ?>
				<div class="avatar">
					<img <?php if ( isset( $image_auto_width ) && $image_auto_width == 'on' ) {
						echo 'style="width: 100%; height: 100%;"';
					} ?> src="<?php echo ( $author_image ); ?>" alt="<?php echo esc_attr( $author_name ); ?>"/>
				</div>
			<?php endif; ?>

			<div class="info">
				<div class="title" style="<?php echo $author_title_color ?>">
					<?php echo $author_name ?>
				</div>
				<div class="desc" style="<?php echo $author_comment_color ?>"><?php echo $author_bio ?></div>
			</div>

			<div class="bottom">
				<?php if ( $facebook_show != '' ) { ?>
					<a href="https://www.facebook.com/<?php echo $facebook_link; ?>" title="Facebook"
					   class=" btn sc_fw-facebook  btn-twitter btn-sm " target="_blank">
                        <i class="fa fa-facebook"></i>
					</a>
				<?php } ?>

				<?php if ( $twitter_show != '' ) { ?>
					<a href="https://twitter.com/<?php echo $twitter_link; ?>" title="Twitter" class="sc_fw-twitter btn btn-twitter btn-sm" target="_blank">
                        <i class="fa fa-twitter"></i>
                    </a>
				<?php } ?>

				<?php if ( $instagram_show != '' ) { ?>
					<a href="https://instagram.com/<?php echo $instagram_link; ?>" title="Instagram" class="btn sc_fw-instagram btn-twitter btn-sm" target="_blank">
                        <i class="fa fa-instagram"></i>
					</a>
				<?php } ?>

				<?php if ( $pinterest_show != '' ) { ?>
					<a href="https://www.pinterest.com/<?php echo $pinterest_link; ?>" title="Pinterest"
					   class=" btn sc_fw-pinterest  btn-twitter btn-sm " target="_blank">
                        <i class="fa fa-pinterest"></i>
					</a>
				<?php } ?>

				<?php if ( $flicker_show != '' ) { ?>
					<a href="https://www.flickr.com/<?php echo $flicker_link; ?>" title="Flickr" class="btn sc_fw-flickr btn-twitter btn-sm" target="_blank">
                        <i class="fa fa-flickr"></i>
                    </a>
				<?php } ?>
			</div>
		</div>
		<?php
		echo $after_widget;
	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	public function form( $instance ) {

		$title                = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$author_name          = isset( $instance['author_name'] ) ? esc_attr( $instance['author_name'] ) : __( 'Author Name', 'chfw-lang' );
		$author_bio           = isset( $instance['author_bio'] ) ? esc_attr( $instance['author_bio'] ) : '';
		$author_image         = isset( $instance['author_image'] ) ? esc_attr( $instance['author_image'] ) : '';
		$image_auto_width     = isset( $instance['image_auto_width'] ) ? esc_attr( $instance['image_auto_width'] ) : '';
		$author_image_cover   = isset( $instance['author_image_cover'] ) ? esc_attr( $instance['author_image_cover'] ) : '';
		$facebook_link        = isset( $instance['facebook_link'] ) ? esc_attr( $instance['facebook_link'] ) : '';
		$twitter_link         = isset( $instance['twitter_link'] ) ? esc_attr( $instance['twitter_link'] ) : '';
		$instagram_link       = isset( $instance['instagram_link'] ) ? esc_attr( $instance['instagram_link'] ) : '';
		$pinterest_link       = isset( $instance['pinterest_link'] ) ? esc_attr( $instance['pinterest_link'] ) : '';
		$flicker_link         = isset( $instance['flicker_link'] ) ? esc_attr( $instance['flicker_link'] ) : '';
		$facebook_show        = isset( $instance['facebook_show'] ) ? esc_attr( $instance['facebook_show'] ) : '';
		$twitter_show         = isset( $instance['twitter_show'] ) ? esc_attr( $instance['twitter_show'] ) : '';
		$instagram_show       = isset( $instance['instagram_show'] ) ? esc_attr( $instance['instagram_show'] ) : '';
		$pinterest_show       = isset( $instance['pinterest_show'] ) ? esc_attr( $instance['pinterest_show'] ) : '';
		$flicker_show         = isset( $instance['flicker_show'] ) ? esc_attr( $instance['flicker_show'] ) : '';
		$author_title_color   = isset( $instance['author_title_color'] ) ? esc_attr( $instance['author_title_color'] ) : '';
		$author_bgcolor       = isset( $instance['author_bgcolor'] ) ? esc_attr( $instance['author_bgcolor'] ) : '';
		$author_comment_color = isset( $instance['author_comment_color'] ) ? esc_attr( $instance['author_comment_color'] ) : '';


		?>
		<div class="tabbing_<?php echo $this->id ?>">
			<ul class="tabs_st_studio-engine">
				<li class="tab-link current" data-tab="tab1"><?php esc_html_e( 'Info', 'chfw-lang' ) ?></li>
				<li class="tab-link" data-tab="tab2"><?php esc_html_e( 'Picture', 'chfw-lang' ) ?></li>
				<li class="tab-link" data-tab="tab3"><?php esc_html_e( 'Social', 'chfw-lang' ) ?></li>
				<li class="tab-link" data-tab="tab4"><?php esc_html_e( 'Style', 'chfw-lang' ) ?></li>
			</ul>

			<div id="author-upload-image_<?php echo $this->id; ?>">

				<div class="tabcontainer">
					<div class="tab-content tab1 current">

						<b><label s for="<?php echo esc_attr( $this->get_field_id( 'title' )); ?>">
								<?php esc_html_e( 'Title ', 'chfw-lang' ) ?></label></b> <br/>
						<input type="text" class="input-text" value="<?php echo esc_attr( $title ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"/>
						<b><label for="<?php echo esc_attr( $this->get_field_id( 'author_name' ) ); ?>">
								<?php esc_html_e( 'Author Name ', 'chfw-lang' ); ?></label></b> <br/>
						<input type="text" class="input-text"
						       value="<?php echo esc_attr( $author_name ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'author_name' ) ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( 'author_name' ) ); ?>"/>

						<p>
							<b><label for="<?php echo esc_attr( $this->get_field_id( 'author_bio' )); ?>">
									<?php esc_html_e( 'Author Bio ', 'chfw-lang' ) ?></label></b>
    <textarea name="<?php echo esc_attr( $this->get_field_name( 'author_bio' )); ?>"
              id="<?php echo esc_attr( $this->get_field_id( 'author_bio' )); ?>"
              style="height: 100px; width: 100%; padding: 3px;"><?php echo esc_attr( $author_bio ); ?></textarea>
						</p>

					</div>
					<div class="tab-content tab2 ">

						<p>
							<b><label for="<?php echo ( $this->get_field_id( 'author_image_cover' )); ?>">
									<?php esc_html_e( 'Cover Picture ', 'chfw-lang' ) ?></label></b>
							<img src="<?php echo ( $author_image_cover ); ?>"
							     class="author_image_cover responsive-image"
							     alt="<?php ( $this->get_field_id( 'author_name' )); ?>"/>
							<input class="upload-field-btn author-image-cover-fieldinput-text" type="hidden"
							       value="<?php echo ( $author_image_cover ); ?>"
							       name="<?php echo ( $this->get_field_name( 'author_image_cover' )); ?>"
							       id="<?php echo ( $this->get_field_id( 'author_image_cover' )); ?>"/>


						<div class="wrap-btn" style="width: 100%; clear: both; margin-top: 10px; margin-bottom: 5px;">
							<a href="#" target="author-upload-image_<?php echo $this->id; ?>"
							   class="author_upload-image-cover-btn  button button-secondary"><?php esc_html_e( 'Select Image', 'chfw-lang' ); ?></a>
						</div>
						<p>
							<b><label for="<?php echo ( $this->get_field_id( 'author_image' )); ?>">
									<?php esc_html_e( 'Author Picture ', 'chfw-lang' ) ?></label></b>
							<img
								src="<?php echo esc_url( $author_image ); ?>"
								class="author-image responsive-image" alt="Author image"/>
							<input
								class="upload-field-btn author-image-field input-text" id="" type="hidden"
								value="<?php echo ( $author_image ); ?>"
								name="<?php echo esc_attr( $this->get_field_name( 'author_image' )); ?>"
								id="<?php echo esc_attr( $this->get_field_id( 'author_image' )); ?>"/>


						<div class="wrap-btn" style="width: 100%; clear: both; margin-top: 10px; margin-bottom: 5px;">
							<a href="#" target="author-upload-image_<?php echo $this->id; ?>"
							   class="author_upload-image-btn  button button-secondary"><?php esc_html_e( 'Select Image', 'chfw-lang' ); ?></a>
						</div>
						</p>

					</div>

					<div class="tab-content tab3 ">


						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( 'facebook_link' )); ?>"><?php esc_html_e( 'Facebook Username', 'chfw-lang' ); ?></label>
							<input
								id="<?php echo esc_attr( $this->get_field_id( 'facebook_link' )); ?>"
								name="<?php echo esc_attr( $this->get_field_name( 'facebook_link' )); ?>"
								value="<?php echo esc_attr( $facebook_link, 'chfw-lang' ); ?>" type="text"
								<?php checked( esc_attr( $facebook_link, 'on' ) ); ?> />
						</p>

						<p>
							<label
								for="<?php echo esc_attr(  $this->get_field_id( 'twitter_link' )); ?>"><?php esc_html_e( 'Twitter Username', 'chfw-lang' ); ?></label>
							<input
								id="<?php echo esc_attr( $this->get_field_id( 'twitter_link' )); ?>"
								name="<?php echo esc_attr(  $this->get_field_name( 'twitter_link' )); ?>"
								value="<?php echo esc_attr( $twitter_link ); ?>"/>
						</p>

						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( 'instagram_link' )); ?>"><?php esc_html_e( 'Instagram Username', 'chfw-lang' ); ?></label>
							<input
								id="<?php echo esc_attr( $this->get_field_id( 'instagram_link' )); ?>"
								name="<?php echo esc_attr(  $this->get_field_name( 'instagram_link' )); ?>"
								value="<?php echo esc_attr( $instagram_link ); ?>" type="text"/>
						</p>

						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( 'pinterest_link' )); ?>"><?php esc_html_e( 'Pinterest Username', 'chfw-lang' ); ?></label>
							<input
								id="<?php echo esc_attr( $this->get_field_id( 'pinterest_link' )); ?>"
								name="<?php echo esc_attr( $this->get_field_name( 'pinterest_link') ); ?>"
								value="<?php echo esc_attr( $pinterest_link ); ?>" type="text"/>
						</p>

						<p>
							<label
								for="<?php echo esc_attr( $this->get_field_id( 'flicker_link' )); ?>"><?php esc_html_e( 'Flicker Username', 'chfw-lang' ); ?></label>
							<input
								id="<?php echo esc_attr( $this->get_field_id( 'flicker_link' )); ?>"
								name="<?php echo esc_attr( $this->get_field_name( 'flicker_link' )); ?>"
								value="<?php echo esc_attr( $flicker_link ); ?>" type="text"/>
						</p>


						<p>
							<input id="<?php echo esc_attr( $this->get_field_id( 'facebook_show' )); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( 'facebook_show' )); ?>" type="checkbox"
							       value="1" <?php checked( esc_attr( $facebook_show, 'on' ) ); ?> /> <label
								for="<?php echo esc_attr( $this->get_field_id( 'facebook_show' )); ?>"><?php esc_html_e( 'Display item facebook?', 'chfw-lang' ); ?></label>
						</p>

						<p>
							<input id="<?php echo esc_attr( $this->get_field_id( 'twitter_show' )); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( 'twitter_show' )); ?>" type="checkbox"
							       value="1" <?php checked( esc_attr( $twitter_show, 'on' ) ); ?> /> <label
								for="<?php echo esc_attr( $this->get_field_id( 'twitter_show' )); ?>"><?php esc_html_e( 'Display item twitter?', 'chfw-lang' ); ?></label>
						</p>

						<p>
							<input id="<?php echo esc_attr( $this->get_field_id( 'instagram_show' )); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( 'instagram_show' )); ?>" type="checkbox"
							       value="1" <?php checked( esc_attr( $instagram_show, 'on' ) ); ?> />
							<label
								for="<?php echo esc_attr( $this->get_field_id( 'instagram_show' )); ?>"><?php esc_html_e( 'Display item instagram?', 'chfw-lang' ); ?></label>
						</p>

						<p>
							<input id="<?php echo esc_attr( $this->get_field_id( 'pinterest_show' )); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( 'pinterest_show' )); ?>" type="checkbox"
							       value="1" <?php checked( esc_attr( $pinterest_show, 'on' ) ); ?> />
							<label
								for="<?php echo esc_attr( $this->get_field_id( 'pinterest_show' )); ?>"><?php esc_html_e( 'Display item pinterest?', 'chfw-lang' ); ?></label>
						</p>

						<p>
							<input id="<?php echo esc_attr( $this->get_field_id( 'flicker_show' )); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( 'flicker_show' )); ?>" type="checkbox"
							       value="1" <?php checked( esc_attr( $flicker_show, 'on' ) ); ?> /> <label
								for="<?php echo esc_attr( $this->get_field_id( 'flicker_show' )); ?>"><?php esc_html_e( 'Display item flicker?', 'chfw-lang' ); ?></label>
						</p>


					</div>


					<div class="tab-content tab4 ">

						<p>
							<b><label for="<?php echo esc_attr($this->get_field_id( 'author_bgcolor' )); ?>">
									<?php esc_html_e( 'Background Color ', 'chfw-lang' ) ?></label></b>
							<input data-default-color="#4389C5" type="text" class="input-text ch-color-picker"
							       value="<?php echo esc_attr( $author_bgcolor ); ?>"
							       name="<?php echo esc_attr($this->get_field_name( 'author_bgcolor' )); ?>"
							       id="<?php echo esc_attr( $this->get_field_id( 'author_bgcolor' )); ?>"/>
						</p>


						<p>
							<b><label for="<?php echo esc_attr($this->get_field_id( 'author_title_color' )); ?>">
									<?php esc_html_e( 'Author Title Color ', 'chfw-lang' ) ?></label></b>
							<input data-default-color="#262626" type="text" class="input-text ch-color-picker"
							       value="<?php echo esc_attr( $author_title_color ); ?>"
							       name="<?php echo esc_attr( $this->get_field_name( 'author_title_color' )); ?>"
							       id="<?php echo esc_attr($this->get_field_id( 'author_title_color' )); ?>"/>
						</p>


						<p>
							<b><label for="<?php echo esc_attr($this->get_field_id( 'author_comment_color' )); ?>">
									<?php esc_html_e( 'Author Comment Color ', 'chfw-lang' ) ?></label></b>
							<input data-default-color="#737373" type="text" class="input-text ch-color-picker"
							       value="<?php echo esc_attr( $author_comment_color ); ?>"
							       name="<?php echo esc_attr($this->get_field_name( 'author_comment_color' )); ?>"
							       id="<?php echo esc_attr($this->get_field_id( 'author_comment_color' )); ?>"/>
						</p>

					</div>
				</div>
			</div>
			<script>
				jQuery('.tabbing_<?php echo $this->id?> ul.tabs_st_studio-engine li').bind("click", function () {
					var tab_id = jQuery(this).attr('data-tab');
					jQuery('.tabbing_<?php echo $this->id?> ul.tabs_st_studio-engine li').removeClass('current');
					jQuery('.tabbing_<?php echo $this->id?> .tabcontainer .tab-content').removeClass('current');
					jQuery(this).addClass('current');
					jQuery(".tabbing_<?php echo $this->id?> ." + tab_id).addClass('current');
				});
			</script>


		</div>
		<?php


	}

}