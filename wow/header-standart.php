<?php
global $CHfw_rdx_options,$page_setting_class,$CHfw_select_skin;
$headerClass = "";
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <link rel="profile" href="http://gmpg.org/xfn/11"/>
    <?php
    if ( isset( $CHfw_rdx_options[ 'android_theme_color_' . $CHfw_select_skin ] ) ) : ?>
        <meta name="theme-color" content="<?php echo $CHfw_rdx_options[ 'android_theme_color_' . $CHfw_select_skin ] ?>">
    <?php endif; ?>
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/third-party/html5shiv.min.js"></script>
    <![endif]-->
    <?php
    if ( isset( $CHfw_rdx_options['favicon']['url'] ) && ! empty( $CHfw_rdx_options['favicon']['url'] ) ) :
        echo '<link rel="icon" href="' . $CHfw_rdx_options['favicon']['url'] . '" type="image/x-icon"/>';
        ?>
    <?php else : ?>
        <link rel="icon" href="<?php echo esc_url( get_stylesheet_directory_uri() ); ?>/assets/images/favicon.png"
              type="image/x-icon"/>
    <?php endif; ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php if (is_page()):?>
        <?php
        $pid      = get_the_ID();
        $headerdata = CHfw_get_meta($pid, 'wow_pageSetting_headerExtraClass');
        $headerClass = $headerdata == "" ? $headerdata : "";
        $bg       = CHfw_get_meta( $pid, 'wow_pageSetting_backgroundImage' );
        $pos      = CHfw_get_meta( $pid, 'wow_pageSetting_background_position' );
        $bgColor  = CHfw_get_meta( $pid, 'wow_pageSetting_backgroundColor' );
        $bgrepeat = CHfw_get_meta( $pid, 'wow_pageSetting_background_repeat' );
        $bg =is_array( $bg) ? '' : esc_attr( $bg) ;
        $pos =is_array($pos) ? '' : esc_attr($pos) ;
        $bgColor =is_array($bgColor) ? '' : esc_attr($bgColor) ;
        $bgrepeat =is_array($bgrepeat) ? '' : esc_attr($bgrepeat) ;
        ?>
        <style>
            body {
            <?php if (!empty($bg)): ?> background-image: url("<?php echo $bg?>") !important;
                background-repeat: <?php echo $bgrepeat?> !important;
                background-position: <?php echo $pos?> !important;
            <?php endif; ?><?php if (!empty($bgColor)): ?> background-color: <?php echo $bgColor?> !important;
            <?php endif; ?>
            }
        </style>
    <?php endif; ?>
    <?php wp_head(); ?>
</head>
<body id="<?php echo $CHfw_select_skin?>" <?php body_class("header-TopMinimal"); ?>>
<?php	if (isset($CHfw_rdx_options['pages_lading_effect']) and $CHfw_rdx_options['pages_lading_effect'] ==1) : ?>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
<?php endif; ?>
<div id="small-dialog" class="small-dialog-class zoom-anim-dialog mfp-hide"></div>
<div id="wrapper" class="toggled1 <?php echo $page_setting_class->siteBodyLayoutSetting(); ?>">
    <header class="header-container  header-minimal header-top-minimal <?php echo $headerClass?>">
        <?php
        get_template_part( "includes/header-menu/top-header-this" );
        get_template_part( "includes/header-menu/desktop-menu-this" );
        get_template_part( "includes/header-menu/mobil-menu" ); ?>
    </header>