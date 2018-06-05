<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
/**
 * Widget Flickr Photos Feed Widget
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 * note flickr id 43355249@N00
 */
class CHfw_Flickr_Widget extends WP_Widget {

	public $code;

	public $handle;

	public $limit;

	public $id;

	public $flickr_rand;

	/* ---------------------------------------------------------------------------
	 * init
	 * --------------------------------------------------------------------------- */
	public function __construct() {
		$widget_ops = array(
			'classname'   => 'flickr-widget',
			'description' => esc_html__( "Latest Flickr Photos", 'chfw-lang' )
		);
		parent::__construct( 'Flickr_widget', esc_html__( 'CH Flickr', 'chfw-lang' ), $widget_ops );
	}

	/* ---------------------------------------------------------------------------
* Deals with the settings when they are saved by the admin.
* --------------------------------------------------------------------------- */
	function update( $new_instance, $old_instance ) {
		$instance                   = $old_instance;
		$instance['widget_title']   = strip_tags( $new_instance['widget_title'] );
		$instance['flickr_limit']   = strip_tags( $new_instance['flickr_limit'] );
		$instance['flickr_id']      = strip_tags( $new_instance['flickr_id'] );
		$instance['flickr_display'] = strip_tags( $new_instance['flickr_display'] );

		return $instance;
	}

	/* ---------------------------------------------------------------------------
	 * Outputs the HTML for this widget.
	 * --------------------------------------------------------------------------- */
	public function widget( $args, $instance ) {
		extract( $args );
		$title          = apply_filters( 'widget_title', empty( $instance['title'] ) ? __( 'Flickr Widget', 'chfw-lang' ) : $instance['title'], $instance, $this->id_base );
		$flickr_limit   = isset( $instance['flickr_limit'] ) ? $instance['flickr_limit'] : 6;
		$flickr_id      = isset( $instance['flickr_id'] ) ? $instance['flickr_id'] : '';
		$flickr_display = isset( $instance['flickr_display'] ) ? $instance['flickr_display'] : 'list';

		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		?>
		<!-- flickr -->
		<div class="flickr-wrapper">
			<?php if ( $flickr_display == 'list' ) { ?>
				<div class="flickr-list">
					<ul id="flickr<?php echo $this->id ?>" class="flickr_images clearfix"></ul>
				</div>
				<script type="text/javascript">
					jQuery(document).ready(function ($) {
						var count = parseInt(<?php echo $flickr_limit?>, 15);
						$.getJSON("//api.flickr.com/services/feeds/photos_public.gne?ids=<?php echo $flickr_id?>&lang=en-us&format=json&jsoncallback=?",
							function (data) {
								$.each(data.items, function (index, item) {
									$("<img class='flickr'/>").attr("src", item.media.m).appendTo('.flickr-list #flickr<?php echo $this->id?>').wrap("<li><a href='" + item.link + "' class='flickr-img-link' target='_blank'></a></li>");
									return index + 1 < count;
								});
							});
					});
				</script>
			<?php } ?>
			<?php if ( $flickr_display == 'slider' ) { ?>
				<div class="flickr-slider">
					<ul id="flickr<?php echo $this->id ?>" class="list-unstyled post-slider">
						<?php for ( $i = 1; $i < $flickr_limit; $i ++ ) {
							echo '<li></li>';
						} ?>
					</ul>
				</div>
				<script>
					hidde_media = [];
					jQuery(document).ready(function ($) {
						var count = parseInt(<?php echo $instance['flickr_limit']?>, 15);
						$.getJSON("//api.flickr.com/services/feeds/photos_public.gne?ids=<?php echo $instance['flickr_id']?>&lang=en-us&format=json&jsoncallback=?")
							.done(function (data) {
								$.each(data.items, function (index, item) {
									hidde_media.push(item.media.m);
									return index + 1 < count;
								});
							});
					});

					//setTimeout(function(){
					jQuery(window).load(function () {
						jQuery('.flickr-slider #flickr<?php echo $this->id?> li').each(function (index1, value1) {
							jQuery(this).html('<img alt="filcker image" class="flickr" src="' + hidde_media[index1] + '">');
						});

						jQuery('.flickr-slider ul').slick({
							infinite: true,
							speed: 500,
							fade: true,
							cssEase: 'linear'
						});

					});
					//}, 1500);
				</script>
			<?php } ?>
		</div>
		<?php echo $after_widget;
	}

	/* ---------------------------------------------------------------------------
	 * Deals with the settings when they are saved by the admin.
	 * --------------------------------------------------------------------------- */
	public function form( $instance ) {


		$flickr_display = isset( $instance['flickr_display'] ) ? $instance['flickr_display'] : 'slider';

		$title        = isset( $instance['title'] ) ? $instance['title'] : __( 'Title', 'chfw-lang' );
		$flickr_limit = isset( $instance['flickr_limit'] ) ? $instance['flickr_limit'] : 6;
		$flickr_id    = isset( $instance['flickr_id'] ) ? $instance['flickr_id'] : '43355249@N00';
		?>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"><?php _e( 'Title', 'chfw-lang' ) ?></label>
			<input type="text" class="input-text" value="<?php echo esc_attr( $title ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'flickr_id' )); ?>"><?php _e( 'Flickr ID', 'chfw-lang' ) ?></label>
			<input type="text" class="input-text" value="<?php echo esc_attr( $flickr_id ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'flickr_id' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'flickr_id' ) ); ?>"/>
		</p>
		<p>
			<label
				for="<?php echo esc_attr( $this->get_field_id( 'flickr_limit' ) ); ?>">
				<?php _e( 'Photos Limit', 'chfw-lang' ) ?></label>
			<input type="text" class="input-text" value="<?php echo esc_attr( $flickr_limit ); ?>"
			       name="<?php echo esc_attr( $this->get_field_name( 'flickr_limit' ) ); ?>"
			       id="<?php echo esc_attr( $this->get_field_id( 'flickr_limit' ) ); ?>"/>
		</p>
		<label
			for="<?php echo esc_attr( $this->get_field_id( 'flickr_display' ) ); ?>"><?php _e( 'How would you like to display?', 'chfw-lang' ); ?></label>
		<select id="<?php echo esc_attr( $this->get_field_id( 'flickr_display' ) ); ?>"
		        name="<?php echo esc_attr( $this->get_field_name( 'flickr_display' ) ); ?>">
			<?php
			$de = array( 'Slider' => 'slider', 'List' => 'list' );
			foreach ( $de as $key => $row ) {
				echo "<option value='$row' " . selected( $flickr_display, $row, false ) . ">$key</option>";
			}

			?>
		</select>

		<?php
	}
}


