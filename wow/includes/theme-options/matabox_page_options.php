<?php
// META BOX CONFIG (Page Settings)  class include  -------------------------------------------------------
$st_studio_prefix_page = $themeName . "pageSetting_";
$options_page_setting_forPage = array(
    'name' => $st_studio_prefix_page . 'meta-box-page',
    'nonce' => 'st_studio_page',
    'title' => __('Page Settings', 'chfw-lang'),
    'page' => 'page',
    'title_h2' => true,
    'context' => 'normal',
    'priority' => 'default',
    'class' => '',
    'class_li' => '',
    'style' => '',
    'fields' => array(
        array(
            'name' => $st_studio_prefix_page . 'background_repeat',
            'title' => __('Background Repeat', 'chfw-lang'),
            'type' => 'select',
            'description' => __('Upload a custom background image for this page. Once uploaded, click "Insert to Post".', 'chfw-lang'),
            'style' => '',
            'class' => '',
            'class_li' => '',
            'extra' => '',
            'options' => array(
                'no-repeat' => __('No Repeat', 'chfw-lang'),
                'repeat' => __('Repeat', 'chfw-lang'),
                'repeat-x' => __('Repeat Horizontally', 'chfw-lang'),
                'repeat-y' => __('Repeat Vertically', 'chfw-lang')
            )
        ),

        array(
            'name' => $st_studio_prefix_page . 'background_position',
            'title' => __('Background Position', 'chfw-lang'),
            'type' => 'select',
            'description' => '',
            'style' => '',
            'class' => '',
            'class_li' => '',
            'extra' => '',
            'options' => array(
                'left top' => __('Left Top', 'chfw-lang'),
                'left center' => __('Left Center', 'chfw-lang'),
                'left bottom' => __('Left Bottom', 'chfw-lang'),
                'right bottom' => __('Right Bottom', 'chfw-lang'),
                'right center' => __('Right Center', 'chfw-lang'),
                'right top' => __('Right Top', 'chfw-lang'),
                'center bottom' => __('Center Bottom', 'chfw-lang'),
                'center center' => __('Center Center', 'chfw-lang'),
                'center top' => __('Center Top', 'chfw-lang'),

            )
        ),
        array(
            'name' => $st_studio_prefix_page . 'backgroundColor',
            'title' => __('Background Color', 'chfw-lang'),
            'type' => 'color',
            'description' => __('Select a custom background color ', 'chfw-lang'),
            'style' => 'color:#fff;box-shadow:none;',
            'class' => '',
            'class_li' => '',
            'extra' => '',
            'default_color' => '#453435'
        ),
        array(
            'name' => $st_studio_prefix_page . 'backgroundImage',
            'title' => __('Background Image', 'chfw-lang'),
            'type' => 'upload',
            'button_text' => __('Browse', 'chfw-lang'),
            'button_style' => '',
            'description' => __('Select a custom background for the uploaded image.', 'chfw-lang'),
            'style' => 'box-shadow:none;',
            'extra' => '',
            'class' => '',
            'class_li' => '',
        ),

        array(
            'name' => 'page_header_type_info',
            'title' => __('Page Options', 'chfw-lang'),
            'type' => 'info',
            'description' => '',
            'style' => '',
            'class' => '',
            'class_li' => '',
            'extra' => '',
        ),

        array(
            'name' => $st_studio_prefix_page . 'Top_margin_of_inner_page',
            'title' => __('Top margin of inner page', 'chfw-lang'),
            'type' => 'select',
            'description' => '',
            'style' => '',
            'class' => '',
            'class_li' => '',
            'extra' => '',
            'options' => array(
                'top-margin0' => __('No Space', 'chfw-lang'),
                'top-margin10' => __('Top Margin:10px', 'chfw-lang'),
                'top-margin15' => __('Top Margin:15px', 'chfw-lang'),
                'top-margin20' => __('Top Margin:20px', 'chfw-lang'),
            )
        ),
        array(
            'name' => $st_studio_prefix_page . 'page_title_option',
            'title' => __('Page Title', 'chfw-lang'),
            'type' => 'select',
            'description' => '',
            'style' => '',
            'class' => '',
            'class_li' => '',
            'extra' => '',
            'options' => array(
                'hide' => __('Hide', 'chfw-lang'),
                'show' => __('Show', 'chfw-lang'),


            )
        ),

        array(
            'name' => 'page_header_type_info',
            'title' => __('Page Header Options', 'chfw-lang'),
            'type' => 'info',
            'description' => '',
            'style' => '',
            'class' => '',
            'class_li' => '',
            'extra' => '',
        ),
        array(
            'name' => $st_studio_prefix_page . 'header_type_selected',
            'type' => 'image_select',
            'title' => __('Header Type', 'chfw-lang'),
            'class_li' => '',
            'style' => '',
            'class' => '',
            'extra' => '',
            'description' => '',
            'options' => array(
                'standart' => array(
                    'title' => 'Header Standart',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_full64.png'
                ),
                'fixed' => array(
                    'title' => 'Fixed Header ',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_minimal_64_fixed.png'
                ),
                'minimal' => array(
                    'title' => 'Minimal Header',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_minimal_64.png'
                ),
                'top_minimal' => array(
                    'title' => 'Top + Minimal Header',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_top_minimal_64.png'
                ),
                'fixed-costum' => array(
                    'title' => 'Fixed Header Custom',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_minimal_64_fixed_custom.png'
                ),
                'no' => array(
                    'title' => 'No Header',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_no_64.png'
                ),
                'use_system_header' => array(
                    'title' => 'System Header',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_no_64.png'
                ),
            ),
            'required_test' => array(
                'sidebar_widget_title_selected',
                '=',
                'colored_two_widget',
            ),

        ),

        array(
            'name' => $st_studio_prefix_page . 'headerExtraClass',
            'title' => __('Header Class', 'chfw-lang'),
            'type' => 'text',
            'description' => __('Header extra class', 'chfw-lang'),
            'style' => 'color:#000;box-shadow:none;',
            'class' => '',
            'class_li' => '',
            'extra' => '',
        ),

        array(
            'name' => $st_studio_prefix_page . 'headerbackgroundColor',
            'title' => __('Header Background Color', 'chfw-lang'),
            'type' => 'color',
            'description' => __('Select a custom header background color .', 'chfw-lang'),
            'style' => 'color:#fff;box-shadow:none;',
            'class' => '',
            'class_li' => 'metabox_visible header_type_selected_reguired',
            'extra' => '',
            'default_color' => '#453435'
        ),

        array(
            'name' => 'page_footer_type_info',
            'title' => __('Page Footer Options', 'chfw-lang'),
            'type' => 'info',
            'description' => '',
            'style' => '',
            'class' => '',
            'class_li' => '',
            'extra' => '',
        ),
        array(
            'name' => $st_studio_prefix_page . 'footer_type_selected',
            'type' => 'image_select',
            'title' => __('Footer Type', 'chfw-lang'),
            'class_li' => '',
            'description' => '',
            'style' => '',
            'class' => '',
            'extra' => '',
            'options' => array(

                'footer-standard' => array(
                    'title' => 'Footer Standard',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/footer/footer_standart.png'
                ),

                'footer-minimal' => array(
                    'title' => 'Footer Minimal',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/footer/footer_minimal.png'
                ),

                'footer-no' => array(
                    'title' => 'No Footer',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/footer/footer_no.png'
                ),
            ),
            'required_test' => array(
                'sidebar_widget_title_selected',
                '=',
                'colored_two_widget',
            ),

        ),

    )
);