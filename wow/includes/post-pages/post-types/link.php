<?php
/**
 * The template for displaying content in the single.php and blog pages
 * Link FORMAT
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

$figure_image_show_visible               = true;
$ch_image_size                           = $view_options['image_size'];
$entry_post_small_layout_container_width = 'width100';
$entry_post_small_layout_container       = '';
$page_name                               = $view_options['page_name'];//for masonry post ref or not masonry
$readmore_control=$view_options['readmore_control'];
// if big layout (fullview)  -----------------------
if ( $view_options['blog_list_view_layout'] == 'big-layout' ) {
	$body_post_none_shadow             = '';
	$body_post_none_bradius            = '';
	$blog_list_view_layout             = $view_options['blog_list_view_layout'];
	$figure_image_class                = 'image';
	$figure_image_show_visible         = true;
	$entry_post_small_layout_container = '';
	$entry_post_big_layout_container   = 'entry-post-big-layout-container';
	// if small layout -----------------------
} elseif ( $view_options['blog_list_view_layout'] == 'small-layout' ) {
	$body_post_none_shadow             = '';
	$body_post_none_bradius            = 'body-post-none_bradius';
	$blog_list_view_layout             = $view_options['blog_list_view_layout'];
	$ch_image_size                     = 'thumbnail';
	$figure_image_class                = 'image-small';
	$figure_image_show_visible         = true;//default false
	$entry_post_small_layout_container = 'entry-post-small-layout-container';
}
// post classes -----------------------
$classes   = array();
$classes[] = 'post';
$classes[] = 'ch-link-post';
$classes[] = $view_options['article_layout_class'];
$classes[] = $page_name;
?>

<article id="post-<?php the_ID(); ?>" <?php post_class( $classes ); ?>>
	<div class="body-post <?php echo $body_post_none_shadow . ' ' . $body_post_none_bradius ?>">
		<?php if ( $figure_image_show_visible ) : ?>
			<?php if ( CHfw_get_meta( get_the_ID(), 'wow_post-format-link_link' ) != '' ) : ?>
				<div class=slinks>
					<div class="slink">
						<a class=""
						   href="<?php echo CHfw_get_meta( get_the_ID(), 'wow_post-format-link_link' ); ?>"><?php echo CHfw_get_meta( get_the_ID(), 'wow_post-format-link_link' ); ?></a>
					</div>

				</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="<?php echo $entry_post_small_layout_container . ' ' . $entry_post_small_layout_container_width ?>">
			<div class="entry-post-head-container">
				<header class="entry-header">
					<h2 class="entry-title">
						<a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
					</h2>
				</header>
				<div class="entry-byline">
				   <span class="date-span"><i class="fa fa-calendar-o"></i>
					   <?php the_time( 'F jS, Y' ) ?>
					   <time><?php the_time( 'Y-m-d H:i:s' ) ?></time>
				   </span>
				   <span class="comments-span">
				   <i class="fa fa-lg fa-comments"></i>
					   <?php comments_popup_link( __( 'Comments (0)', 'chfw-lang' ), __( 'Comments (1)', 'chfw-lang' ), __( 'Comments (%)', 'chfw-lang' ) ); ?>
				   </span>
				   <span class="comments-span">
				   <i class="fa fa-lg fa-tags" aria-hidden="true"></i><?php the_category( ',' ) ?>
				   </span>
				   <span class="comments-span">
				   <i class="fa fa-lg fa-eye"></i> <?php echo CHfw_get_post_views( get_the_ID() ); ?>
				   </span>
				</div>
				<div class="clearfix"></div>
				<div class="entry-summary">
					<div class="the-content">
						<?php
                        if ( is_single() ) : ?>
							<?php the_content(); ?>
							<div class="ch-post-content">
								<?php
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'chfw-lang' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>'
								) );
								?>
							</div>
						<?php else : ?>
							<?php if ( $CHfw_rdx_options['blog_show_full_posts'] == '1' ) : ?>
								<div class="ch-post-content">
									<?php the_content(); ?>
								</div>
								<?php
								wp_link_pages( array(
									'before'      => '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'chfw-lang' ) . '</span>',
									'after'       => '</div>',
									'link_before' => '<span>',
									'link_after'  => '</span>'
								) );
								?>
							<?php else : ?>
								<?php the_excerpt(); ?>
								<?php echo CHfw_content_more( $readmore_control ); ?>
							<?php endif; ?>
						<?php endif; ?>
					</div>
					<div class="post-tags">
						<?php
						if ( $view_options['tags'] ) :
							if ( has_tag() ) : ?>
								<!-- tags -->
								<div class="tagcloud">
									<?php
									$tags = get_the_tags( get_the_ID() );
									foreach ( $tags as $tag ) {
										echo '<a href="' . get_tag_link( $tag->term_id ) . '">' . $tag->name . '</a> ';
									} ?>
								</div>
								<!-- end tags -->
							<?php endif; ?>
						<?php endif; ?>
					</div> <!--post-tags and-->
				</div>
			</div> <!--entry-post-head-container end -->
		</div>
		<?php if ( $view_options['blog_list_view_layout'] != 'small-search-layout' ) : ?>
			<div class="post-meta entry-meta">
				<?php
				$ch_with = '';
				if ( $view_options['enable_post_for_list'] ) :
					if ( isset( $CHfw_rdx_options['enable_list_facebook_like'] ) && $CHfw_rdx_options['enable_list_facebook_like'] ) :
						if ( ! $CHfw_rdx_options['enable_list_socialShare'] ) {
							$ch_with = 'style="width: 100%;"';
						} ?>
						<div class="meta-like" <?php echo $ch_with; ?>>
							<?php echo CHfw_facebook_frame(); ?>
						</div>
					<?php endif; ?>
					<?php if ( isset( $CHfw_rdx_options['enable_list_socialShare'] ) && $CHfw_rdx_options['enable_list_socialShare'] ) :
					if ( ! $CHfw_rdx_options['enable_list_facebook_like'] ) {
						$ch_with = 'style="width: 100%;"';
					} ?>
					<div class="os_social-foot-w" <?php echo $ch_with; ?>>
						<ul class="post_social">
							<?php get_template_part( "includes/post-pages/social_links" ); ?>
						</ul>
					</div>
				<?php endif; ?>
				<?php endif; ?>
			</div>
			<!--entry-meta end -->
		<?php endif; ?>
	</div>
</article>