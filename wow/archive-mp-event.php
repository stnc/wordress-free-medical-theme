<?php

//slug  => depatmans
global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;

$page_type_ = 'archive_staff';

$scFW_globals['page_type_'] = $page_type_;
// check for page template
if (is_page_template('page-bloglist.php')) {
    $page_type_result = 'not_embed';
} else {
    $page_type_result = 'embed';
}

$scFW_globals['page_type_'] = $page_type_;
$scFW_globals['page_type_result'] = $page_type_result;

$pid = get_the_ID();
$page_setting_class->is_archive_page_ref = $scFW_globals['is_archive_page_ref'];
$page_setting_class->is_search_page_ref = $scFW_globals['is_search_page_ref'];
$page_setting_class->user_defined_page_type = $page_type_;
$page_setting_class->blog_list_view_layout = 'big-layout';//new
$page_setting_class->image_effect_type_for_post_page = 'overlay';
$page_setting_class->readmore_control = true;
$blog_args = $page_setting_class->blog_args();
$image_overlay_type = $page_setting_class->image_overlay_type();
$view_options = $page_setting_class->view_options('full');
$header_setting = $page_setting_class->header_type_selected($pid, $page_type_);
$post_border_class = $page_setting_class->PostBorderControl();
$blog_args = $page_setting_class->blog_args('mp-event');
$scFW_staffView_layout = $CHfw_rdx_options['staff_main_layout'];

if (isset($_POST['ch_action']) && $_POST['ch_action'] == 'ch_ajax_blog_posts') {
    $wp_query2 = new WP_Query($blog_args);
    if ($wp_query2->have_posts()) {
        while ($wp_query2->have_posts()) {
            $wp_query2->the_post();
            get_post_format();
            unset($previousday);

            get_template_part("includes/hospital/departments_archive-layout-pages/" . $CHfw_rdx_options["DepartmanPageLayoutSelect"]); ?>

            <div style="display: none" class="loadmore-link-outer">
                <?php next_posts_link(); ?>
            </div>
        <?php }
        wp_reset_postdata();
    } else {
        get_template_part('content', 'none');
    }
    wp_reset_query();
    die;
}
$header_setting = $page_setting_class->header_type_selected($pid, 'is_page_template');
get_header($header_setting['header_type']);

echo '<script>var masonry_control=true;</script>';
?>
<?php if ($scFW_globals['is_archive_page_ref'] == true) {
    $page_setting_class->archive_page_header_info();
} elseif ($scFW_globals['is_search_page_ref'] == true) {
    $page_setting_class->search_page_header_info();
}
$DepartmanProcess = new CHfw_DepartmanProcess();
$scFW_globals['archive-mp-event-arg'] = $DepartmanProcess->mpEventRootCategoryList_OnlyArg();
?>
    <main id="main-container" class="DepartmanPage">
        <!--breadcrumb-container start-->
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <nav class="breadCrumb">
                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                                        <span itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                                        <span  itemprop="name">  <?php echo __("Deparments", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo row">
                        <div id="breadcrumb-Info_archive" class="col-sm-7">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName">
                                    <i class="fa fa-hospital-o" aria-hidden="true"></i>
                                    <?php _e('Deparments', 'chfw-lang') ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb-container end-->
        <div class="container">
            <div class="row">
                <div>
                    <div class="page-bloglist" id="departmans">
                        <div class="ajax-page-content boxed-content clearfix bloglist-page-top contentbar <?php //echo $header_setting['center_class'] ?>">
                            <section id="doctor-archive-page" class="index-page bloglist-page blog <?php echo $post_border_class ?>">

                                    <?php if (isset($_GET['layout'])) : ?>
                                        <?php get_template_part("includes/hospital/departments_archive-layout-pages/" . $_GET['layout']); ?>
                                    <?php else: ?>
                                        <?php get_template_part("includes/hospital/departments_archive-layout-pages/" . $CHfw_rdx_options["DepartmanPageLayoutSelect"]); ?>
                                    <?php endif; ?>

                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main end  -->

<?php
$footer_setting = $page_setting_class->footer_type_selected($pid, $page_type_);
get_footer($footer_setting['footer_type']);