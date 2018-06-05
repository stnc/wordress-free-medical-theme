<?php
/*
 * Template Name: Timeline
 * Description: time page demeo
* @package WordPress
 *@subpackage wow
 *@since wow 1.5
 */

global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class, $wp_query;
/**
 * @uses includes/post-pages/blog_pagination.php
 * and includes/CHfw_page_setting_engine.php
 * and global variable == $scFW_globals
 *
 */
$page_name_ = 'page-timeline';

$page_setting_class->is_archive_page_ref = $scFW_globals['is_archive_page_ref'];
$page_setting_class->is_search_page_ref = $scFW_globals['is_search_page_ref'];
$page_setting_class->user_defined_page_type = $page_name_;
$page_setting_class->readmore_control = true;
$blog_args = $page_setting_class->blog_args();
$image_overlay_type = $page_setting_class->image_overlay_type();
$pid = get_the_ID();
$header_setting = $page_setting_class->header_type_selected($pid, 'page-timeline');
$post_border_class = $page_setting_class->PostBorderControl();
$view_options = $page_setting_class->view_options();
$scFW_globals['zigzag_page'] = false;//for css and zigzag
$scFW_globals['image_overlay_type'] = $image_overlay_type;
$scFW_globals['image_effect_type'] = 'none';
$scFW_globals['page_name'] = $page_name_;
$scFW_globals['post_slider_is_open'] = false;# uses timeline , zigzag one zigzag two and vc post slider
$scFW_globals['view_options'] = $view_options;

if (isset($_POST['ch_action']) && $_POST['ch_action'] == 'ch_ajax_blog_posts') {
    $wp_query = new WP_Query($blog_args);
    if ($wp_query->have_posts()) {
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            $scFW_globals['format_typeCH'] = get_post_format();
            unset($previousday);
            get_template_part("includes/post-pages/post-types/timeline_zigzag");
            ?>
            <div style="display: none" class="loadmore-link-outer"><?php next_posts_link(); ?></div>
        <?php }
        wp_reset_postdata();
    } else {
        get_template_part('content', 'none');
    }
    die;
}

$header_setting = $page_setting_class->header_type_selected($pid, 'is_page_template');
get_header($header_setting['header_type']);
if ($scFW_globals['is_archive_page_ref'] == true) {
    $page_setting_class->archive_page_header_info();
} elseif ($scFW_globals['is_search_page_ref'] == true) {
    $page_setting_class->search_page_header_info();
}
?>
    <main id="main-container" class="page-timeline ">
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
        <div id="page-customize" class="container">
            <div class="row">
                <script>var masonry_control = false;</script>
                <?php $page_setting_class->sidebar_layout(); ?>
                <div id="<?php echo $page_setting_class->layout_id_content ?>"
                     class="<?php echo $page_setting_class->large_layout ?>">
                    <div id="bodyheader" class="page-timeline">
                        <div id="timeline-page"
                             class="ajax-page-content timeline-page boxed-content contentbar <?php echo $header_setting['center_class'] ?>">
                            <section id="sc_fw-timeline" class="list-blog-wrapper timeline-container blog <?php echo $post_border_class ?>">
                                <?php
                                if ($scFW_globals['is_archive_page_ref'] == true) {
                                    $page_setting_class->archive_query_list('zigzag_timeline', $view_options);
                                } else {
                                    $wp_query = new WP_Query($blog_args);
                                    if ($wp_query->have_posts()) {
                                        while ($wp_query->have_posts()) {
                                            $wp_query->the_post();
                                            $scFW_globals['format_typeCH'] = get_post_format();
                                            unset($previousday);
                                            get_template_part("includes/post-pages/post-types/timeline_zigzag");
                                        }
                                        wp_reset_postdata();
                                    } else { ?>
                                        <p><?php _e('Sorry, no posts matched your criteria.', 'chfw-lang'); ?></p>
                                    <?php } ?>
                                    <?php get_template_part("includes/post-pages/timeline_pagination");
                                } ?>
                            </section>
                        </div>
                    </div>
                </div>
            </div>    <!-- row end  -->
        </div>    <!-- container end  -->
    </main>  <!-- main end  -->
<?php
$footer_setting = $page_setting_class->footer_type_selected($pid, 'page-timeline');
get_footer($footer_setting['footer_type']);


