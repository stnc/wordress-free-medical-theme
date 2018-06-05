<?php
/**
 *Archive page setting , diffrent skins and blog view options
 * AJAX CONTROL
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $CHfw_rdx_options, $wp_query, $page_setting_class, $scFW_globals;
$scFW_globals['is_archive_page_ref'] = true;
$page_type_                          = $scFW_globals['page_type_'];


// for ajax control  -------------------------------------------------------
if ( isset( $_POST['ch_action'] ) && $_POST['ch_action'] == 'ch_ajax_blog_posts' ) {
	if ( $CHfw_rdx_options['archive_view_style'] == 'masonry' ) {
		$page_type_                                 = 'masonry';
		$page_type_result                           = 'embed';
		$scFW_globals['page_type_']                 = $page_type_;
		$scFW_globals['page_type_result']           = $page_type_result;
		$blog_args                                  = $page_setting_class->blog_args();
		$image_overlay_type                         = $page_setting_class->image_overlay_type();
		$page_setting_class->blog_list_view_layout  = 'big-layout';
		$view_options                               = $page_setting_class->view_options( 'less', 'masonry-post ' );
		$pid                                        = get_the_ID();
		$page_setting_class->user_defined_page_type = $page_type_;
		$header_setting                             = $page_setting_class->header_type_selected( $pid, 'page-masonry' );
		$post_border_class                          = $page_setting_class->PostBorderControl();
		$scFW_globals['image_effect_type']          = 'zoom';
	} elseif ( $CHfw_rdx_options['archive_view_style'] == 'list' ) {
		$page_type_result                           = 'embed';
		$scFW_globals['page_type_']                 = $page_type_;
		$scFW_globals['page_type_result']           = $page_type_result;
		$pid                                        = get_the_ID();

		$blog_args                                  = $page_setting_class->blog_args();
		$image_overlay_type                         = $page_setting_class->image_overlay_type();
		$page_setting_class->blog_list_view_layout  = 'big-layout';//new
		$view_options                               = $page_setting_class->view_options( 'full' );
		$page_setting_class->user_defined_page_type = $page_type_;
		$header_setting                             = $page_setting_class->header_type_selected( $pid, 'page-bloglist' );
		$post_border_class                          = $page_setting_class->PostBorderControl();
		$scFW_globals['image_effect_type']          = 'zoom';
	} elseif ( $CHfw_rdx_options['archive_view_style'] == 'list_small' ) {
		$page_type_result                           = 'embed';
		$scFW_globals['page_type_']                 = $page_type_;
		$scFW_globals['page_type_result']           = $page_type_result;
		$blog_args                                  = $page_setting_class->blog_args();
		$image_overlay_type                         = $page_setting_class->image_overlay_type();
		$page_setting_class->blog_list_view_layout  = 'small-layout';
		$view_options                               = $page_setting_class->view_options( 'full', 'bloglist_small.php' );
		$page_setting_class->user_defined_page_type = $page_type_;
		$pid                                        = get_the_ID();
		$header_setting                             = $page_setting_class->header_type_selected( $pid, 'page-bloglist_small' );
		$post_border_class                          = $page_setting_class->PostBorderControl();
		$scFW_globals['image_effect_type']          = 'zoom';
	} elseif ( $CHfw_rdx_options['archive_view_style'] == 'timeline' ) {
		$blog_args                            = $page_setting_class->blog_args();
		$image_overlay_type                   = $page_setting_class->image_overlay_type();
		$view_options                         = $page_setting_class->view_options();
		$pid                                  = get_the_ID();
		$header_setting                       = $page_setting_class->header_type_selected( $pid, 'page-timeline' );
		$post_border_class                    = $page_setting_class->PostBorderControl();
		$scFW_globals['zigzag_page']          = false;//for css and zigzag
		$scFW_globals['image_overlay_type']   = $image_overlay_type;
		$scFW_globals['image_effect_type']    = 'zoom';
	} elseif ( $CHfw_rdx_options['archive_view_style'] == 'zigzag' ) {
		$blog_args                            = $page_setting_class->blog_args();
		$image_overlay_type                   = $page_setting_class->image_overlay_type();
		$pid                                  = get_the_ID();
		$header_setting                       = $page_setting_class->header_type_selected( $pid, 'page-zigzag' );
		$post_border_class                    = $page_setting_class->PostBorderControl();
		$scFW_globals['image_overlay_type']   = $image_overlay_type;
		$scFW_globals['zigzag_page']          = true;
		$scFW_globals['image_effect_type']    = 'zoom';
	}
	//  ajax control  -------------------------------------------------------
	if ( $CHfw_rdx_options['archive_view_style'] == 'timeline' || $CHfw_rdx_options['archive_view_style'] == 'zigzag' ) {
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$scFW_globals['format_typeCH'] = get_post_format();
				unset( $previousday );
				get_template_part( "includes/post-pages/post-types/timeline_zigzag" );
				?>
				<div style="display: none" class="loadmore-link-outer"><?php next_posts_link(); ?></div>
			<?php }
			wp_reset_postdata();
		} else {
			get_template_part( 'content', 'none' );
		}
		die;
		die;
	} else {
		if ( have_posts() ) {
			while ( have_posts() ) {
				the_post();
				$scFW_globals['format_typeCH'] = get_post_format();
				$format_typeCH                 = get_post_format();
				unset( $previousday );
				CHfw_get_post_formetter( $format_typeCH, $view_options, $CHfw_rdx_options );
				?>
				<div style="display: none" class="loadmore-link-outer"><?php next_posts_link(); ?></div>
			<?php }
			wp_reset_postdata();
		} else {
			get_template_part( 'content', 'none' );
		}
		die;
	}
}