<?php
global $CHfw_rdx_options, $CHfw_select_skin, $page_setting_class;
$headerClass = "";

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
    <meta http-equiv="Content-Type" content="<?php bloginfo('html_type'); ?>; charset=<?php bloginfo('charset'); ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <?php
    if (isset($CHfw_rdx_options['android_theme_color_' . $CHfw_select_skin])) : ?>
        <meta name="theme-color" content="<?php echo $CHfw_rdx_options['android_theme_color_' . $CHfw_select_skin] ?>">
    <?php endif; ?>
    <!--[if lt IE 9]>
    <script src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/js/third-party/html5shiv.min.js"></script>
    <![endif]-->
    <?php
    if (isset($CHfw_rdx_options['favicon']['url']) && !empty($CHfw_rdx_options['favicon']['url'])) :
        echo '<link rel="icon" href="' . $CHfw_rdx_options['favicon']['url'] . '" type="image/x-icon"/>';
        ?>
    <?php else : ?>
        <link rel="icon" href="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/images/favicon.png" type="image/x-icon"/>
    <?php endif; ?>
    <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>"/>
    <?php if (is_page()): ?>
        <?php
        $pid = get_the_ID();
        $headerdata = CHfw_get_meta($pid, 'wow_pageSetting_headerExtraClass');
        $headerClass = $headerdata == "" ? $headerdata : "";
        $bg = CHfw_get_meta($pid, 'wow_pageSetting_backgroundImage');
        $pos = CHfw_get_meta($pid, 'wow_pageSetting_background_position');
        $bgColor = CHfw_get_meta($pid, 'wow_pageSetting_backgroundColor');
        $bgrepeat = CHfw_get_meta($pid, 'wow_pageSetting_background_repeat');
        $bg = is_array($bg) ? '' : esc_attr($bg);
        $pos = is_array($pos) ? '' : esc_attr($pos);
        $bgColor = is_array($bgColor) ? '' : esc_attr($bgColor);
        $bgrepeat = is_array($bgrepeat) ? '' : esc_attr($bgrepeat);
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
<body id="<?php echo $CHfw_select_skin ?>" <?php body_class('header-standartbody'); ?>>
<?php if (isset($CHfw_rdx_options['pages_lading_effect']) and $CHfw_rdx_options['pages_lading_effect'] == 1) : ?>
    <div id="loader-wrapper">
        <div id="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>
<?php endif; ?>
<div id="small-dialog" class="small-dialog-class zoom-anim-dialog mfp-hide"></div>
<div id="wrapper" class="toggled1 <?php echo $page_setting_class->siteBodyLayoutSetting(); ?>">
    <header class="header-container header-standart <?php echo $headerClass ?>">
        <?php get_template_part("includes/header-menu/top-header"); ?>
        <nav id="header-center-ch">
            <div class="container">
                <div class="row">
                    <div class="header-wrap hidden-xs hidden-sm">
                        <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12 inner">
                            <div class="row">
                                <form role="search" method="get" id="search-form"
                                      action="<?php echo esc_url(home_url('/')); ?>">
                                    <input type="hidden" class="post_zone_cls" name="ch_zone"
                                           value="<?php echo CHfw_searchParam()['post_zone']; ?>"/>
                                    <input type="hidden" class="post_type_cls" name="post_type"
                                           value="<?php echo CHfw_searchParam()['post_type']; ?>"/>
                                    <input type="text" autocomplete="off" class="shop-search-input input-search"
                                           name="s" placeholder="<?php echo CHfw_searchParam()['placeholder']; ?>">
                                    <button type="submit" class="button-search"><i class="fa fa-search"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="header-right col-lg-4 col-md-4 col-sm-12 header-hidden inner"
                             id="logo-header">
                            <a href="<?php echo esc_url(home_url('/')); ?>" title="#home" class="logo">
                                <?php
                                if (isset($CHfw_rdx_options['logo2x_' . $CHfw_select_skin]['url']) && !empty($CHfw_rdx_options['logo2x_' . $CHfw_select_skin]['url'])) : ?>
                                    <img src="<?php echo $CHfw_rdx_options['logo2x_' . $CHfw_select_skin]['url'] ?>"
                                         alt="Site Logo">
                                <?php else : ?>
                                    <img
                                            src="<?php echo esc_url(get_stylesheet_directory_uri()); ?>/assets/logo@2x.png"
                                            alt="Site Logo">
                                <?php endif; ?>
                            </a>
                        </div>
                        <div class="header-right col-lg-4 col-md-4 col-sm-12 header-hidden inner">
                            <div class="custom-block-header">
                                <?php
                                if (isset($CHfw_rdx_options['header_text']) && $CHfw_rdx_options['header_text'] != '') {
                                    echo $CHfw_rdx_options['header_text'];
                                } else {
                                    echo '<i class="fa fa-phone top_phoone"></i>
                                         <span>+1-202-555-0159</span>
                                       <span class="split"></span><span>support@sctheme.com</span>';
                                }
                                ?>
                            </div>
                            <!-- end custom-block-header -->
                            <?php if (CHfw_woocommerce_activated()) : ?>
                                <?php if (isset($CHfw_rdx_options['shop_mini_cart_enable_disable_' . $CHfw_select_skin]) and $CHfw_rdx_options['shop_mini_cart_enable_disable_' . $CHfw_select_skin] == 1) : ?>
                                    <div id="minicart-container">
                                        <div class="cart-top">
                                            <a class="cart_link"
                                               href="<?php echo WC()->cart->get_cart_url(); ?>">
                                                <span class="mylabel lable"><?php echo intval(WC()->cart->cart_contents_count); ?></span>
                                                <i class="fa fa-shopping-cart"></i></a>

                                            <div class="mini-cart">
                                                <div style="display: none;" class="content cart1">
                                                    <div class="cart-container">
                                                        <?php woocommerce_mini_cart(); ?>
                                                    </div>   <!-- end cart-container -->
                                                </div>   <!-- end content sepet1-->
                                            </div>
                                        </div>
                                        <!-- end  cart -->
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </nav>
        <?php
        get_template_part("includes/header-menu/desktop", "menu");
        get_template_part("includes/header-menu/mobil", "menu");
        ?>
    </header>