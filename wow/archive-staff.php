<?php

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
$blog_args = $page_setting_class->blog_args('staff');
$image_overlay_type = $page_setting_class->image_overlay_type();
$view_options = $page_setting_class->view_options('full');
$header_setting = $page_setting_class->header_type_selected($pid, $page_type_);
$post_border_class = $page_setting_class->PostBorderControl();


$scFW_staffView_layout = $CHfw_rdx_options['staff_main_layout'];


if (isset($_POST['ch_action']) && $_POST['ch_action'] == 'ch_ajax_blog_posts') {
    include "includes/hospital/hospitalFunc.php";
    if (isset($_GET['layout'])) {
        if ($_GET['layout'] == 'stack') {
            $scFW_staffView_layout = 'stack';
        } elseif ($_GET['layout'] == 'left') {
            $scFW_staffView_layout = 'left_align';
        } elseif ($_GET['layout'] == 'mini_list') {
            $scFW_staffView_layout = 'mini_list';
        }
    }

    $wp_query = new WP_Query($blog_args);
    if ($wp_query->have_posts()) {
        while ($wp_query->have_posts()) {
            $wp_query->the_post();
            get_post_format();
            unset($previousday);
            include("includes/hospital/staff-pages/" . $scFW_staffView_layout . ".php");
            ?>
            <div style="display: none" class="loadmore-link-outer"><?php next_posts_link(); ?></div>
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

echo '<script>var masonry_control=false;</script>';
?>
<?php if ($scFW_globals['is_archive_page_ref'] == true) {
    $page_setting_class->archive_page_header_info();
} elseif ($scFW_globals['is_search_page_ref'] == true) {
    $page_setting_class->search_page_header_info();
}

include("includes/hospital/hospitalFunc.php");
?>
    <main id="main-container" class="indexpage">
        <!--breadcrumb-container start-->
        <div class="breadcrumb-container h125">
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
                        <span itemprop="name">  <?php echo __("Doctors", 'chfw-lang') ?></span>
                                </a> <meta itemprop="position" content="2">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo row">
                        <div id="breadcrumb-Info_archive" class="col-sm-7">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName"><?php _e('Doctors', 'chfw-lang') ?></h1>
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
                    <div class="page-bloglist" id="bodyheader">
                        <?php
                        if (isset($_GET['layout'])) {
                            if ($_GET['layout'] == 'stack') {
                                $scFW_staffView_layout = 'stack';
                            } elseif ($_GET['layout'] == 'left') {
                                $scFW_staffView_layout = 'left_align';
                            } elseif ($_GET['layout'] == 'mini_list') {
                                $scFW_staffView_layout = 'mini_list';
                            }
                        }
                        ?>
                        <div id="doctor-archive-page" class="ajax-page-content boxed-content bloglist-page-top contentbar">
                            <section id="doctor-archive-page-<?php echo $scFW_staffView_layout ?>" style="margin-top: 15px" class="index-page bloglist-page blog <?php echo $post_border_class ?>">
                                <?php
                                if ($scFW_globals['is_archive_page_ref'] == true) {
                                    $page_setting_class->archive_query_list('other', $view_options);
                                } else {
                                    $wp_query = new WP_Query($blog_args);
                                    if ($wp_query->have_posts()) {
                                        while ($wp_query->have_posts()) {
                                            $wp_query->the_post();
                                            get_post_format();
                                            unset($previousday);
                                            include("includes/hospital/staff-pages/" . $scFW_staffView_layout . ".php");
                                            ?>
                                        <?php }
                                        wp_reset_postdata();
                                    } else {
                                        get_template_part('content', 'none');
                                    }
                                    wp_reset_query();
                                }
                                ?>
                            </section>
                        </div>
                        <div class="container">
                            <?php
                            get_template_part("includes/post-pages/blog_pagination");
                            ?>
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

