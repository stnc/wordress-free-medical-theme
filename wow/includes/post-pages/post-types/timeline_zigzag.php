<?php
/**
 * The template for displaying content in the single.php and page-zigzagOne , page-timeline.php ,page-zigzagTwo
 * TIMELINE VIEW
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */
global $scFW_globals, $CHfw_rdx_options;
// layout options -----------------------
$image_size = $CHfw_rdx_options['pages_list_type_blog_layouts'] == 'full' ? 'wow-Timeline_zigzag1_zigzag2_Large' : 'wow-AllSidebarOpen';
$zigzag_page = $scFW_globals['zigzag_page'];
$entry_post_small_layout_container = 'entry-post-small-layout-container';
$entry_post_small_layout_container_width = 'width100';
$format_typeCH = $scFW_globals['format_typeCH'];
$image_overlay_type = $scFW_globals['image_overlay_type'] . ' post-media-container';
$view_options = $scFW_globals['view_options'];

// post classes -----------------------
$classes = array();
$classes[] = 'post';
$classes[] = 'sc_fw-timeline-block';

switch ($format_typeCH) {
    case 'link':
        $classes[] = 'ch-link';
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-link">
                <i class="fa fa-link" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">
                <div class="post-media-container">
                    <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-link_link') != '') : ?>
                        <div class=slinks>
                            <div class="slink">
                                <a class=""
                                   href="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-link_link'); ?>"><?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-link_link'); ?></a>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
                <?php
                get_template_part("includes/post-pages/post-types/inc_post_content_container");
                if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date"><span><?php the_time('F jS, Y') ?></span></div>
                    </div>
                <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->
        <?php

        break;
    case 'video':
        $classes[] = 'ch-video';
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-video">
                <i class="fa fa-video-camera" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">
                <div class="post-media-container">
                    <figure class="video-image">
                        <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoEmbed') == '' && CHfw_get_meta(get_the_ID(), 'wow_post-format-video_mp4FileUrl') != '') : ?>
                            <div class="embed-responsive embed-responsive-16by9">
                                <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
                                <video controls="controls"
                                       poster="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoPosterImage'); ?>"
                                       class="embed-responsive-item">
                                    <source
                                            src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_mp4FileUrl'); ?>"
                                            type="video/mp4">
                                    Your browser does not support the video tag.;
                                    <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
                                    <object type="application/x-shockwave-flash"
                                            data="<?php echo esc_url(get_stylesheet_directory_uri()) ?>/assets/mediaelement/flashmediaelement.swf">
                                        <param name="movie"
                                               value="<?php echo esc_url(get_stylesheet_directory_uri()) ?>/assets/mediaelement/flashmediaelement.swf"/>
                                        <param name="flashvars"
                                               value="controls=true&file=mediaelement/<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_mp4FileUrl'); ?>"/>
                                        <!-- Image as a last resort -->
                                        <img alt="<?php echo get_the_title(); ?>"
                                             src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoPosterImage'); ?>"
                                             title="No video playback capabilities"/>
                                    </object>
                                </video>
                            </div>
                        <?php endif; ?>
                        <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoEmbed') != '' && CHfw_get_meta(get_the_ID(), 'wow_post-format-video_mp4FileUrl') == '') : ?>
                            <div class="embed-responsive embed-responsive-16by9">
                                <?php
                                echo wp_oembed_get(CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoEmbed'));
                                ?>
                            </div>
                        <?php endif; ?>

                    </figure>
                </div>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container");
                if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date"><span><?php the_time('F jS, Y') ?></span></div>
                    </div>
                <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->
        <?php
        break;
    case 'image':
        $classes[] = 'ch-image';
        //buraya flag atılacak   eğer sidebar blog var ise ==  blog_list_small_sidebarOpen_post
        $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_size);
        $imagewow = CHfw_timeline_place_holder_box($imagewow[0], $scFW_globals);

        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-image">
                <i class="fa fa-camera" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">
                <?php if ($imagewow != "") : ?>
                    <div class="<?php echo $image_overlay_type ?>">
                        <div class="body-post">
                            <figure class="image">
                                <img class="img-responsive img-<?php echo $scFW_globals['image_effect_type'] ?>"
                                     src="<?php echo $imagewow; ?>"
                                     alt="<?php echo the_title(); ?>">
                                <?php if ($scFW_globals['image_effect_type'] == 'overlay') : ?>
                                    <div class="overlay overlay-effect">
                                        <div class="middle">
                                            <i class="text-fa fa fa-picture-o" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </figure>
                        </div>
                    </div>
                <?php endif; ?>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container");
                if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date"><span><?php the_time('F jS, Y') ?></span></div>
                    </div>
                <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->

        <?php

        break;

    case 'audio':
        $classes[] = 'ch-audio';
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-audio">
                <i class="fa fa-music" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">
                <div class="post-media-container">
                    <figure class="image">
                        <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_audioPosterImage') != '') : ?>
                            <img
                                    src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_audioPosterImage') ?>"
                                    alt="<?php echo the_title(); ?>"
                                    class="img-responsive border-radius-none">
                        <?php endif; ?>
                        <audio class="site-audio" preload="none"
                               style="width: 100%; visibility: hidden;"
                               controls="controls">
                            <source type="audio/mpeg"
                                    src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?>"/>
                            <a href="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?>">
                                <?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?></a>
                        </audio>
                    </figure>
                </div>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container");
                if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date"><span><?php the_time('F jS, Y') ?></span></div>
                    </div>
                <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->
        <?php

        break;
    case 'gallery':
        $classes[] = 'ch-gallery';
        $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_size);
        $imagewow = $imagewow[0];

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

        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-gallery">
                <i class="fa fa-picture-o" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">

                <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-gallery_media') != '') : ?>
                    <div class="post-media-container">
                        <figure class="image">
                            <div class="imx">
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
                                    <ul class="ul-gallery listable-gallery-container list-unstyled post-slider">
                                        <?php
                                        if (!empty($imagesBUlls)) :
                                            foreach ($imagesBUlls as $imagesBUll) :
                                                $imagewow = wp_get_attachment_image_src(($imagesBUll), 'wow-BlogList_MediumSmall_SidebarOpen');
                                                $imagewow = $imagewow[0];
                                                ?>
                                                <li><img data-lazy="<?php echo $imagewow ?>"
                                                         class="attachment-gallery-box-item img-responsive"
                                                         alt="<?php echo the_title(); ?>">
                                                </li>
                                            <?php endforeach; ?>
                                        <?php endif; ?>
                                    </ul>
                                </div>
                            </div>
                        </figure>
                    </div>
                <?php if (!empty($imagesBUlls)) : ?>
                <?php
                if (isset($_POST['ch_action']) && $_POST['ch_action'] == 'ch_ajax_blog_posts') :
                ?>
                    <script type="text/javascript">
                        <?php   echo "slick_slider_gallery_init('#" . $slider_id . "  .ul-gallery', true);" ?>
                    </script>
                <?php else: ?>
                <?php add_action('wp_footer', function ()

                use ($slider_id)

                {
                ?>
                    <script type="text/javascript">
                        <?php   echo "slick_slider_gallery_init('#" . $slider_id . "  .ul-gallery', true);" ?>
                    </script>
                <?php }, 20);
                    ?>
                <?php endif; ?>
                <?php endif; ?>
                <?php endif; ?>

                <?php if ($figure_image_show) : ?>
                    <figure class="image">
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
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container");
                if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date"><span><?php the_time('F jS, Y') ?></span></div>
                    </div>    <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->


        <?php


        break;
    case'quote':
        $classes[] = 'ch-quote';
        $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_size);
        $imagewow = CHfw_timeline_place_holder_box($imagewow[0], $scFW_globals); ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-quote post-ave-image">
                <i class="fa fa-quote-left" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">
                <?php if ($imagewow != "") : ?>
                    <div class="post-media-container">
                        <figure class="image">
                            <img src="<?php echo $imagewow ?>"
                                 class="img-responsive"
                                 alt="<?php echo the_title(); ?>">
                        </figure>
                    </div>
                <?php endif; ?>
                <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_quote') != ''): ?>
                    <div class="post-content-container <?php echo $entry_post_small_layout_container . ' ' . $entry_post_small_layout_container_width ?>">
                        <blockquote
                                style="border-left:5px solid <?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_borderColorQuote'); ?>">
                            <a href="<?php the_permalink() ?>"><h2>
                                    "<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_quote'); ?>
                                    "</h2>
                            </a>
                            <cite class="pull-right">
                                - <?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_quote_author'); ?>
                                - </cite>
                        </blockquote>
                    </div> <!--entry-post-** end-->
                <?php endif; ?>
                <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_quote') == ''): ?>
                    <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
                <?php endif; ?>
                <?php if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date">
                            <span><?php the_time('F jS, Y') ?></span>
                        </div>
                    </div>
                <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->
        <?php

        break;
        ?>
    <?php
    case'status':
        $classes[] = 'ch-status';
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-status">
                <i class="fa fa-flag" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container");
                if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date"><span><?php the_time('F jS, Y') ?></span></div>
                    </div>
                <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->
        <?php

        break;
    default:
        $classes[] = 'standart-post';
        $classes[] = 'ch-image';
        // if sidebar blog ==  blog_list_small_sidebarOpen_post
        $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), $image_size);
        $imagewow = CHfw_timeline_place_holder_box($imagewow[0], $scFW_globals);
        ?>
        <div id="post-<?php the_ID(); ?>" <?php post_class($classes); ?>>
            <div class="sc_fw-timeline-img post-ave-image">
                <i class="fa fa-camera" aria-hidden="true"></i>
            </div> <!-- sc_fw-timeline-img -->
            <div class="sc_fw-timeline-content">
                <?php if ($imagewow != "") : ?>
                    <div class="<?php echo $image_overlay_type ?>">
                        <div class="body-post">
                            <figure class="image">
                                <img class="img-responsive img-<?php echo $scFW_globals['image_effect_type'] ?>"
                                     src="<?php echo $imagewow; ?>"
                                     alt="<?php echo the_title(); ?>">
                                <?php if ($scFW_globals['image_effect_type'] == 'overlay') : ?>
                                    <div class="overlay overlay-effect">
                                        <div class="middle">
                                            <i class="text-fa fa fa-picture-o" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                <?php endif ?>
                            </figure>
                        </div>
                    </div>
                <?php endif; ?>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container");
                if (!$zigzag_page) : ?>
                    <div class="sc_fw-date">
                        <div class="date"><span><?php the_time('F jS, Y') ?></span></div>
                    </div>
                <?php endif; ?>
            </div> <!-- sc_fw-timeline-content -->
        </div> <!-- sc_fw-timeline-block post -->
    <?php
}