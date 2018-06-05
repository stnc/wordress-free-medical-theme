<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Widget Last Popular Post( Tabs)
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_LastPost_PopularPost_Tabs_Widget extends WP_Widget {
	/* ---------------------------------------------------------------------------
	 * INIT
	 * --------------------------------------------------------------------------- */
	public function __construct() {

		$widget_ops = array(
			'classname'   => 'CHfwLastPostPopularPostTabsWidget',
			'description' => esc_html__( "CH Popular Posts", 'chfw-lang' )
		);
		parent::__construct( 'CHfwLastPostPopularPostTabsWidget', esc_html__( 'CH Last and Popular post TAB', 'chfw-lang' ), $widget_ops );
	}

	/* ---------------------------------------------------------------------------
 * Deals with the settings when they are saved by the admin.
 * --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance = $old_instance;

		$instance['tab_popular_title']     = strip_tags( $new_instance['tab_popular_title'] );
		$instance['tab_recent_title']      = strip_tags( $new_instance['tab_recent_title'] );
		$instance['tab_popular_limit']     = intval( $new_instance['tab_popular_limit'] );
		$instance['tab_recent_limit']      = intval( $new_instance['tab_recent_limit'] );
		$instance['tab_bgcolor']           = strip_tags( $new_instance['tab_bgcolor'] );
		$instance['active_tab_bgcolor']    = strip_tags( $new_instance['active_tab_bgcolor'] );
		$instance['inactive_tab_bgcolor']  = strip_tags( $new_instance['inactive_tab_bgcolor'] );
		$instance['text_color']            = strip_tags( $new_instance['text_color'] );
		$instance['border_enable_disable'] = strip_tags( $new_instance['border_enable_disable'] );

		$instance['tab_recent_picture_show']  = strip_tags( $new_instance['tab_recent_picture_show'] );
		$instance['tab_recent_date_show']     = strip_tags( $new_instance['tab_recent_date_show'] );
		$instance['tab_recent_author_show']   = strip_tags( $new_instance['tab_recent_author_show'] );
		$instance['tab_recent_comments_show'] = strip_tags( $new_instance['tab_recent_comments_show'] );
		$instance['tab_recent_author_show']   = strip_tags( $new_instance['tab_recent_author_show'] );


		$instance['tab_popular_picture_show']  = strip_tags( $new_instance['tab_popular_picture_show'] );
		$instance['tab_popular_date_show']     = strip_tags( $new_instance['tab_popular_date_show'] );
		$instance['tab_popular_author_show']   = strip_tags( $new_instance['tab_popular_author_show'] );
		$instance['tab_popular_comments_show'] = strip_tags( $new_instance['tab_popular_comments_show'] );

		return $instance;
	}

	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	function widget( $args, $instance ) {
		extract( $args );
		$cwidgetid         = $this->id;
		$tab_popular_title = isset( $instance['tab_popular_title'] ) ? $instance['tab_popular_title'] : __( 'Popular Posts', 'chfw-lang' );
		$tab_recent_title  = isset( $instance['tab_recent_title'] ) ? $instance['tab_recent_title'] : __( 'Popular Posts', 'chfw-lang' );
		$tab_popular_limit = isset( $instance['tab_popular_limit'] ) ? $instance['tab_popular_limit'] : 5;
		$tab_recent_limit  = isset( $instance['tab_recent_limit'] ) ? $instance['tab_recent_limit'] : 5;

		$tab_bgcolor          = isset( $instance['tab_bgcolor'] ) ? $instance['tab_bgcolor'] : '';
		$active_tab_bgcolor   = isset( $instance['active_tab_bgcolor'] ) ? $instance['active_tab_bgcolor'] : '';
		$inactive_tab_bgcolor = isset( $instance['inactive_tab_bgcolor'] ) ? $instance['inactive_tab_bgcolor'] : '';
		$text_color           = isset( $instance['text_color'] ) ? $instance['text_color'] : '';

		$border_enable_disable = isset( $instance['border_enable_disable'] ) ? $instance['border_enable_disable'] : 'border-style: solid;';


		if ( $border_enable_disable == null ) {
			$border_enable_disable = ' border-style: none;';
		}

		echo $before_widget;

		// echo $before_title;
		//   echo $after_title;


		?>


		<ul class="nav nav-tabs">
			<li data-container="<?php echo '#' . $this->id ?>" data-tab="lastandrecent_popular_tabs" class="active">
				<a data-toggle="tab" class="first" href="javascript:void(0)"><?php echo $tab_popular_title ?></a>
            </li>
			<li data-container="<?php echo '#' . $this->id ?>" data-tab="lastandrecent_recent_tabs">
                <a data-toggle="tab" href="javascript:void(0)"><?php echo $tab_recent_title ?></a>
			</li>
		</ul>

		<div class="tab-content">
			<div class="lastandrecent_popular_tabs tab-pane active">
				<?php $this->popular_posts( $tab_recent_limit, $instance ); ?>
			</div>
			<div class="lastandrecent_recent_tabs tab-pane" >
				<?php $this->last_posts( $tab_popular_limit, $instance ) ?>
			</div>
		</div>

		<?php
		add_action( 'wp_footer', function () use ( $cwidgetid, $tab_bgcolor, $text_color, $border_enable_disable, $active_tab_bgcolor, $inactive_tab_bgcolor ) {
			?>
			<style>
                <?php  echo '#'.$cwidgetid ; ?>.CHfwLastPostPopularPostTabsWidget .nav-tabs {
				<?php  echo 'background:'.$tab_bgcolor.';'; ?>
				}

				<?php  echo '#'.$cwidgetid ; ?>.CHfwLastPostPopularPostTabsWidget .nav-tabs li a {
				<?php  echo 'color:'.$text_color.';'; ?>
				}

				<?php  echo '#'.$cwidgetid ; ?>.CHfwLastPostPopularPostTabsWidget .tab-content {
				border-width: 3px;<?php echo 'border-color:'.$tab_bgcolor.';';?>
				}

				<?php  echo '#'.$cwidgetid ; ?>.CHfwLastPostPopularPostTabsWidget .nav-tabs > li.active > a,
				<?php  echo '#'.$cwidgetid ; ?>.CHfwLastPostPopularPostTabsWidget .nav-tabs > li.active > a:focus,
				<?php  echo '#'.$cwidgetid ; ?>.CHfwLastPostPopularPostTabsWidget .nav-tabs > li.active > a:hover {
				<?php  echo 'background:'.$active_tab_bgcolor.';'; ?>
				}

				<?php  echo '#'.$cwidgetid ; ?>.CHfwLastPostPopularPostTabsWidget .nav-tabs > li > a {
                    <?php  echo 'background:'.$inactive_tab_bgcolor.';'; ?>
				}
			</style>
			<?php
		}, 20 );
		echo $after_widget;
	}

	/*
	 * Response populer post select
	 * */

	public function popular_posts( $tab_recent_limit, $instance ) {
		?>
		<!-- last/recent posts -->
		<ul class="sc_fw-theme-last_post_list">

			<?php

			$last_post_args = array(
				'posts_per_page'      => $tab_recent_limit,
				'meta_key'            => 'CHfw-PostViewsCount',
				'orderby'             => 'meta_value_num',
				'order'               => 'DESC',
				'post_type'           => 'post',
				'ignore_sticky_posts' => 1
			);

			$last_post_args_query = new WP_Query( $last_post_args );


			$tab_recent_picture_show  = isset( $instance['tab_recent_picture_show'] ) ? absint( $instance['tab_recent_picture_show'] ) : 5;
			$tab_recent_date_show     = isset( $instance['tab_recent_date_show'] ) ? absint( $instance['tab_recent_date_show'] ) : 0;
			$tab_recent_author_show   = isset( $instance['tab_recent_author_show'] ) ? absint( $instance['tab_recent_author_show'] ) : 0;
			$tab_recent_comments_show = isset( $instance['tab_recent_comments_show'] ) ? absint( $instance['tab_recent_comments_show'] ) : 0;


			/**
			 * Check if zilla likes plugin exists
			 */
			if ( $last_post_args_query->have_posts() ) :
				while ( $last_post_args_query->have_posts() ) {
					$last_post_args_query->the_post();

					?>

					<?php if ( get_the_content() != '' ) : ?>
						<li class="lastposts">
							<?php if ( $tab_recent_picture_show != null ) { ?>
								<div class="thumbs">
									<?php
									if ( get_post_format() != 'quote' ) {
										echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array(
											'class' => 'img-responsive'
										) );
									}
									?>
								</div>
							<?php } ?>
							<div class="lastposts-container">


								<div class="last_post_enrty">
									<h4>
										<a href="<?php echo get_permalink(); ?>" class="nav-button" rel="bookmark"
										   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
									</h4>
									<?php if ( $tab_recent_date_show != null ) { ?>
										<div class="post-date">
											<?php echo get_the_date( 'd M , Y' ); ?>
										</div>
									<?php } ?>
									<?php if ( $tab_recent_author_show != null ) { ?>
										<span class="post-author">
			                                <?php echo get_the_author_link(); ?></span>
									<?php } ?>

									<?php if ( $tab_recent_comments_show != null ) { ?>
										<div class="comments">
											<?php comments_popup_link( esc_html__( 'Comments (0)', 'chfw-lang' ), __( 'Comments (1)', 'chfw-lang' ), __( 'Comments (%)', 'chfw-lang' ) ); ?>
										</div>
									<?php } ?>
								</div>
							</div> <!-- end lastposts-container -->
						</li>


					<?php endif;
				}

			endif;
			wp_reset_query();

			?>
		</ul>
		<!-- end post -->
		<?php
	}

	/*
	 * Response last  post if select
	 * */
	public function last_posts( $tab_popular_limit, $instance ) {
		?>
		<!-- last/recent posts -->
		<ul class="sc_fw-theme-last_post_list">

			<?php

			$last_post_args       = array(
				'posts_per_page'      => $tab_popular_limit,
				'orderby'             => 'post_date',
				'order'               => 'DESC',
				'post_type'           => 'post',
				'ignore_sticky_posts' => 1
			);
			$last_post_args_query = new WP_Query( $last_post_args );


			$tab_popular_picture_show  = isset( $instance['tab_popular_picture_show'] ) ? absint( $instance['tab_popular_picture_show'] ) : 5;
			$tab_popular_author_show   = isset( $instance['tab_popular_author_show'] ) ? absint( $instance['tab_popular_author_show'] ) : 0;
			$tab_popular_comments_show = isset( $instance['tab_popular_comments_show'] ) ? absint( $instance['tab_popular_comments_show'] ) : 0;
			$tab_popular_date_show     = isset( $instance['tab_popular_date_show'] ) ? absint( $instance['tab_popular_date_show'] ) : 0;
			/**
			 * Check if zilla likes plugin exists
			 */
			if ( $last_post_args_query->have_posts() ) :
				while ( $last_post_args_query->have_posts() ) {
					$last_post_args_query->the_post();

					?>

					<?php if ( get_the_content() != '' ) : ?>
						<li class="lastposts">
							<?php if ( $tab_popular_picture_show != null ) { ?>
								<div class="thumbs">
									<?php
									if ( get_post_format() != 'quote' ) {
										echo get_the_post_thumbnail( get_the_ID(), 'thumbnail', array(
											'class' => 'img-responsive'
										) );
									}
									?>
								</div>
							<?php } ?>
							<div class="lastposts-container">
								<h4>
									<a href="<?php echo get_permalink(); ?>" class="nav-button" rel="bookmark"
									   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?></a>
								</h4>

								<div class="last_post_enrty">
									<?php if ( $tab_popular_date_show != null ) { ?>
										<div class="post-date">
											<?php echo get_the_date( 'd M , Y' ); ?>
										</div>
									<?php } ?>
									<?php if ( $tab_popular_author_show != null ) { ?>
										<span class="post-author">
		                                <?php echo get_the_author_link(); ?>
		                                </span>
									<?php } ?>

									<?php if ( $tab_popular_comments_show != null ) { ?>
										<div class="comments">
											<?php comments_popup_link( esc_html__( 'Comments (0)', 'chfw-lang' ), esc_html__( 'Comments (1)', 'chfw-lang' ), esc_html__( 'Comments (%)', 'chfw-lang' ) ); ?>
										</div>
									<?php } ?>
								</div>
							</div> <!-- end lastposts-container -->
						</li>


					<?php endif;
				}


			endif;
			wp_reset_query();

			?>
		</ul>
		<!-- end post -->
		<?php
	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	public function form( $instance ) {


		$tab_recent_title  = isset( $instance['tab_recent_title'] ) ? $instance['tab_recent_title'] : esc_html__( 'Recent', 'chfw-lang' );
		$tab_popular_title = isset( $instance['tab_popular_title'] ) ? $instance['tab_popular_title'] : esc_html__( 'Popular', 'chfw-lang' );

		$tab_popular_date_show     = isset( $instance['tab_popular_date_show'] ) ? $instance['tab_popular_date_show'] : 0;
		$tab_popular_limit         = isset( $instance['tab_popular_limit'] ) ? $instance['tab_popular_limit'] : 5;
		$tab_popular_comments_show = isset( $instance['tab_popular_comments_show'] ) ? $instance['tab_popular_comments_show'] : 0;
		$tab_recent_limit          = isset( $instance['tab_recent_limit'] ) ? $instance['tab_recent_limit'] : 5;


		$tab_recent_picture_show  = isset( $instance['tab_recent_picture_show'] ) ? $instance['tab_recent_picture_show'] : 0;
		$tab_popular_picture_show = isset( $instance['tab_popular_picture_show'] ) ? $instance['tab_popular_picture_show'] : 0;
		$tab_recent_comments_show = isset( $instance['tab_recent_comments_show'] ) ? $instance['tab_recent_comments_show'] : 0;
		$tab_popular_author_show  = isset( $instance['tab_popular_author_show'] ) ? $instance['tab_popular_author_show'] : 0;
		$tab_recent_author_show   = isset( $instance['tab_recent_author_show'] ) ? $instance['tab_recent_author_show'] : 0;
		$tab_recent_date_show     = isset( $instance['tab_recent_date_show'] ) ? $instance['tab_recent_date_show'] : 0;


		$tab_bgcolor           = isset( $instance['tab_bgcolor'] ) ? $instance['tab_bgcolor'] : '#F7F7F7';
		$active_tab_bgcolor    = isset( $instance['active_tab_bgcolor'] ) ? $instance['active_tab_bgcolor'] : '#f1f1f1';
		$inactive_tab_bgcolor  = isset( $instance['inactive_tab_bgcolor'] ) ? $instance['inactive_tab_bgcolor'] : '';
		$text_color            = isset( $instance['text_color'] ) ? $instance['text_color'] : '';
		$border_enable_disable = isset( $instance['border_enable_disable'] ) ? $instance['border_enable_disable'] : 0;

		?>
		<div class="lastPopPecentTabbing_<?php echo $this->id ?>">
			<ul class="tabs_st_studio-engine">
				<li class="tab-link current" data-tab="tab1"> <?php _e( 'Popular ', 'chfw-lang' ) ?></li>
				<li class="tab-link" data-tab="tab2"><?php _e( 'Recent ', 'chfw-lang' ) ?></li>
				<li class="tab-link" data-tab="tab3"><?php _e( 'Style ', 'chfw-lang' ) ?></li>
			</ul>
			<div class="tabcontainer">
				<div class="tab-content tab1 current">
					<b><label for="<?php echo esc_attr( $this->get_field_id( 'tab_popular_title' ) ); ?>">
							<?php _e( 'Title', 'chfw-lang' ) ?></label></b> <br/>
					<input type="text" class="input-text"
					       value="<?php echo esc_attr( $tab_popular_title ); ?>"
					       name="<?php echo esc_attr( $this->get_field_name( 'tab_popular_title' ) ); ?>"
					       id="<?php echo esc_attr( $this->get_field_id( 'tab_popular_title' ) ); ?>"/>
					<br/> <b><label for="<?php echo esc_attr( $this->get_field_id( 'tab_popular_limit' ) ); ?>">

							<?php _e( 'Limit Posts Number', 'chfw-lang' ) ?></label></b> <br/>
					<input type="text" class="input-text"
					       value="<?php echo esc_attr( $tab_popular_limit ); ?>"
					       name="<?php echo esc_attr( $this->get_field_name( 'tab_popular_limit' ) ); ?>"
					       id="<?php echo esc_attr( $this->get_field_id( 'tab_popular_limit' ) ); ?>"/>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_popular_date_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_popular_date_show' ) ); ?>"
						       type="checkbox"
						       value="1" <?php checked( esc_attr( $tab_popular_date_show, 'on' ) ); ?> />
						<label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_popular_date_show' ) ); ?>">
							<?php _e( 'Display item date?', 'chfw-lang' ); ?></label>
					</p>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_popular_author_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_popular_author_show' ) ); ?>"
						       type="checkbox"
						       value="1" <?php checked( esc_attr( $tab_popular_author_show, 'on' ) ); ?> />
						<label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_popular_author_show' ) ); ?>">
							<?php _e( 'Display item author?', 'chfw-lang' ); ?></label>
					</p>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_popular_comments_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_popular_comments_show' ) ); ?>"
						       type="checkbox"
						       value="1" <?php checked( esc_attr( $tab_popular_comments_show, 'on' ) ); ?> />
						<label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_popular_comments_show' ) ); ?>">
							<?php _e( 'Display item comments?', 'chfw-lang' ); ?></label>
					</p>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_popular_picture_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_popular_picture_show' ) ); ?>"
						       type="checkbox"
						       value="1" <?php checked( esc_attr( $tab_popular_picture_show, 'on' ) ); ?> />
						<label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_popular_picture_show' ) ); ?>"><?php _e( 'Display item picture?', 'chfw-lang' ); ?></label>
					</p>
				</div>
				<!-- tab1 end post options end -->
				<div class="tab-content tab2">
					<b><label for="<?php echo esc_attr( $this->get_field_id( 'tab_recent_title' ) ); ?>">
							<?php _e( 'Title ', 'chfw-lang' ) ?></label></b> <br/>
					<input type="text" class="input-text"
					       value="<?php echo esc_attr( $tab_recent_title ); ?>"
					       name="<?php echo esc_attr( $this->get_field_name( 'tab_recent_title' ) ); ?>"
					       id="<?php echo esc_attr( $this->get_field_id( 'tab_recent_title' ) ); ?>"/>
					<br/> <b><label for="<?php echo esc_attr( $this->get_field_id( 'tab_recent_limit' ) ); ?>">

							<?php _e( 'Limit Posts Number ', 'chfw-lang' ) ?></label></b> <br/>

					<input type="text" class="input-text"
					       value="<?php echo esc_attr( $tab_recent_limit ); ?>"
					       name="<?php echo esc_attr( $this->get_field_name( 'tab_recent_limit' ) ); ?>"
					       id="<?php echo esc_attr( $this->get_field_id( 'tab_recent_limit' ) ); ?>"/>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_recent_date_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_recent_date_show' ) ); ?>"
						       type="checkbox"
						       value="1" <?php checked( esc_attr( $tab_recent_date_show, 'on' ) ); ?> />
						<label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_recent_date_show' ) ); ?>">
							<?php _e( 'Display item date?', 'chfw-lang' ); ?></label>
					</p>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_recent_author_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_recent_author_show' ) ); ?>"
						       type="checkbox"
						       value="1" <?php checked( esc_attr( $tab_recent_author_show, 'on' ) ); ?> />
						<label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_recent_author_show' ) ); ?>">
							<?php _e( 'Display item author?', 'chfw-lang' ); ?></label>
					</p>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_recent_comments_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_recent_comments_show' ) ); ?>"
						       type="checkbox"
						       value="1"
							<?php checked( esc_attr( $tab_recent_comments_show, 'on' ) ); ?> /> <label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_recent_comments_show' ) ); ?>">
							<?php _e( 'Display item comments?', 'chfw-lang' ); ?></label>
					</p>

					<p>
						<input id="<?php echo esc_attr( $this->get_field_id( 'tab_recent_picture_show' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_recent_picture_show' ) ); ?>"
						       type="checkbox"
						       value="1"
							<?php checked( esc_attr( $tab_recent_picture_show, 'on' ) ); ?> /> <label
							for="<?php echo esc_attr( $this->get_field_id( 'tab_recent_picture_show' ) ); ?>">
							<?php _e( 'Display item picture?', 'chfw-lang' ); ?></label>
					</p>
				</div>
				<!-- tab2 end recent end -->


				<div class="tab-content tab3 ">

					<p>
						<b><label for="<?php echo esc_attr( $this->get_field_id( 'tab_bgcolor' ) ); ?>">
								<?php _e( 'Tab Background Color ', 'chfw-lang' ) ?></label></b>
						<input data-default-color="#EEE" type="text" class="input-text ch-color-picker"
						       value="<?php echo esc_attr( $tab_bgcolor ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'tab_bgcolor' ) ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( 'tab_bgcolor' ) ); ?>"/>
					</p>

					<p>
						<b><label for="<?php echo esc_attr( $this->get_field_id( 'active_tab_bgcolor' ) ); ?>">
								<?php _e( 'Active Tab Background Color', 'chfw-lang' ) ?></label></b>
						<input data-default-color="#fff" type="text" class="input-text ch-color-picker"
						       value="<?php echo esc_attr( $active_tab_bgcolor ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'active_tab_bgcolor' ) ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( 'active_tab_bgcolor' ) ) ?>"/>
					</p>

					<p>
						<b><label for="<?php echo esc_attr( $this->get_field_id( 'inactive_tab_bgcolor' ) ); ?>">
								<?php _e( 'Inactive  Tab Background Color', 'chfw-lang' ) ?></label></b>
						<input data-default-color="#CFCFCF" type="text" class="input-text ch-color-picker"
						       value="<?php echo esc_attr( $inactive_tab_bgcolor ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'inactive_tab_bgcolor' ) ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( 'inactive_tab_bgcolor' ) ) ?>"/>
					</p>


					<p>
						<b><label for="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ); ?>">
								<?php _e( 'Tab Text Color', 'chfw-lang' ) ?></label></b>
						<input data-default-color="#000" type="text" class="input-text ch-color-picker"
						       value="<?php echo esc_attr( $text_color ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'text_color' ) ); ?>"
						       id="<?php echo esc_attr( $this->get_field_id( 'text_color' ) ) ?>"/>
					</p>

					<p>


						<input id="<?php echo esc_attr( $this->get_field_id( 'border_enable_disable' ) ); ?>"
						       name="<?php echo esc_attr( $this->get_field_name( 'border_enable_disable' ) ); ?>"
						       type="checkbox"
						       value="1" <?php checked( esc_attr( $border_enable_disable, 'on' ) ); ?> />

						<label
							for="<?php echo esc_attr( $this->get_field_id( 'border_enable_disable' ) ); ?>">
							<?php _e( 'Border Enable Disable', 'chfw-lang' ); ?></label>

					</p>


				</div>
			</div>
		</div>

		<script>
			jQuery('.lastPopPecentTabbing_<?php echo $this->id?> ul.tabs_st_studio-engine li').bind("click", function () {
				var tab_id = jQuery(this).attr('data-tab');
				jQuery('.lastPopPecentTabbing_<?php echo $this->id?> ul.tabs_st_studio-engine li').removeClass('current');
				jQuery('.lastPopPecentTabbing_<?php echo $this->id?> .tabcontainer .tab-content').removeClass('current');
				jQuery(this).addClass('current');
				jQuery(".lastPopPecentTabbing_<?php echo $this->id?> ." + tab_id).addClass('current');
			});
		</script>


		<?php
	}
}

