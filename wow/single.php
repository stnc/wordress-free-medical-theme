<?php
/*post */
global $page_setting_class;
$pid = get_the_ID();
$header_setting = $page_setting_class->header_type_selected($pid, 'single_post');
get_header($header_setting['header_type']);
$post_border_class = $page_setting_class->PostBorderControl();
$postpages_sidebar_mobile_view = (isset($CHfw_rdx_options['postpages_sidebar_mobile_view']) and $CHfw_rdx_options['postpages_sidebar_mobile_view'] == 1) ? ' hidden-xs ' : '';
$postpages_sidebar_tablet_view = (isset($CHfw_rdx_options['postpages_sidebar_tablet_view']) and $CHfw_rdx_options['postpages_sidebar_tablet_view'] == 1) ? ' hidden-sm ' : '';
$visible_class = $postpages_sidebar_mobile_view . $postpages_sidebar_tablet_view;
$image_bigsize_default = "wow-BlogList_MediumLarge";
$image_smallSize_default = "wow-BlogList_MediumSmall_SidebarOpen";//"timeline-zigzag1-zigzag2-Large"; 'wow-AllSidebarOpen'; ---alternatives
$image_size = $CHfw_rdx_options['single_blog_layout'] == 'full' ? $image_bigsize_default : $image_smallSize_default;

$single_view_options = array(
    'article_layout_class' => '',
    'comments' => true,
    'enable_post_for_list' => true,//main skeleton = if list or single page
    'related_posts' => true,
    'tags' => true,
    'author_show' => true,
    'readmore_control' => false,
    'add_html' => '',
    'image_effect_type_page' => 'zoom',
    'page_name' => 'single-page ',
    'blog_list_view_layout' => 'big-layout',
    'image_size' => $image_size,

);
$scFW_globals['single_view_options'] = $single_view_options;
$entry_post_small_layout_container = 'entry-post-small-layout-container';
?>
    <main id="main-container" class="single-page">
        <!--breadcrumb-container start-->
        <div class="breadcrumb-container h150">
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
                                    <span itemprop="name"> <?php the_title() ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo row">
                        <div id="breadcrumb-Info_archive" class="col-sm-7">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName"><?php the_title() ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb-container end-->

        <div id="page-customize">
            <div class="container">
                <div class="row">
                    <?php

                    if (isset($_GET['bar_type']) && $_GET['bar_type'] == 'left') {
                        $CHfw_rdx_options['single_blog_layout'] = 'left';
                    } elseif (isset($_GET['bar_type']) && $_GET['bar_type'] == 'right') {
                        $CHfw_rdx_options['single_blog_layout'] = 'right';
                    } elseif (isset($_GET['bar_type']) && $_GET['bar_type'] == 'full') {
                        $CHfw_rdx_options['single_blog_layout'] = 'full';
                    }
                    ?>
                    <?php
                    if (!isset($CHfw_rdx_options['single_blog_layout'])) :
                        $large_layout = 'col-lg-9 col-md-9  col-xs-12 sidebar-open';
                        $layout_id_content = 'right-bar';
                        ?>
                        <div id="left-bar"
                             class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?>">
                            <?php get_sidebar(); ?>
                        </div>
                    <?php endif; ?>
                    <!-- left-bar end  -->
                    <?php
                    if (isset($CHfw_rdx_options['single_blog_layout'])) :
                        if ($CHfw_rdx_options['single_blog_layout'] == 'full') :
                            $large_layout = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 full-pageSidebarClose';
                            $layout_id_content = 'left-bar';
                        elseif ($CHfw_rdx_options['single_blog_layout'] == 'right'):
                            $large_layout = 'col-lg-9 col-md-9  col-xs-12 sidebar-open';
                            $layout_id_sidebar = 'left-bar';
                            $layout_id_content = 'right-bar';

                            ?>
                            <div id="<?php echo $layout_id_sidebar ?>"
                                 class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?>">
                                <?php get_sidebar(); ?>
                            </div>     <!-- left-bar end  -->

                        <?php
                        elseif ($CHfw_rdx_options['single_blog_layout'] == 'left'):
                            $large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                            $layout_id_sidebar = 'right-bar';
                            $layout_id_content = 'left-bar';
                            ?>
                            <div id="<?php echo $layout_id_sidebar ?>"
                                 class=" col-lg-3 col-md-3 col-sm-12 col-xs-12 <?php echo $visible_class ?>">
                                <?php get_sidebar(); ?>
                            </div>     <!-- left-bar end  -->

                        <?php endif; ?>
                    <?php endif; ?>
                    <div id="<?php echo $layout_id_content ?>" class="<?php echo $large_layout ?>">
                        <div id="bodyheader">
                            <div class="ajax-page-content boxed-content clearfix contentbar <?php echo $header_setting['center_class'] ?>">
                                <section id="single-page" class="blog page-single <?php echo $post_border_class ?>">
                                    <?php if (have_posts()) : ?>
                                        <?php while (have_posts()) : the_post();
                                            $format_typeBull = get_post_format();
                                            unset($previousday);
                                            CHfw_get_post_formetter($format_typeBull, $single_view_options, $CHfw_rdx_options);
                                            ?>
                                            <div class="post-info-container">
                                                <div class="post-info-container-collabs">
                                                    <?php
                                                    get_template_part("includes/post-pages/author_post");
                                                    ?>
                                                </div>
                                            </div>

                                            <div class="post-info-container">
                                                <div class="post-info-container-collabs">
                                                    <div class="navigation clearfix">
                                                        <span class="nav-previous pull-left"><?php previous_post_link('&laquo; %link'); ?></span>
                                                        <span class="nav-next pull-right"><?php next_post_link(' %link &raquo;'); ?></span>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="post-info-container">
                                                <div class="post-info-container-collabs">
                                                    <?php
                                                    if ($CHfw_rdx_options['related_post_type'] == 'pictures') {
                                                        get_template_part("includes/post-pages/related_posts_picture");
                                                    } else {
                                                        get_template_part("includes/post-pages/related_posts_list");
                                                    }
                                                    ?>
                                                </div>
                                            </div>
                                            <?php
                                            // If comments are open or we have at least one comment, load up the comment template.
                                            if (comments_open() || get_comments_number()) : ?>
                                                <div class="post-info-container">
                                                    <div class="post-info-container-collabs">
                                                        <?php
                                                        CHfw_commentsSelection($single_view_options);
                                                        ?>
                                                    </div>
                                                </div>
                                            <?php endif; ?>
                                        <?php endwhile; ?>
                                    <?php else : ?>
                                        <?php get_template_part('content', 'none'); ?>
                                    <?php endif; ?>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- container end --->
        </div>
    </main>
    <!-- main end  -->
<?php
$footer_setting = $page_setting_class->footer_type_selected($pid, 'single_post');
$footer_setting['footer_type'];
get_footer($footer_setting['footer_type']);

