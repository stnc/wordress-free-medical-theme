<?php
/**
 * Display Popular Posts by Views in WordPress without
 * AUTHOR INFO
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 * Note :http://bit.ly/2pfMt8x
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}
$count_key= 'CHfw-PostViewsCount';
/* ---------------------------------------------------------------------------
 * set post views
 * --------------------------------------------------------------------------- */
function CHfw_engine_set_post_views( $postID ) {
	$count_key= 'CHfw-PostViewsCount';
	$count = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		$count = 0;
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );
	} else {
		$count ++;
		update_post_meta( $postID, $count_key, $count );
	}
}

//To keep the count accurate, lets get rid of prefetching
remove_action( 'wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0 );

/* ---------------------------------------------------------------------------
 * get post views
 * --------------------------------------------------------------------------- */
function CHfw_engine_track_post_views( $post_id ) {
	if ( ! is_single() ) {
		return;
	}
	if ( empty ( $post_id ) ) {
		global $post;
		$post_id = $post->ID;
	}
	CHfw_engine_set_post_views( $post_id );
}

add_action( 'wp_head', 'CHfw_engine_track_post_views' );

/* ---------------------------------------------------------------------------
 *get post views (frontend)
 * --------------------------------------------------------------------------- */
function CHfw_get_post_views( $postID ) {
	$count_key= 'CHfw-PostViewsCount';
	$count = get_post_meta( $postID, $count_key, true );
	if ( $count == '' ) {
		delete_post_meta( $postID, $count_key );
		add_post_meta( $postID, $count_key, '0' );

		return esc_html_e( '0 View', 'chfw-lang' );
	}

	return esc_html_e( 'Views ', 'chfw-lang' ).$count;
}


