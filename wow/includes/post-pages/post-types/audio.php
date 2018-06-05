<?php
/**
 * The template for displaying content in the single.php and blog pages
 * AUDIO FORMAT
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

$ch_image_size = $view_options['image_size'];
$figure_image_show_visible = true;
$readmore_control = $view_options['readmore_control'];
$entry_post_small_layout_container_width = 'width100';
$entry_post_small_layout_container = '';
$page_name = $view_options['page_name'];//for masonry post ref or not masonry
// if big layout (fullview)  -----------------------
if ($view_options['blog_list_view_layout'] == 'big-layout') {
    $body_post_none_shadow = '';
    $body_post_none_bradius = '';
    $blog_list_view_layout = $view_options['blog_list_view_layout'];
    $figure_image_class = 'image';
    $figure_image_show_visible = true;
    $entry_post_big_layout_container = 'entry-post-big-layout-container';
// if small layout -----------------------
} elseif ($view_options['blog_list_view_layout'] == 'small-layout') {
    $body_post_none_shadow = '';
    $body_post_none_bradius = 'body-post-none_bradius';
    $blog_list_view_layout = $view_options['blog_list_view_layout'];
    $ch_image_size = 'thumbnail';
    $figure_image_class = 'image-small';
    $figure_image_show_visible = false;
    $entry_post_small_layout_container = 'entry-post-small-layout-container';
}
// picture size -----------------------
$ch_image_size = $view_options['image_size'];
$imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $ch_image_size);
$imagewow = $imagewow[0];

// this is special for this page -----------------------
$entry_post_small_layout_container_width = '';
if ($imagewow == "") {
    $entry_post_small_layout_container_width = 'width100';
} else {
    $entry_post_small_layout_container_width = 'bloglist_right';
}
//$figure_image_show_visible               = true;//--all overrride


// post classes -----------------------
$classes = array();
$classes[] = 'post';
$classes[] = 'ch-audio-post';
$classes[] = $view_options['article_layout_class'];
$classes[] = $page_name;

?>


<article id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
    <div class="body-post <?php echo $body_post_none_shadow . ' ' . $body_post_none_bradius ?>">

        <?php if ($figure_image_show_visible) :
            ?>
            <figure class="image">
                <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_audioPosterImage') != '') : ?>
                    <a href="<?php the_permalink() ?>">
                        <img src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_audioPosterImage') ?>"
                             alt="<?php echo the_title(); ?>" class="img-responsive border-radius-none">
                    </a>
                <?php endif; ?>
                <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') != "") :
                    ?>
                    <audio class="site-audio" preload="none" style="width: 100%; visibility: hidden;" controls="controls">
                        <source type="audio/mpeg" src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?>"/>
                        <a href="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?>">
                            <?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?></a>
                    </audio>
                <?php endif; ?>
            </figure>

        <?php endif; ?>

        <?php if ($imagewow != "") : ?>
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
                                    <?php the_content(); ?>
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

                </div>

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
                                <?php get_template_part("includes/post-pages/social_links"); ?>
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


