<?php
$themeName = 'wow_';

include ("matabox_page_options.php");
include("matabox_post_options.php");

// META BOX CONFIG (Post Format  Settings) class include  --------------------------
$st_studio_prefix_audio = $themeName . "post-format-audio_";

// META BOX CONFIG (Post Format  Settings---AUDIO) --------------------------
$options_audio_setting = array(
    'name' => $st_studio_prefix_audio . 'meta-box-page',
    'nonce' => 'st_studio',
    'title' => __('Audio Settings','chfw-lang'),
    'page' => 'post',
    'title_h2' => true,
    'context' => 'normal',
    'priority' => 'default',
    'class' => '',
    'style' => '',
    'fields' => array(
        array(
            'name' => $st_studio_prefix_audio . 'mp3FileUrl',
            'title' => __('MP3 file URL','chfw-lang'),
            'type' => 'upload',
            'description' => __('The file url mp3 audio file','chfw-lang'),
            'style' => '',
            'class' => '',
            'class_li' =>'',
            'button_text' => __('Browse','chfw-lang'),
            'button_style' => '',
            'extra' =>'',
        ),
        array(
            'name' => $st_studio_prefix_audio . 'oggFileUrl',
            'title' => __('Ogg file URL','chfw-lang'),
            'type' => 'upload',
            'button_text' => __('Browse','chfw-lang'),
            'button_style' => ';',
            'description' => __('The file url oga,ogg audio file','chfw-lang'),
            'style' => 'box-shadow:none;',
            'class_li' =>'',
            'class' => '',
            'extra' =>'',

        ),
        array(
            'name' => $st_studio_prefix_audio . 'audioPosterImage',
            'title' => __('Audio Poster Image','chfw-lang'),
            'type' => 'upload',
            'button_text' => __('Browse','chfw-lang'),
            'button_style' => '',
            'description' => __('Select a custom poster image for the audio','chfw-lang'),
            'style' => 'box-shadow:none;',
            'class_li' =>'',
            'class' => '',
            'extra' =>'',
        ),
        array(
            'name' => $st_studio_prefix_audio . 'posterImageHeight',
            'title' => __('Poster Image Height','chfw-lang'),
            'type' => 'text',
            'description' => __('If you are including a poster image, please indicate the height of the image.','chfw-lang'),
            'style' => '',
            'class_li' =>'',
            'class' => '',
            'extra' =>'',
        )
    )
);
// META BOX CONFIG (Post Format  Settings---Image) --------------------------
$st_studio_prefix_image = $themeName . "post-format-image_";
$options_image_setting = array(
    'name' => $st_studio_prefix_image . 'meta-box-page',
    'nonce' => 'st_studio',
    'title' => __('Image Settings','chfw-lang'),
    'page' => 'post',
    'title_h2' => true,
    'context' => 'normal',
    'priority' => 'default',
    'class' => '',
    'class_li' =>'',
    'style' => '',
    'fields' => array(
        array(
            'name' => $st_studio_prefix_image . 'uploadImage',
            'title' => __('Image URL','chfw-lang'),
            'type' => 'upload',
            'button_text' => __('Browse','chfw-lang'),
            'button_style' => '',
            'description' => __('Select a custom poster image for the audio','chfw-lang'),
            'style' => 'box-shadow:none;',
            'class' => '',
            'extra' =>'',
        )
    )
);
// META BOX CONFIG (Post Format  Settings---Link) --------------------------
$st_studio_prefix_link = $themeName . "post-format-link_";
$options_link_setting = array(
    'name' => $st_studio_prefix_link . 'meta-box-page',
    'nonce' => 'st_studio',
    'title' => __('Link Settings','chfw-lang'),
    'page' => 'post',
    'title_h2' => true,
    'context' => 'normal',
    'priority' => 'default',
    'class' => '',
    'class_li' =>'',
    'style' => '',
    'fields' => array(
        array(
            'name' => $st_studio_prefix_link . 'link',
            'title' => __('URL','chfw-lang'),
            'type' => 'text',
            'description' => __('Paste you link here ,make sure link post format is selected .eg (http://www.themeforest.com)','chfw-lang'),
            'style' => '',
            'class_li' =>'',
            'class' => '',
            'extra' =>'',
        )
    )
);
// META BOX CONFIG (Post Format  Settings---Quote) --------------------------
$st_studio_prefix_quote = $themeName . "post-format-quote_";
$options_quote_setting = array(
    'name' => $st_studio_prefix_quote . 'meta-box-page',
    'nonce' => 'st_studio',
    'title' => __('Quote Settings','chfw-lang'),
    'page' => 'post',
    'title_h2' => true,
    'context' => 'normal',
    'priority' => 'default',
    'class' => '',
    'class_li' =>'',
    'style' => '',
    'fields' => array(
        array(
            'name' => $st_studio_prefix_quote . 'quote',
            'title' => __('Quote','chfw-lang'),
            'type' => 'textarea',
            'description' => __('Add a quote post , select quote post format.','chfw-lang'),
            'style' => '',
            'class_li' =>'',
            'class' => '',
            'extra' =>'',
        ),
        array(
            'name' => $st_studio_prefix_quote . 'quote_author',
            'title' => __('Quote Author','chfw-lang'),
            'type' => 'text',
            'description' => __('Quote author','chfw-lang'),
            'style' => '',
            'class_li' =>'',
            'class' => '',
            'extra' =>'',
        ),

        array(
            'name' => $st_studio_prefix_quote . 'backgroundColorQuote',
            'title' => __('Background Color','chfw-lang'),
            'type' => 'color',
            'description' => __('Select a custom background color for the uploaded image.','chfw-lang'),
            'style' => 'color:#fff;box-shadow:none;',
            'class' => '',
            'class_li' =>'',
            'default_color' => '#777',
            'extra' =>'',
        ),

        array(
            'name' => $st_studio_prefix_quote . 'borderColorQuote',
            'title' => __('Border Color','chfw-lang'),
            'type' => 'color',
            'description' => __('Select a custom background color for the uploaded image.','chfw-lang'),
            'style' => 'color:#fff;box-shadow:none;',
            'class' => '',
            'class_li' =>'',
            'default_color' => '#E4584A',
            'extra' =>'',
        ),
    )
);
// META BOX CONFIG (Post Format  Settings---Video) --------------------------
$st_studio_prefix_video = $themeName . "post-format-video_";
$options_video_setting = array(
    'name' => $st_studio_prefix_video . 'meta-box-page',
    'nonce' => 'st_studio',
    'title' => __('Video Settings','chfw-lang'),
    'page' => 'post',
    'title_h2' => true,
    'context' => 'normal',
    'priority' => 'default',
    'class' => '',
    'class_li' =>'',
    'style' => '',
    'fields' => array(
        array(//wow_post-format-video_mp4FileUrl
            'name' => $st_studio_prefix_video . 'mp4FileUrl',
            'title' => __('MP4 file URL','chfw-lang'),
            'type' => 'upload',
            'description' => __('The file url mp4 audio file','chfw-lang'),
            'style' => '',
            'class' => '',
            'class_li' =>'',
            'extra' =>'',
            'button_text' => __('Browse','chfw-lang'),
            'button_style' => '',
        ),
        array(
            'name' => $st_studio_prefix_video . 'ogvFileUrl',
            'title' => __('Ogv file URL','chfw-lang'),
            'type' => 'upload',
            'button_text' => __('Browse','chfw-lang'),
            'button_style' => '',
            'description' => __('The file url ogv video file','chfw-lang'),
            'style' => 'box-shadow:none;',
            'class_li' =>'',
            'extra' =>'',
            'class' => '',
        ),
        array(
            'name' => $st_studio_prefix_video . 'videoPosterImage',
            'title' => __('Video Poster Image','chfw-lang'),
            'type' => 'upload',
            'button_text' => __('Browse','chfw-lang'),
            'button_style' => '',
            'description' => __('Select a custom preview image for the video','chfw-lang'),
            'style' => 'box-shadow:none;',
            'class_li' =>'',
            'extra' =>'',
            'class' => '',
        ),

        array(
            'name' => $st_studio_prefix_video . 'videoEmbed',
            'title' => __('Video Embed Code','chfw-lang'),
            'type' => 'embed',
            'description' => __('if you\'re not using self hosted video then you can include embeded code here. Best viewed at 600px wide.Eq https://www.youtube.com/watch?v=123ABCxxx','chfw-lang'),
            'style' => '',
            'extra' =>'oEmbed',
            'class_li' =>'',
            'class' => '',
        ),
    )
);
// META BOX CONFIG (Post Format  Settings---Gallery) --------------------------
$st_studio_prefix_gallery = $themeName . "post-format-gallery_";
$options_gallery_setting = array(
    'name' => $st_studio_prefix_gallery . 'meta-box-page',
    'nonce' => 'st_studio',
    'title' => __('Gallery Settings','chfw-lang'),
    'page' => 'post',
    'title_h2' => true,
    'context' => 'advanced',
    'priority' => 'default',
    'class' => '',
    'style' => '',
    'fields' => array(
        array(
            'name' => $st_studio_prefix_gallery . 'media',
            'title' => __('Images','chfw-lang'),
            'type' => 'media-gallery',
            'description' => __('Select a custom uploaded image.','chfw-lang'),
            'style' => 'color:#fff;box-shadow:none;',
            'extra' =>'',
            'class_li' =>'',
            'class' => '',
        )
    )
);

