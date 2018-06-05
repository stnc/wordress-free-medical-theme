<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Widget Social
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_Social_Widget extends WP_Widget {
	/* ---------------------------------------------------------------------------
	 * INIT
	 * --------------------------------------------------------------------------- */
	function __construct() {
		parent::__construct( 'CHfw_Social_Widget', esc_html__( 'CH Social Widget', 'chfw-lang' ),
			array( 'description' => esc_html__( 'CH Social Widget', 'chfw-lang' ) ) );
	}

	/* ---------------------------------------------------------------------------
    * Deals with the settings when they are saved by the admin.
    * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['description']    = strip_tags( $new_instance['description'] );
		$instance['title']          = strip_tags( $new_instance['title'] );
		$instance['facebook_show']  = strip_tags( $new_instance['facebook_show'] );
		$instance['twitter_show']   = strip_tags( $new_instance['twitter_show'] );
		$instance['google_show']    = strip_tags( $new_instance['google_show'] );
		$instance['instagram_show'] = strip_tags( $new_instance['instagram_show'] );
		$instance['facebook_show']  = strip_tags( $new_instance['facebook_show'] );
		$instance['pinterest_show'] = strip_tags( $new_instance['pinterest_show'] );
		$instance['rss_show']       = strip_tags( $new_instance['rss_show'] );
		$instance['flicker_show']   = strip_tags( $new_instance['flicker_show'] );

		return $instance;
	}

	/* ---------------------------------------------------------------------------
 * Outputs the HTML for this widget.
 * --------------------------------------------------------------------------- */

	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}
		/*else
			echo $args['before_title'] . __('Social Widget', 'social_widget_domain') . $args['after_title'];*/
		// This is where you run the code and display the output
		$this->html_output( $instance );

		echo $args['after_widget'];
	}

	// widget frontend html
	public function html_output( $instance ) {
		//$CHfw_rdx_options = get_option( 'sc_fw_themes' );
		global $CHfw_themeReduxOptionName;
		$CHfw_rdx_options = get_option( $CHfw_themeReduxOptionName );

		$description    = isset( $instance['description'] ) ? $instance['description'] : '';
		$facebook_show  = isset( $instance['facebook_show'] ) ? $instance['facebook_show'] : 0;
		$twitter_show   = isset( $instance['twitter_show'] ) ? $instance['twitter_show'] : 0;
		$google_show    = isset( $instance['google_show'] ) ? $instance['google_show'] : 0;
		$instagram_show = isset( $instance['instagram_show'] ) ? $instance['instagram_show'] : 0;
		$facebook_show  = isset( $instance['facebook_show'] ) ? $instance['facebook_show'] : 0;
		$pinterest_show = isset( $instance['pinterest_show'] ) ? $instance['pinterest_show'] : 0;
		$flicker_show   = isset( $instance['flicker_show'] ) ? $instance['flicker_show'] : 0;
		$rss_show       = isset( $instance['rss_show'] ) ? $instance['rss_show'] : 0;
		?>
		<div class="widget-content">

			<?php if ( $description != null ) { ?>
				<p> <?php echo $description ?></p>
			<?php } ?>
			<div class="social-container clearfix">
				<ul>

					<?php if ( $facebook_show != null ) { ?>
						<li>
                            <a href="https://www.facebook.com/<?php echo $CHfw_rdx_options['facebook']; ?>"
						       title="Facebook" class="sc_fw-facebook sc_fw-social-btn "
						       target="_blank"><i class="fa fa-facebook"></i>
                            </a>
                        </li>
					<?php } ?>

					<?php if ( $twitter_show != null ) { ?>
						<li>
                            <a href="https://twitter.com/<?php echo $CHfw_rdx_options['twitter']; ?>" title="Twitter"
						       class="sc_fw-twitter sc_fw-social-btn"
						       target="_blank"><i class="fa fa-twitter"></i>
                            </a>
                        </li>
					<?php } ?>

					<?php if ( $google_show != null ) { ?>
						<li>
                            <a href="https://www.google.com/<?php echo $CHfw_rdx_options['googleplus']; ?>"
						       title="GooglePlus" class="sc_fw-google-plus sc_fw-social-btn" target="_blank">
                                <i class="fa fa-google-plus"></i>
                            </a>
                        </li>
					<?php } ?>

					<?php if ( $instagram_show != null ) { ?>
						<li>
                            <a href="https://instagram.com/<?php echo $CHfw_rdx_options['instagram']; ?>"
						       title="Instagram" class="sc_fw-instagram sc_fw-social-btn " target="_blank">
                                <i class="fa fa-instagram"></i>
                            </a>
                        </li>
					<?php } ?>

					<?php if ( $pinterest_show != null ) { ?>
						<li>
                            <a href="https://www.pinterest.com/<?php echo $CHfw_rdx_options['pinterest']; ?>"
						       title="Pinterest" class="sc_fw-pinterest sc_fw-social-btn " target="_blank">
                                <i class="fa fa-pinterest"></i>
							</a>
                        </li>
					<?php } ?>

					<?php if ( $flicker_show != null ) { ?>
						<li>
                            <a href="https://www.flickr.com/<?php echo $CHfw_rdx_options['flickr']; ?>" title="Flickr"
						       class="sc_fw-flickr sc_fw-social-btn " target="_blank">
                                <i class="fa fa-flickr"></i>
                            </a>
						</li>
					<?php } ?>

					<?php if ( $rss_show != null ) { ?>
						<li>
                            <a href="<?php echo $CHfw_rdx_options['rss']; ?>" title="RSS" class="sc_fw-rss sc_fw-social-btn " target="_blank">
                                <i class="fa fa-rss"></i>
                            </a>
                        </li>
					<?php } ?>

				</ul>
			</div>
		</div>
		<?php
	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	public function form( $instance ) {

		$title          = isset( $instance['title'] ) ? $instance['title'] : esc_html__( 'Subscribe', 'chfw-lang' );
		$description    = isset( $instance['description'] ) ? $instance['description'] : esc_html__( 'Subscribe to our profiles on the following social networks.' ,'chfw-lang');
		$facebook_show  = isset( $instance['facebook_show'] ) ? $instance['facebook_show'] : 0;
		$twitter_show   = isset( $instance['twitter_show'] ) ? $instance['twitter_show'] : 0;
		$google_show    = isset( $instance['google_show'] ) ? $instance['google_show'] : 0;
		$instagram_show = isset( $instance['instagram_show'] ) ? $instance['instagram_show'] : 0;
		$pinterest_show = isset( $instance['pinterest_show'] ) ? $instance['pinterest_show'] : 0;
		$flicker_show   = isset( $instance['flicker_show'] ) ? $instance['flicker_show'] : 0;
		$rss_show       = isset( $instance['rss_show'] ) ? $instance['rss_show'] : 0;
		// Widget admin html form
		?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php esc_html_e( 'Title', 'chfw-lang' ); ?>
				:</label>
			<input class="input-text"
			       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       type="text"
			       value="<?php echo esc_attr( $title ); ?>"/>
		<p>


		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"><?php esc_html_e( 'Description', 'chfw-lang' ); ?>
				:</label>
            <textarea name="<?php echo esc_attr( $this->get_field_name( 'description' ) ); ?>"
                      id="<?php echo esc_attr( $this->get_field_id( 'description' ) ); ?>"
                      style="float: left; clear: both; height: 100px; width: 100%; padding: 3px;"><?php echo esc_attr( $description ); ?></textarea>
		</p>


		<p>
            <input id="<?php echo esc_attr( $this->get_field_id( 'facebook_show' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'facebook_show' ) ); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $facebook_show, 'on' ) ); ?>/>
			<label for="<?php echo esc_attr( $this->get_field_id( 'facebook_show' ) ); ?>"><?php esc_html_e( 'Display item facebook?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr( $this->get_field_id( 'twitter_show' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'twitter_show' ) ); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $twitter_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'twitter_show' ) ); ?>"><?php esc_html_e( 'Display item twitter?', 'chfw-lang' ); ?></label>
		</p>


		<p><input id="<?php echo esc_attr( $this->get_field_id( 'instagram_show' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'instagram_show' ) ); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $instagram_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'instagram_show' ) ); ?>"><?php esc_html_e( 'Display item instagram?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr( $this->get_field_id( 'pinterest_show' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'pinterest_show' ) ); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $pinterest_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'pinterest_show' ) ); ?>"><?php esc_html_e( 'Display item pinterest?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr( $this->get_field_id( 'google_show' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'google_show' ) ); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $google_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'google_show' ) ); ?>"><?php esc_html_e( 'Display item google?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr( $this->get_field_id( 'flicker_show' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'flicker_show' ) ); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $flicker_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'flicker_show' ) ); ?>"><?php esc_html_e( 'Display item flicker?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr( $this->get_field_id( 'rss_show' ) ); ?>"
		          name="<?php echo esc_attr( $this->get_field_name( 'rss_show' ) ); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $rss_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'rss_show' ) ); ?>"><?php esc_html_e( 'Display item rss?', 'chfw-lang' ); ?></label>
		</p>
		<?php
	}

	// Updating widget replacing old instances with new
	/*  public function update($new_instance, $old_instance)
	  {
		  $instance = array();
		  $instance['title'] = (! empty($new_instance['title'])) ? strip_tags($new_instance['title']) : '';
		  return $instance;
	  }*/
}

