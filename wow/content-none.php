<?php
/**
 * The template part for displaying a message that posts cannot be found
* @package WordPress
 *@subpackage wow
 *@since wow 2.5
 */
?>

<section class="no-results not-found">
	<header class="page-header">
		<h1 class="page-title"><?php _e( 'Nothing Found', 'chfw-lang' ); ?></h1>
	</header><!-- .page-header -->

	<div class="page-content">

		<?php if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>

			<p><?php printf( esc_html__( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'chfw-lang' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>

		<?php elseif ( is_search() ) : ?>

			<p><?php _e( 'Sorry, but nothing matched your search terms. Please try again with some different keywords.', 'chfw-lang' ); ?></p>


		<?php else : ?>

			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'chfw-lang' ); ?></p>


		<?php endif; ?>

	</div><!-- .page-content -->
</section><!-- .no-results -->
