<?php
global $page_setting_class, $CHfw_rdx_options;
$pid = get_the_ID();
$header_setting = $page_setting_class->header_type_selected($pid, 'is_page_template');
get_header($header_setting['header_type']);
$view_options = array(
    'article_layout_class' => 'col-md-12 col-xs-12 padding-none',
    'comments' => false,
    'enable_post_for_list' => false,
    'related_posts' => false,
    'tags' => true,
    'author_show' => true,
    'the_content' => true,
);
$image_overlay_type = isset($CHfw_rdx_options['image_overlay_type']) ? $CHfw_rdx_options['image_overlay_type'] : 'overlay-image_icon-bounce-in';
$_page_class__ = 'boxed-content';
$page_type_control = CHfw_get_meta($pid, 'wow_pageSetting_Top_margin_of_inner_page');
if (!is_array($page_type_control)) {
    $_page_class__ = $page_type_control;
}
$page_title_control = CHfw_get_meta($pid, 'wow_pageSetting_page_title_option');
$page_title__ = 'hide';
if (!is_array($page_title_control)) {
    $page_title__ = $page_title_control;
}
?>
    <!-- all main responsive -->
    <main id="main-container" class="page-php header <?php echo $header_setting['center_class'] ?>">
        <?php if (!is_front_page()): ?>
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
                                    <h1 class="breadcrumb-InfoName"><?php  the_title()?></h1>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--breadcrumb-container end-->
        <?php endif ?>
        <div id="page-customize">
            <div class="container">
                <div class="row">
                    <div id="right-bar" class="col-lg-12 col-md-12 col-xs-12">
                        <div id="bodyheader">
                            <div class="ajax-page-content entry-summary <?php echo $_page_class__ ?>">
                                <section id="page-page">
                                    <div class="post">
                                        <div class="body-post page">
                                            <?php if ($page_title__ == 'show'): ?>
                                                <header class="entry-header">
                                                    <h2 class="entry-title">
                                                        <?php the_title(); ?>
                                                    </h2>
                                                </header>
                                            <?php endif; ?>
                                            <div class="clearfix"></div>
                                            <div class="entry-summer">
                                                <?php if (have_posts()):
                                                    while (have_posts()) : the_post(); ?>
                                                        <div id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
                                                            <?php the_content(); ?>
                                                        </div>
                                                    <?php
                                                    endwhile;
                                                else :
                                                    ?>
                                                    <div>
                                                        <h2><?php esc_html_e('Sorry, nothing to display.', 'chfw-lang'); ?></h2>
                                                    </div>

                                                <?php endif; ?>
                                            </div>

                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <?php
                                    // If comments are open or we have at least one comment, get_template_part( "includes/post-pages/author_post" ); load up the comment template
                                    if (comments_open() || '0' != get_comments_number()) :
                                        echo '<div class="clearfix"></div>';
                                        CHfw_commentsSelection($view_options);
                                    endif; ?>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- main end  -->
<?php
$footer_setting = $page_setting_class->footer_type_selected($pid, 'page');
get_footer($footer_setting['footer_type']);

