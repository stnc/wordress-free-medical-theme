<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Widget Last  Post
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_Last_Post extends WP_Widget {
	/* ---------------------------------------------------------------------------
	 * INIT
	 * --------------------------------------------------------------------------- */
	function __construct() {
		$widget_ops = array(
			'classname'   => 'CHfw_Last_Post',
			'description' => esc_html__( "CH Last Posts", 'chfw-lang' )
		);
		parent::__construct( 'CHfw_Last_Post', esc_html__( 'CH Last Posts', 'chfw-lang' ), $widget_ops );
	}

	/* ---------------------------------------------------------------------------
 * Deals with the settings when they are saved by the admin.
 * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance                  = $old_instance;
		$instance['title']         = strip_tags( $new_instance['title'] );
		$instance['limit']         = strip_tags( $new_instance['limit'] );
		$instance['author_show']   = strip_tags( $new_instance['author_show'] );
		$instance['picture_show']  = strip_tags( $new_instance['picture_show'] );
		$instance['date_show']     = strip_tags( $new_instance['date_show'] );
		$instance['comments_show'] = strip_tags( $new_instance['comments_show'] );

		return $instance;
	}


	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {
		extract( $args );
		$title             = ( $instance['title'] ) ? $instance['title'] : esc_html__( 'Last Posts', 'chfw-lang' );
		$limit             = ( $instance['limit'] ) ? $instance['limit'] : 5;
		$instance['limit'] = ( $instance['limit'] ) ? $instance['limit'] : 5;


		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		/**
		 * Widget Content
		 */

		/*for populer post  yoruma göre
		  $last_post_args = array(
			 'posts_per_page' => $limit + 1,
			 'orderby' => 'comment_count',
			 'order' => 'DESC',
			 'ignore_sticky_posts' => 1
		 );  $last_post_args_query = new WP_Query($last_post_args);
		 */

		$last_post_args       = array(
			'posts_per_page'      => $limit,
			'orderby'             => 'post_date',
			'order'               => 'DESC',
			'post_type'           => 'post',
			'ignore_sticky_posts' => 1
		);
		$last_post_args_query = new WP_Query( $last_post_args );


		if ( ! isset( $instance['author_show'] ) ) {
			$instance['author_show'] = 0;
		}


		if ( ! isset( $instance['picture_show'] ) ) {
			$instance['picture_show'] = 0;
		}

		if ( ! isset( $instance['date_show'] ) ) {
			$instance['date_show'] = 0;
		}

		if ( ! isset( $instance['comments_show'] ) ) {
			$instance['comments_show'] = 0;
		}
		/**
		 * Check if zilla likes plugin exists
		 */
		if ( $last_post_args_query->have_posts() ) : ?>
			<ul class="sc_fw-theme-last_post_list">
				<?php while ( $last_post_args_query->have_posts() ) : ?>
					<?php $last_post_args_query->the_post(); ?>
					<?php if ( get_the_content() != '' ) : ?>
						<li class="lastposts">
							<?php if ( $instance['picture_show'] != null ) : ?>
								<div class="thumbs">
									<?php
									if ( get_post_format() != 'quote' ) {
										echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array( 'class' => '' ) );
									}
									?>
								</div>
							<?php endif; ?>
							<div class="lastposts-container">
								<h4>
									<a href="<?php echo get_permalink(); ?>" class="nav-button" rel="bookmark" title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
								</h4>

								<div class="last_post_enrty">
									<?php if ( $instance['date_show'] != null ) : ?>
										<div class="post-date">
											<?php echo get_the_date( 'd M , Y' ); ?>
										</div>
									<?php endif; ?>
									<?php if ( $instance['author_show'] != null ) : ?>
										<span class="post-author"> by
											<?php echo get_the_author_link(); ?>
                                        </span>
									<?php endif; ?>

									<?php if ( $instance['comments_show'] != null ) : ?>
										<div class="comments">
											<?php comments_popup_link( esc_html__( 'Comments (0)', 'chfw-lang' ), esc_html__( 'Comments (1)', 'chfw-lang' ), esc_html__( 'Comments (%)', 'chfw-lang' ) ); ?>
										</div>
									<?php endif; ?>
								</div>
							</div><!-- end lastposts-container -->
						</li>
					<?php endif; ?>
				<?php endwhile; ?>
			</ul>
		<?php endif; ?>
		<?php wp_reset_query(); ?>
		<!-- end post -->
		<?php
		echo $after_widget;
	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	function form( $instance ) {
		$title         = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : esc_html__( 'Last Posts', 'chfw-lang' );
		$limit         = isset( $instance['limit'] ) ? absint( $instance['limit'] ) : 5;
		$date_show     = isset( $instance['date_show'] ) ? absint( $instance['date_show'] ) : 0;
		$author_show   = isset( $instance['author_show'] ) ? absint( $instance['author_show'] ) : 0;
		$comments_show = isset( $instance['comments_show'] ) ? absint( $instance['comments_show'] ) : 0;
		$picture_show  = isset( $instance['picture_show'] ) ? absint( $instance['picture_show'] ) : 0;

		?>
		<b><label for="<?php echo $this->get_field_id( 'title' ); ?>">
				<?php _e( 'Title ', 'chfw-lang' ) ?></label></b>
		<br/>
		<input type="text" class="input-text"
		       value="<?php echo esc_attr( $title ); ?>"
		       name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>"
		       id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"/>
		<br/>
		<b><label for="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>">
				<?php _e( 'Limit Posts Number ', 'chfw-lang' ) ?></label></b>
		<br/>

		<input type="text" class="input-text"
		       value="<?php echo esc_attr( $limit ); ?>"
		       name="<?php echo esc_attr($this->get_field_name( 'limit') ); ?>"
		       id="<?php echo esc_attr($this->get_field_id( 'limit' )); ?>"/>


		<p><input id="<?php echo esc_attr($this->get_field_id( 'date_show' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'date_show' )); ?>" type="checkbox"
		          value="1" <?php checked( esc_attr( $date_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'date_show' )); ?>"><?php _e( 'Display item date?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr($this->get_field_id( 'author_show' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'author_show' )); ?>"
		          type="checkbox"
		          value="1" <?php checked( esc_attr( $author_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'author_show' )); ?>"><?php _e( 'Display item author?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr($this->get_field_id( 'comments_show' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'comments_show' )); ?>"
		          type="checkbox"
		          value="1" <?php checked( esc_attr( $comments_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'comments_show' )); ?>"><?php _e( 'Display item comments?', 'chfw-lang' ); ?></label>
		</p>

		<p><input id="<?php echo esc_attr($this->get_field_id( 'picture_show' )); ?>"
		          name="<?php echo esc_attr($this->get_field_name( 'picture_show' )); ?>"
		          type="checkbox"
		          value="1" <?php checked( esc_attr( $picture_show, 'on' ) ); ?>/>
			<label
				for="<?php echo esc_attr($this->get_field_id( 'picture_show' )); ?>"><?php _e( 'Display item picture?', 'chfw-lang' ); ?></label>
		</p>

		<?php
	}
}

