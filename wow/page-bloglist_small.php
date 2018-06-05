<?php
/*
 * Template Name: Blog Small List
 * Description: Blog List Small page
* @package wow
 */
global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;

/**
 * @uses includes/post-pages/blog_pagination.php
and includes/CHfw_page_setting_engine.php
and global variable == $scFW_globals
 *
 */
$page_type_ = 'page-bloglist_small';


//https://wpseek.com/function/is_page_template/
// check for page template
if ( is_page_template( 'page-bloglist_small.php' ) ) {
	$page_type_result = 'not_embed'; //pagination tip
}
else {
	$page_type_result = 'embed';
}

$scFW_globals['page_type_']       = $page_type_;
$scFW_globals['page_type_result'] = $page_type_result;
$page_setting_class->is_archive_page_ref= $scFW_globals['is_archive_page_ref'] ;
$page_setting_class->is_search_page_ref= $scFW_globals['is_search_page_ref'] ;
$page_setting_class->user_defined_page_type = $page_type_;
$page_setting_class->blog_list_view_layout  = 'small-layout';
$page_setting_class->image_effect_type_for_post_page='overlay';
$page_setting_class->readmore_control=true;
$blog_args                                  = $page_setting_class->blog_args();
$image_overlay_type                         = $page_setting_class->image_overlay_type();
$view_options                               = $page_setting_class->view_options( 'full' );
$pid                                        = get_the_ID();
$header_setting                             = $page_setting_class->header_type_selected( $pid, $page_type_ );
$post_border_class                          = $page_setting_class->PostBorderControl();
if ( isset( $_POST['ch_action'] ) && $_POST['ch_action'] == 'ch_ajax_blog_posts' ) {
	$wp_query = new WP_Query( $blog_args );
	if ( $wp_query->have_posts() ) {
		while ( $wp_query->have_posts() ) {
			$wp_query->the_post();
			$format_typeCH = get_post_format();
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
$header_setting                       = $page_setting_class->header_type_selected( $pid, 'is_page_template' );
get_header( $header_setting['header_type'] );
echo '<script>var masonry_control=false;</script>';
?>
<?php if ( $scFW_globals['is_archive_page_ref'] == true ) {
	$page_setting_class->archive_page_header_info();
} elseif( $scFW_globals['is_search_page_ref'] == true ) {
	$page_setting_class->search_page_header_info();
}
?>
<main id="main-container" class="indexpage">
    <!--breadcrumb-container start-->
    <div class="breadcrumb-container h150">
        <div class="container">
            <div class="row">
                <nav class="breadCrumb">
                    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li>
                            <a itemprop="item" href="/">
                                <span  itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                            </a>
                            <meta itemprop="position" content="1">
                        </li>
                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="#">
                                <span itemprop="name"> <?php  the_title()?></span>
                            </a>
                            <meta itemprop="position" content="2">
                        </li>
                    </ol>
                </nav>
                <div class="breadcrumb-topInfo row">
                    <div id="breadcrumb-Info_archive" class="col-sm-7">
                        <div class="breadcrumb-Sum">
                            <?php if ($scFW_globals['is_archive_page_ref'] == true) {
                                $page_setting_class->archive_page_header_info();
                            } elseif ($scFW_globals['is_search_page_ref'] == true) {
                                $page_setting_class->search_page_header_info();
                            } else { ?>
                                <h1 class="breadcrumb-InfoName">
                                    <?php the_title()?>
                                </h1>
                                <?php
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumb-container end-->
	<div class="container">
		<div class="row">
			<?php $page_setting_class->sidebar_layout(); ?>
			<div id="<?php echo $page_setting_class->layout_id_content ?>"
			     class="<?php echo $page_setting_class->large_layout ?>">
				<div class="page-bloglist-small" id="bodyheader">
					<div class="ajax-page-content boxed-content clearfix contentbar <?php echo $header_setting['center_class'] ?>">
						<section  class="list-blog-wrapper bloglist-small-page blog <?php echo $post_border_class ?>">
							<?php
							if ( $scFW_globals['is_archive_page_ref'] == true ) {
								$page_setting_class->archive_query_list( 'other', $view_options );
							} else {
								$wp_query = new WP_Query( $blog_args );
								if ( $wp_query->have_posts() ) {
									while ( $wp_query->have_posts() ) {
										$wp_query->the_post();
										$format_typeCH = get_post_format();
										unset( $previousday );
										CHfw_get_post_formetter( $format_typeCH, $view_options, $CHfw_rdx_options );
									}
									wp_reset_postdata();
								} else {
									get_template_part( 'content', 'none' );
								}
							}
							?>
						</section>
					</div>
					<?php get_template_part( "includes/post-pages/blog_pagination" ); ?>
				</div>
			</div>
		</div>
	</div>
</main>
<!-- main end  -->
<?php
$footer_setting = $page_setting_class->footer_type_selected( $pid, $page_type_ );
get_footer( $footer_setting['footer_type'] );

