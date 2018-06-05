<?php
// META BOX CONFIG (Post Settings)  class include  -------------------------------------------------------
$st_studio_prefix_post = $themeName .  "postSetting_";
$options_post_setting = array(
	'name' => $st_studio_prefix_post . 'meta-box-page',
	'nonce' => 'st_studio',
	'title' => __('Post Settings','chfw-lang'),
	'page' => 'post',
	'title_h2' => true,
	'context' => 'normal',
	'priority' => 'default',
	'class' => '',
	'class_li' =>'',
	'style' => '',
	'fields' => array(
		array(
			'name' => $st_studio_prefix_post . 'background_repeat',
			'title' => __('Background Repeat','chfw-lang'),
			'type' => 'select',
			'description' => __('Upload a custom background image for this page. Once uploaded, click "Insert to Post".','chfw-lang'),
			'style' => '',
			'class' => '',
			'class_li' =>'',
			'extra' =>'',
			'options' => array(
				'no-repeat' => __('No Repeat','chfw-lang'),
				'repeat' => __('Repeat','chfw-lang'),
				'repeat-x' => __('Repeat Horizontally','chfw-lang'),
				'repeat-y' => __('Repeat Vertically','chfw-lang')
			)
		),

		array(
			'name' => $st_studio_prefix_post . 'background_position',
			'title' => __('Background Position','chfw-lang'),
			'type' => 'select',
			'description' => '',
			'style' => '',
			'class' => '',
			'class_li' =>'',
			'extra' =>'',
			'options' => array(
				'left top' => __('Left Top','chfw-lang'),
				'left center' => __('Left Center','chfw-lang'),
				'left bottom' => __('Left Bottom','chfw-lang'),
				'right bottom' => __('Right Bottom','chfw-lang'),
				'right center' => __('Right Center','chfw-lang'),
				'right top' => __('Right Top','chfw-lang'),
				'center bottom' => __('Center Bottom','chfw-lang'),
				'center center' => __('Center Center','chfw-lang'),
				'center top' => __('Center Top','chfw-lang'),

			)
		),
		array(
			'name' => $st_studio_prefix_post . 'backgroundColor',
			'title' => __('Background Color','chfw-lang'),
			'type' => 'color',
			'description' => __('Select a custom background color for the uploaded image.','chfw-lang'),
			'style' => 'color:#fff;box-shadow:none;',
			'class' => '',
			'class_li' =>'',
			'extra' =>'',
			'default_color' => '#453435'
		),
		array(
			'name' => $st_studio_prefix_post . 'backgroundImage',
			'title' => __('Background Image','chfw-lang'),
			'type' => 'upload',
			'button_text' => __('Browse','chfw-lang'),
			'button_style' => '',
			'description' => __('Select a custom background for the uploaded image.','chfw-lang'),
			'style' => 'box-shadow:none;',
			'class' => '',
			'class_li' =>'',
			'extra' =>'',
		)
	)
);