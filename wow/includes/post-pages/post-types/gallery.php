<?php
/**
 * The template for displaying content in the single.php and blog pages
 * Gallery FORMAT
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

$ch_image_size = $view_options['image_size'];
$figure_image_show_visible = true;
$imagewow = 'gallery';
$entry_post_small_layout_container_width = 'width100';
$entry_post_small_layout_container = '';
$page_name = $view_options['page_name'];//for masonry post ref or not masonry
$readmore_control = $view_options['readmore_control'];
// if big layout (fullview)  -----------------------
if ($view_options['blog_list_view_layout'] == 'big-layout') {
    $body_post_none_shadow = '';
    $body_post_none_bradius = '';
    $blog_list_view_layout = $view_options['blog_list_view_layout'];
    $figure_image_class = 'image';
    $entry_post_big_layout_container = 'entry-post-big-layout-container';
    $entry_post_small_layout_container = 'entry-post-small-layout-container';
    // if small layout -----------------------
} elseif ($view_options['blog_list_view_layout'] == 'small-layout') {
    $body_post_none_shadow = '';
    $body_post_none_bradius = 'body-post-none_bradius';
    $blog_list_view_layout = $view_options['blog_list_view_layout'];
    //$ch_image_size                           = 'thumbnail';
    $figure_image_class = 'image-small';
    $entry_post_small_layout_container = 'entry-post-small-layout-container';
    $entry_post_small_layout_container_width = 'bloglist_right';
}

$ch_image_size = $view_options['image_size'];
$imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $ch_image_size);
$imagewow = $imagewow[0];
//this is special for this page

$figure_image_show = false;
if (CHfw_get_meta(get_the_ID(), 'wow_post-format-gallery_media') != '') {
    $figure_image_show = false;
    //die ("gallery true");

} elseif ($imagewow != "" && CHfw_get_meta(get_the_ID(), 'wow_post-format-gallery_media') == '') {
    $figure_image_show = true;
    //die ("picture true");
} else {
    //die ("picture and gallery false");
    $figure_image_show = false;
    $entry_post_small_layout_container_width = 'width100';
}

// post classes -----------------------
$classes = array();
$classes[] = 'post';
$classes[] = 'ch-gallery-post';
$classes[] = $view_options['article_layout_class'];
$classes[] = $page_name;

?>
    <article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
        <div class="body-post <?php echo $body_post_none_shadow . ' ' . $body_post_none_bradius ?>">
            <?php if ($figure_image_show_visible) : ?>
                <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-gallery_media') != '') : ?>
                    <figure class="image <?php echo $figure_image_class ?>">
                        <?php
                        $imagesBUll_ = trim(CHfw_get_meta(get_the_ID(), 'wow_post-format-gallery_media'));
                        if (!empty($imagesBUll_)) {
                            $imagesBUlls = explode(',', $imagesBUll_);
                            $imagesBUlls = array_unique($imagesBUlls);

                            foreach ($imagesBUlls as $key => $val) {
                                if ($val == '') {
                                    unset($imagesBUlls[$key]);
                                }
                            }
                        }
                        $rnd = rand(100, 1500);
                        $slider_id = 'gallery-slider' . get_the_ID() . '_' . $rnd;
                        ?>

                        <div class="gallery-container" id="<?php echo $slider_id ?>">
                            <ul class="ul-gallery">
                                <?php
                                if (!empty($imagesBUlls)) :
                                    foreach ($imagesBUlls as $imagesBUll) :
                                        $imagewow = wp_get_attachment_image_src(($imagesBUll), 'wow-BlogList_MediumSmall_SidebarOpen');
                                        $imagewow = $imagewow[0];
                                        ?>
                                        <li>
                                            <img src="<?php echo $imagewow ?>" data-lazy="<?php echo $imagewow ?>" class="attachment-gallery-box-item img-responsive" alt="<?php echo the_title(); ?>">
                                        </li>
                                    <?php endforeach; ?>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </figure>
                <?php endif; ?>
            <?php endif; ?>
            <?php if ($figure_image_show) : ?>
                <figure class="<?php echo $figure_image_class ?>">
                    <a href="<?php the_permalink() ?>">
                        <img class="img-responsive img-<?php echo $view_options['image_effect_type_page'] ?>"
                             src="<?php echo $imagewow; ?>"
                             alt="<?php echo the_title(); ?>">
                        <?php //http://bit.ly/2jXyH7j
                        if ($view_options['image_effect_type_page'] == 'overlay') : ?>
                            <div class="overlay overlay-effect">
                                <div class="middle">
                                    <i class="text-fa fa fa-picture-o" aria-hidden="true"></i>
                                </div>
                            </div>
                        <?php endif; ?>
                    </a>
                </figure>
            <?php endif; ?>
            <div class="<?php echo $entry_post_small_layout_container . ' ' . $entry_post_small_layout_container_width ?>">
                <div class="entry-post-head-container">
                    <header class="entry-header">
                        <h2 class="entry-title">
                            <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                        </h2>
                    </header>
                    <div class="entry-byline">

                       <span class="date-span"><i class="fa fa-calendar-o"></i>
                           <?php the_time('F jS, Y') ?>
                           <time><?php the_time('Y-m-d H:i:s') ?></time>
                       </span>

                        <span class="comments-span">
                         <i class="fa fa-lg fa-comments"></i>
                            <?php comments_popup_link(__('Comments (0)', 'chfw-lang'), __('Comments (1)', 'chfw-lang'), __('Comments (%)', 'chfw-lang')); ?>
                       </span>

                        <span class="comments-span">
                         <i class="fa fa-lg fa-tags" aria-hidden="true"></i><?php the_category(',') ?>
                       </span>

                        <span class="comments-span">
                        <i class="fa fa-lg fa-eye"></i> <?php echo CHfw_get_post_views(get_the_ID()); ?>
                       </span>
                    </div>

                    <div class="clearfix"></div>
                    <div class="entry-summary">
                        <div class="the-content">
                            <?php if (is_single()) : ?>
                                <?php the_content(); ?>
                                <div class="ch-post-content">
                                    <?php
                                    wp_link_pages(array(
                                        'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'chfw-lang') . '</span>',
                                        'after' => '</div>',
                                        'link_before' => '<span>',
                                        'link_after' => '</span>'
                                    ));
                                    ?>
                                </div>
                            <?php else : ?>
                                <?php if ($CHfw_rdx_options['blog_show_full_posts'] === '1') : ?>
                                    <div class="ch-post-content">
                                        <?php
                                        global $more;
                                        $more = 0;
                                        the_content(); ?>
                                    </div>
                                    <?php
                                    wp_link_pages(array(
                                        'before' => '<div class="page-links"><span class="page-links-title">' . esc_html__('Pages:', 'chfw-lang') . '</span>',
                                        'after' => '</div>',
                                        'link_before' => '<span>',
                                        'link_after' => '</span>'
                                    ));
                                    ?>
                                <?php else : ?>
                                    <?php the_excerpt(); ?>
                                    <?php echo CHfw_content_more($readmore_control); ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                        <div class="clearfix"></div>
                    </div><!--entry-summary -->
                </div> <!--entry-post-head-container end -->
                <?php if ($view_options['blog_list_view_layout'] != 'small-search-layout') : ?>
                    <div class="post-meta entry-meta">
                        <?php
                        $ch_with = '';
                        if ($view_options['enable_post_for_list']) :
                            if (isset($CHfw_rdx_options['enable_list_facebook_like']) && $CHfw_rdx_options['enable_list_facebook_like']) :
                                if (!$CHfw_rdx_options['enable_list_socialShare']) {
                                    $ch_with = 'style="width: 100%;"';
                                } ?>
                                <div class="meta-like" <?php echo $ch_with; ?>>
                                    <?php echo CHfw_facebook_frame(); ?>
                                </div>

                            <?php endif; ?>
                            <?php if (isset($CHfw_rdx_options['enable_list_socialShare']) && $CHfw_rdx_options['enable_list_socialShare']) :
                            if (!$CHfw_rdx_options['enable_list_facebook_like']) {
                                $ch_with = 'style="width: 100%;"';
                            } ?>
                            <div class="os_social-foot-w" <?php echo $ch_with; ?>>
                                <ul class="post_social">
                                    <?php
                                    get_template_part("includes/post-pages/social_links");
                                    ?>
                                </ul>
                            </div>
                        <?php endif; ?>
                        <?php endif; ?>
                    </div>
                    <!--entry-meta end -->
                <?php endif; ?>
            </div>
        </div>
    </article>

<?php if (!empty($imagesBUlls)) : ?>
    <?php
    if (isset($_POST['ch_action']) && $_POST['ch_action'] == 'ch_ajax_blog_posts') :
        ?>
        <script type="text/javascript">
            <?php   echo "slick_slider_gallery_init('#" . $slider_id . "  .ul-gallery', true);" ?>
        </script>
    <?php else: ?>
        <?php add_action('wp_footer', function ()
        use ($slider_id) {
            ?>
            <script type="text/javascript">
                <?php   echo "slick_slider_gallery_init('#" . $slider_id . "  .ul-gallery', true);" ?>
            </script>
        <?php }, 20);
        ?>
    <?php endif; ?>
<?php endif; ?>