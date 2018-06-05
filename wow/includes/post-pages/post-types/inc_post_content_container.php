<?php
/**
 * The template for displaying content in the includes/post-pages/post-types/timeline_zigzag.php
 * # uses timeline , zigzag one zigzag two and vc post slider
 * timeline header info
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */
global $CHfw_rdx_options,$scFW_globals;
?>
<div class="post-content-container">
	<div class="center_container">
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
                   <?php comments_popup_link( __( 'Comments (0)' ,'chfw-lang' ), __( 'Comments (1)','chfw-lang' ), __( 'Comments (%)','chfw-lang'  ) ); ?>
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
				<?php if ( is_single() ) : ?>
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
					<?php
					#@post_slider_is_open  uses timeline , zigzag one zigzag two and vc post slider
					if ( $scFW_globals['post_slider_is_open'] ) : ?>
						<?php
						CHfw_the_ExcerptMaxCharLength($scFW_globals['post_excerpt_lenght']);
						?>
						<?php echo CHfw_content_more( true ); ?>
					<?php else : ?>
					<?php if ( $CHfw_rdx_options['blog_show_full_posts'] === '1' ) : ?>
						<div class="ch-post-content">
							<?php the_content(); ?>
						</div>
						<?php
						wp_link_pages( array(
								'before' 		=> '<div class="page-links"><span class="page-links-title">' . esc_html__( 'Pages:', 'chfw-lang' ) . '</span>',
								'after' 		=> '</div>',
								'link_before'	=> '<span>',
								'link_after'	=> '</span>'
						) );
						?>
						<?php else : ?>
						<?php
						the_excerpt(); ?>
						<?php
						echo  CHfw_content_more( true );?>
					<?php endif; ?>
				<?php endif; ?>
				<?php endif; ?>
			</div>
		</div>
	</div>
</div>