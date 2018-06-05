<?php

/**
 * Page SETTING
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
global $CHfw_rdx_options;

class CHfw_page_setting_engine
{
    var $large_layout;
    var $layout_id_content;
    var $layout_id_sidebar;
    var $user_defined_page_type;
    var $CHfw_rdx_options;
    var $is_archive_page_ref;
    var $is_search_page_ref;
    var $image_effect_type_for_post_page;
    var $readmore_control;

    /*
     * uses
     * how to post= picture ? enable or disable
     * uses pages
     *'big-layout' -> default option
     *'small-layout'-> page-bloglist_small.php
     *'small-search-layout'-> search-ajax.php and search-standart.php
    * */
    var $blog_list_view_layout;


    /**
     *init
     *
     * @return mixed
     */
    public function __construct()
    {
        if ($this->user_defined_page_type == '') {
            $this->user_defined_page_type = 'default';
        }
        $this->blog_list_view_layout = 'default';


    }

    /**
     *Post BORDER CONTROL
     *
     * @return mixed
     */
    public function PostBorderControl()
    {
        $CHfw_rdx_options = $this->CHfw_rdx_options;
        global $CHfw_select_skin;
        $class = '';
        if (isset($CHfw_rdx_options['PostStyleListBorder_' . $CHfw_select_skin])) {
            if ($CHfw_rdx_options['PostStyleListBorder_' . $CHfw_select_skin]['border-style'] == 'none' and
                ($CHfw_rdx_options['PostStyleListBoxShadow_' . $CHfw_select_skin] == 0) and
                ($CHfw_rdx_options['PostStyleListBgColor_' . $CHfw_select_skin] == 'transparent')
            ) {
                $class = " post-box-zero";
            } else {
                $class = " post-boxed";
            }
        }

        return $class;
    }

    /**
     *page embed script / css
     *
     * @return mixed
     */
    public function EmbedScript($page_type_)
    {
        if ($page_type_ == 'location-page') {
            $CHfw_rdx_options = $this->CHfw_rdx_options;
            $apikey = esc_attr($CHfw_rdx_options['locationGmapApiKey']);
            wp_register_script('googlemaps', 'https://maps.googleapis.com/maps/api/js?key=' . $apikey, false, '3');
            wp_enqueue_script('googlemaps');

        }
    }

    /**
     *HEADER TYPE
     *
     * @return mixed
     */
    public function header_type_selected($id, $page_type = '')
    {
   //  $header_type_selected = esc_attr($CHfw_rdx_options['header_type_selected']);
        $CHfw_rdx_options = $this->CHfw_rdx_options;
        $header_type_selected_default = 'standart';

        if ($page_type == 'is_page_template') {
            $header_type_selected = CHfw_get_metaSingle($id, 'wow_pageSetting_header_type_selected');
        } else {
            $header_type_selected= esc_attr($CHfw_rdx_options['header_type_selected']);
        }

        if ($header_type_selected == "use_system_header" or $header_type_selected == " ") {
            $header_type_selected = $header_type_selected_default;
        }
        return array(
            'center_class' => $this->siteCenterControl(),
            'header_type' => $header_type_selected,
        );
    }


    /**
     *CENTER BOX
     * redux
     * -> Theme style setting
     * -->  Main page setting
     * ---> Center Box Setting
     *
     * @return mixed
     */
    public function siteCenterControl()
    {
        $CHfw_rdx_options = $this->CHfw_rdx_options;
        global $CHfw_select_skin;
        $header_class = '';
        if (isset($CHfw_rdx_options['SiteCenterBorder_' . $CHfw_select_skin])) {
            if ($CHfw_rdx_options['SiteCenterBorder_' . $CHfw_select_skin]['border-style'] == 'none' and
                ($CHfw_rdx_options['SiteCenterBoxShadowEnableDisable_' . $CHfw_select_skin] == 0) and
                ($CHfw_rdx_options['SiteCenter_BgColor_' . $CHfw_select_skin] == 'transparent')
            ) {
                $header_class = " center-box-zero";
            } else {
                $header_class = " center-boxed";
            }
        }

        return $header_class;
    }


    /**
     *FOOTER TYPE
     *
     * @return mixed
     */
    public function footer_type_selected($id, $page_type = '')
    {

        $CHfw_rdx_options = $this->CHfw_rdx_options;
        $footer_type_selected = '';
        if ($page_type == 'page') {
            $footer_type_selected = CHfw_get_meta($id, 'wow_pageSetting_footer_type_selected');
        } else {

            $footer_type_selected = esc_attr($CHfw_rdx_options['footer_type_selected']);

        }
        $footer_class = '';
        if ($footer_type_selected != '') {
            $footer_class = "flat";
        }

        return array(
            'footer_class' => $footer_class,
            'footer_type' => $footer_type_selected,
        );
    }


    /**
     *View Options (format format pages uses )
     *
     * @return mixed
     */
    public function view_options($type = 'full')
    {
        $CHfw_rdx_options = $this->CHfw_rdx_options;
        $article_layout_class = '';
        $image_size = 'large';
        $page_name = $this->user_defined_page_type;

        if ($this->user_defined_page_type == 'page-bloglist') {
            $image_size_default = "wow-BlogList_MediumLarge";
            $image_size = $CHfw_rdx_options['pages_list_type_blog_layouts'] == 'full' ? $image_size_default : 'wow-BlogList_MediumSmall_SidebarOpen';
        } elseif ($this->user_defined_page_type == 'page-bloglist_small' || $this->user_defined_page_type == 'page-masonry') {
            $image_size_default = "wow-masonry-BlogListSmall-Large";
            $image_size = $CHfw_rdx_options['pages_list_type_blog_layouts'] == 'full' ? $image_size_default : 'wow-AllSidebarOpen';
        }


        if ($this->user_defined_page_type == 'page-masonry') {
            $page_name = 'masonry-post ';//masonry.js @uses ==  assets/js/dev/wow_js.js  --  masonry_init() funciton
        }

        return array(
            'article_layout_class' => $this->page_columns() . $article_layout_class,
            'comments' => false,
            'enable_post_for_list' => false,
            'related_posts' => false,
            'tags' => true,
            'readmore_control' => $this->readmore_control,
            'author_show' => false,
            'add_html' => '',
            'page_name' => $page_name,
            'image_effect_type_page' => $this->image_effect_type_for_post_page,
            'blog_list_view_layout' => $this->blog_list_view_layout,
            'image_size' => $image_size,

        );
    }

    /**
     *page coluon
     *
     * @return mixed
     */
    public function page_columns()
    {
        $CHfw_rdx_options = $this->CHfw_rdx_options;
        $page_columns = '';
        if ($this->user_defined_page_type == "page-masonry") {
            if (isset($CHfw_rdx_options['masonry_page_columns'])) {
                if ($CHfw_rdx_options['masonry_page_columns'] == 'col2') {
                    $page_columns = ' with49';
                } elseif ($CHfw_rdx_options['masonry_page_columns'] == 'col3') {
                    $page_columns = ' with33';
                }
            }
        }


        return $page_columns;
    }


    /**
     *blog arg
     *
     * @return mixed
     */
    public function blog_args($post_type = 'post')
    {
        global $wp_query;
        if (get_query_var('paged')) {

            $paged = get_query_var('paged');
        } elseif (get_query_var('page')) {

            $paged = get_query_var('page');
        } else {

            $paged = 1;
        }

        $args = array(
            'post_type' => $post_type,
            'orderby' => $this->blog_order(),
            'paged' => $paged,
            'order' => 'DESC',
        );

        return $args;
    }

    /**
     *Blog ORDER
     *
     * @return mixed
     */
    public function blog_order()
    {
        $CHfw_rdx_options = $this->CHfw_rdx_options;

        $blog_order = isset($CHfw_rdx_options['blog_order']) ? esc_attr($CHfw_rdx_options['blog_order']) : 'date';

        return $blog_order;
    }

    /**
     *image overlay control
     *
     * @return mixed
     */
    public function image_overlay_type()
    {
        $CHfw_rdx_options = $this->CHfw_rdx_options;
        $image_overlay_type = isset($CHfw_rdx_options['image_overlay_type']) ? esc_attr($CHfw_rdx_options['image_overlay_type']) : 'overlay-image_icon-bounce-in';

        return $image_overlay_type;
    }

    /**
     *sidebar position
     *
     * @return mixed
     */
    public function sidebar_layout()
    {
        $CHfw_rdx_options = $this->CHfw_rdx_options;
        $main_page_sidebar_mobile_view = (isset($CHfw_rdx_options['main_page_sidebar_mobile_view']) and $CHfw_rdx_options['main_page_sidebar_mobile_view'] == 1) ? ' hidden-xs ' : '';
        $main_page_sidebar_tablet_view = (isset($CHfw_rdx_options['main_page_sidebar_tablet_view']) and $CHfw_rdx_options['main_page_sidebar_tablet_view'] == 1) ? ' hidden-sm ' : '';
        $visible_class = $main_page_sidebar_mobile_view . $main_page_sidebar_tablet_view;

        $header_class = $this->siteCenterControl();
        if (isset($_GET['bar_type']) && $_GET['bar_type'] == 'left') {
            $CHfw_rdx_options['archive_page_blog_layout'] = 'left';
            $CHfw_rdx_options['search_blog_layout'] = 'left';
            $CHfw_rdx_options['main_blog_layout'] = 'left';
            $CHfw_rdx_options['pages_list_type_blog_layouts'] = 'left';
        } elseif (isset($_GET['bar_type']) && $_GET['bar_type'] == 'right') {
            $CHfw_rdx_options['archive_page_blog_layout'] = 'right';
            $CHfw_rdx_options['search_blog_layout'] = 'right';
            $CHfw_rdx_options['main_blog_layout'] = 'right';
            $CHfw_rdx_options['pages_list_type_blog_layouts'] = 'right';
        } elseif (isset($_GET['bar_type']) && $_GET['bar_type'] == 'full') {
            $CHfw_rdx_options['archive_page_blog_layout'] = 'full';
            $CHfw_rdx_options['search_blog_layout'] = 'full';
            $CHfw_rdx_options['main_blog_layout'] = 'full';
            $CHfw_rdx_options['pages_list_type_blog_layouts'] = 'full';
        }

        if (is_archive()) {
            if (!isset($CHfw_rdx_options['archive_page_blog_layout'])) {
                $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open' . $visible_class;
                $this->layout_id_content = 'right-bar';
                ?>
                <div id="left-bar"
                     class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?>">
                    <?php get_sidebar(); ?>
                </div>
            <?php }

            if (isset($CHfw_rdx_options['archive_page_blog_layout'])) {

                if ($CHfw_rdx_options['archive_page_blog_layout'] == 'full') {
                    $this->large_layout = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 full-pageSidebarClose' . $header_class;
                    $this->layout_id_content = 'left-bar';
                } elseif ($CHfw_rdx_options['archive_page_blog_layout'] == 'right') {
                    $this->large_layout = 'col-lg-9 col-md-9  col-xs-12 sidebar-open';
                    $this->layout_id_sidebar = 'left-bar';
                    $this->layout_id_content = 'right-bar';

                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?> ">
                        <?php get_sidebar(); ?>
                    </div>

                    <?php
                } elseif ($CHfw_rdx_options['archive_page_blog_layout'] == 'left') {
                    $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                    $this->layout_id_sidebar = 'right-bar';
                    $this->layout_id_content = 'left-bar';
                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class=" col-lg-3 col-md-3  col-xs-12 <?php echo $visible_class ?> ">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php
                }
            }
        } elseif (is_search()) {
            if (!isset($CHfw_rdx_options['search_blog_layout'])) {
                $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                $this->layout_id_content = 'right-bar';

                ?>
                <div id="left-bar" class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?>">
                    <?php get_sidebar(); ?>
                </div>
            <?php }
            if (isset($CHfw_rdx_options['search_blog_layout'])) {
                if ($CHfw_rdx_options['search_blog_layout'] == 'full') {
                    $this->large_layout = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 full-pageSidebarClose' . $header_class;
                    $this->layout_id_content = 'left-bar';
                } elseif ($CHfw_rdx_options['search_blog_layout'] == 'right') {
                    $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                    $this->layout_id_sidebar = 'left-bar';
                    $this->layout_id_content = 'right-bar';
                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?> ">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php
                } elseif ($CHfw_rdx_options['search_blog_layout'] == 'left') {
                    $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                    $this->layout_id_sidebar = 'right-bar';
                    $this->layout_id_content = 'left-bar';
                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class=" col-lg-3 col-md-3  col-xs-12 <?php echo $visible_class ?>">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php
                }
            }
        } elseif (is_front_page()) {
            if (!isset($CHfw_rdx_options['main_blog_layout'])) {
                $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                $this->layout_id_content = 'right-bar';

                ?>
                <div id="left-bar"
                     class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?>">
                    <?php get_sidebar(); ?>
                </div>
            <?php }
            if (isset($CHfw_rdx_options['main_blog_layout'])) {
                if ($CHfw_rdx_options['main_blog_layout'] == 'full') {
                    $this->large_layout = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 full-pageSidebarClose ' . $header_class;
                    $this->layout_id_content = 'left-bar';
                } elseif ($CHfw_rdx_options['main_blog_layout'] == 'right') {
                    $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                    $this->layout_id_sidebar = 'right-bar';
                    $this->layout_id_content = 'left-bar';

                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?>">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php
                } elseif ($CHfw_rdx_options['main_blog_layout'] == 'left') {
                    $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';

                    $this->layout_id_sidebar = 'left-bar';
                    $this->layout_id_content = 'right-bar';

                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class=" col-lg-3 col-md-3  col-xs-12 <?php echo $visible_class ?> ">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php
                }
            }
        } elseif (is_page(array(
            'blog-list',
            'timeline',
            'masonry-page',
            'zigzag-page',
            'zigzag-page-two',
            'blog-small-list'
        ))) {
            if (!isset($CHfw_rdx_options['pages_list_type_blog_layouts'])) {
                $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                $this->layout_id_content = 'right-bar';
                ?>
                <div id="left-bar"
                     class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?> ">
                    <?php get_sidebar(); ?>
                </div>
            <?php }
            if (isset($CHfw_rdx_options['pages_list_type_blog_layouts'])) {
                if ($CHfw_rdx_options['pages_list_type_blog_layouts'] == 'full') {
                    $this->large_layout = 'col-lg-12 col-md-12 col-sm-12 col-xs-12 full-pageSidebarClose' . $header_class;
                    $this->layout_id_content = 'left-bar';
                } elseif ($CHfw_rdx_options['pages_list_type_blog_layouts'] == 'right') {
                    $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                    $this->layout_id_sidebar = 'left-bar';
                    $this->layout_id_content = 'right-bar';

                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?> ">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php
                } elseif ($CHfw_rdx_options['pages_list_type_blog_layouts'] == 'left') {
                    $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
                    $this->layout_id_sidebar = 'right-bar';
                    $this->layout_id_content = 'left-bar';

                    ?>
                    <div id="<?php echo $this->layout_id_sidebar ?>"
                         class=" col-lg-3 col-md-3  col-xs-12 <?php echo $visible_class ?> ">
                        <?php get_sidebar(); ?>
                    </div>
                    <?php
                }
            }
        } else {
            $this->large_layout = 'col-lg-9 col-md-9 col-xs-12 sidebar-open';
            $this->layout_id_content = 'right-bar';

            ?>
            <div id="left-bar"
                 class="col-lg-3 col-md-3 col-xs-12 <?php echo $visible_class ?>">
                <?php get_sidebar(); ?>
            </div>
            <?php

        }

    }

    /**
     *admin page setting header
     *
     * @return mixed
     */
    public function archive_page_header_info()
    {
        if (is_author()) {
            $author = get_userdata(get_query_var('author'));
            $query_name = esc_html__('All posts by', 'chfw-lang') . ' ' . $author->display_name;
            ?>
            <div class="text-center col-md-2">
                <div class="avatar">
                    <?php echo get_avatar(get_the_author_meta('ID'), '54'); ?>
                </div>
            </div>
            <h1 class="archive-title col-md-6"><?php _e('All posts by', 'chfw-lang');
                echo ' ';
                echo get_the_author_meta('display_name'); ?></h1>

            <div class="author-description col-md-6"><?php echo get_the_author_meta('description'); ?></div>
        <?php } elseif (is_day()) { ?>
            <h1 class="archive-title"><?php _e('Archives', 'chfw-lang') . CHfw_echof() . get_the_date(); ?></h1>
            <div class="author-description"><?php category_description(); ?></div>
        <?php } elseif (is_month()) { ?>
            <h1 class="archive-title"><?php _e('Archives', 'chfw-lang') . CHfw_echof() . single_month_title(' '); ?></h1>
            <div class="author-description"><?php category_description(); ?></div>
        <?php } elseif (is_year()) { ?>
            <h1 class="archive-title"><?php _e('Archives', 'chfw-lang') . CHfw_echof() . get_the_date(_x('Y', '', 'chfw-lang')); ?></h1>
            <div class="author-description"><?php category_description(); ?></div>
        <?php } elseif (is_category()) { ?>
            <h1 class="archive-title"><?php _e('Category Archives', 'chfw-lang') . CHfw_echof() . single_cat_title(); ?></h1>
            <div class="author-description"><?php category_description(); ?></div>
        <?php } elseif (is_tag()) { ?>
            <h1 class="archive-title"><?php _e('Tag Archives', 'chfw-lang') . CHfw_echof() . single_tag_title(); ?></h1>
            <div class="author-description"><?php category_description(); ?></div>
        <?php }

    }

    /**
     *search header text
     *
     * @return mixed
     */
    public function search_page_header_info()
    {
        global $CHfw_rdx_options;
        ?>
        <div class="top-heading-title">
            <div class="container">
                <header class="archive-header">
                    <div class="row">
                        <div class="col-sm-12">
                            <h1 class="archive-title">
                                <?php
                                if (isset($CHfw_rdx_options['search_title']) && $CHfw_rdx_options['search_title'] != '') :
                                    echo str_replace('$', $_GET['s'], esc_attr($CHfw_rdx_options['search_title']));
                                else :
                                    echo _e('Search Results For : ', 'chfw-lang') . ' ' . urldecode($_GET['s']);
                                endif;
                                ?>
                            </h1>
                        </div>
                    </div>
                </header>
            </div>
        </div>
        <?php
    }

    /**
     *archive page ajax query and response
     * @return mixed
     */
    public function archive_query_list($group, $view_options)
    {

        global $scFW_globals, $CHfw_rdx_options;
        if ($group == 'zigzag_timeline') {
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $scFW_globals['format_typeCH'] = get_post_format();
                    unset($previousday);
                    get_template_part("includes/post-pages/post-types/timeline_zigzag");
                }
                wp_reset_postdata();
            } else {
                get_template_part('content', 'none');
            }
            wp_reset_query();
            get_template_part("includes/post-pages/timeline_pagination");
        } else {
            if (have_posts()) {
                while (have_posts()) {
                    the_post();
                    $format_typeCH = get_post_format();
                    unset($previousday);
                    CHfw_get_post_formetter($format_typeCH, $view_options, $CHfw_rdx_options);
                }
                wp_reset_postdata();
            } else {
                get_template_part('content', 'none');
            }
            wp_reset_query();
        }
    }


    /**
     *  site layout config
     * stretched,boxed,boxed-attached
     *
     * @uses page.php
     * @return array
     */

    public function siteBodyLayoutSetting()
    {
        global $CHfw_rdx_options, $CHfw_select_skin;

        if (isset ($_GET['layout_style']) && in_array($_GET['layout_style'], array(
                "stretched",
                "boxed",
                "boxedat"
            ))
        ) {
            $layout_style_value = $_GET['layout_style'];
            if ($layout_style_value == "stretched") {
                $layout_style_value = "stretched";
            } elseif ($layout_style_value == "boxed") {
                $layout_style_value = "boxed";
            } elseif ($layout_style_value == "boxedat") {
                $layout_style_value = "boxed-attached";
            }

        } else {
            $v = isset($CHfw_rdx_options['siteBodyLayoutSetting_' . $CHfw_select_skin]) ? esc_attr($CHfw_rdx_options['siteBodyLayoutSetting_' . $CHfw_select_skin]) : 'stretched';
            $layout_style_value = $v;
        }
        $new_layout_style_value_stretch = '';
        if ($layout_style_value == 'boxed') {
            $new_layout_style_value = 'boxed';
        } elseif ($layout_style_value == 'boxed-attached') {
            $new_layout_style_value = 'boxed-attack';
        } /*stretched*/
        else {
            $new_layout_style_value = '';
        }

        return $new_layout_style_value;
    }
}


$page_setting_class = new CHfw_page_setting_engine();
$page_setting_class->CHfw_rdx_options = $CHfw_rdx_options;

/*-----------uses includes/post-pages/post-types/timeline_zigzag.php--------------- */
function CHfw_timeline_place_holder_box($imagewow, $scFW_globals)
{
    if ($scFW_globals['page_name'] == "page-zigzagTwo") {
        if ($imagewow == '') {
            $imagewow = get_template_directory_uri() . '/assets/images/placeholder/zigzag2placeholder.jpg';;
        } else {
            $imagewow = $imagewow;
        }
    } else {
        $imagewow = $imagewow;
    }

    return $imagewow;
}
