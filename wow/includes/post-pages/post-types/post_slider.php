<?php
/**
 * The template for displaying content in the single.php and blog pages
 * SLIDER POST
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

switch ($format_typeBull) {
    case 'link':
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <div class=slinks>
                    <div class="slink">
                        <a class=""
                           href="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-link_link'); ?>"><?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-link_link'); ?></a>
                    </div>
                </div>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
        <?php

        break;
    case 'video':
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <figure class="video-image">
                    <div class="embed-responsive embed-responsive-16by9">
                        <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoEmbed') == '') { ?>
                            <!-- MP4 for Safari, IE9, iPhone, iPad, Android, and Windows Phone 7 -->
                            <video controls="controls"
                                   poster="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoPosterImage'); ?>"
                                   class="video embed-responsive-item">
                                <source
                                        src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_mp4FileUrl'); ?>"
                                        type="video/mp4">
                                Your browser does not support the video tag.;
                                <!-- Flash fallback for non-HTML5 browsers without JavaScript -->
                                <object type="application/x-shockwave-flash"
                                        data="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/mediaelement/flashmediaelement.swf">
                                    <param name="movie"
                                           value="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/mediaelement/flashmediaelement.swf"/>
                                    <param name="flashvars"
                                           value="controls=true&file=<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_mp4FileUrl'); ?>"/>
                                    <!-- Image as a last resort -->
                                    <img
                                            alt="<?php echo get_the_title(); ?>" src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoPosterImage'); ?>"
                                            title="No video playback capabilities"/>
                                </object>
                            </video>
                            <span id="video-type"></span>
                            <?php
                        } else {
                            echo CHfw_get_meta(get_the_ID(), 'wow_post-format-video_videoEmbed');
                        }
                        ?>
                    </div>
                </figure>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
        <?php
        break;

    case 'image':
        $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'sc_fw-post_timeline');
        $imagewow = $imagewow[0];
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <?php if ($imagewow != "") { ?>
                    <div class="<?php echo $image_overlay_type ?>">
                        <figure class="image">
                            <img class="img-responsive" src="<?php echo $imagewow; ?>" alt="<?php echo the_title(); ?>">
                            <div class="overlay">
                                <a href="<?php the_permalink() ?>" class="expand">+</a> <a class="close-overlay hidden">x</a>
                            </div>
                        </figure>
                    </div>
                <?php } ?>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
        <?php
        break;
    case 'audio':
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <figure class="image">
                    <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_audioPosterImage') != '') { ?>
                        <img src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_audioPosterImage') ?>"
                             alt="<?php echo the_title(); ?>" class="img-responsive border-radius-none">
                    <?php } ?>
                    <audio class="site-audio" preload="none" style="width: 100%; visibility: hidden;" controls="controls">
                        <source type="audio/mpeg" src="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?>"/>
                        <a href="<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?>"><?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-audio_mp3FileUrl') ?></a>
                    </audio>
                </figure>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
        <?php

        break;
    case 'gallery':
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <?php if (CHfw_get_meta(get_the_ID(), 'wow_post-format-gallery_media') != '') { ?>
                    <figure class="image">
                        <div class="">
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
                            ?>
                            <div class="gallery-container" id="gallery-post-slider-<?php echo get_the_ID() ?>">
                                <ul class="list-unstyled post-slider listable-gallery-container">
                                    <?php
                                    if (!empty($imagesBUlls)) {
                                        foreach ($imagesBUlls as $imagesBUll) {
                                            ?>
                                            <li><img src="<?php echo $imagesBUll ?>" class="attachment-gallery-box-item img-responsive" alt="<?php echo the_title(); ?>"/></li>
                                        <?php }
                                    } ?>
                                </ul>
                            </div>
                        </div>
                    </figure>
                <?php } ?>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
        <?php

        break;
    case 'quote':
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <?php if ($imagewow != "") { ?>
                    <figure class="image">
                        <img src="<?php echo $imagewow ?>" class="img-responsive" alt="<?php echo the_title(); ?>">
                    </figure>
                <?php } ?>

                <blockquote style="border-left:5px solid <?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_borderColorQuote'); ?>">
                    <h2>"<?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_quote'); ?>"</h2>
                    <cite class="pull-right">- <?php echo CHfw_get_meta(get_the_ID(), 'wow_post-format-quote_quote_author'); ?>-</cite>
                </blockquote>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
        <?php

        break;
        ?>
    <?php
    case 'status':
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <figure class="inner-wrap_status" style="background-image: url(<?php
                echo CHfw_get_meta(get_the_ID(), 'wow_post-format-status_background_image');
                ?> ) ; background-repeat: no-repeat;">
                    <div class="status_type status-wrap">
                        <div class="embed-responsive embed-responsive-16by9">
                            <?php
                            echo CHfw_get_meta(get_the_ID(), 'wow_post-format-status_Status');
                            ?>
                        </div>
                    </div>
                </figure>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
        <?php
        break;
    default:
        $imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'sc_fw-post_timeline');
        $imagewow = $imagewow[0];
        ?>
        <li class="embed-post-block col-md-6 col-sm-6 post">
            <div class="sc-embed-post-content">
                <?php if ($imagewow != "") { ?>
                    <div class="<?php echo $image_overlay_type ?>">
                        <figure class="image">
                            <img class="img-responsive" src="<?php echo $imagewow; ?>" alt="<?php echo the_title(); ?>">
                            <div class="overlay">
                                <a href="<?php the_permalink() ?>" class="expand">+</a>
                                <a class="close-overlay hidden">x</a>
                            </div>
                        </figure>
                    </div>
                <?php } ?>
                <?php get_template_part("includes/post-pages/post-types/inc_post_content_container"); ?>
            </div> <!-- sc-embed-post-content -->
        </li> <!-- embed-post-block col-md-6 col-sm-6 post -->
    <?php

}