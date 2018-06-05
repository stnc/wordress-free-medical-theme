<?php
/**
 * The base skin configuration
 *  Copyright (c) 2016
 * @copyright Copyright (c) 2016 CHROMTHEMES
 * @version 5.0
 * @package ReduxFramework
 *
 */


global $CHfw_themeCurrentSkin_option_name, $CHfw_select_skin, $CHfw_defaultwowSkin;
$CHfw_select_skin_gen = $CHfw_select_skin;

if ( empty( $CHfw_select_skin ) ) {
    $CHfw_select_skin_gen = $CHfw_defaultwowSkin;

}

//echo "skins/".$CHfw_select_skin_gen.".php";
include "skins/" . $CHfw_select_skin_gen . ".php";

$ThemeStyleSetting_DefaultConfig = array(
    $CHfw_select_skin_gen => $ThemeStyleSetting_DefaultConfig_autoDefault,
);

$MainPageSetting_DefaultConfig = array(
    $CHfw_select_skin_gen => $MainPageSetting_DefaultConfig_autoDefault,
);

$headerSetting_DefaultConfig = array(
    $CHfw_select_skin_gen => $headerSetting_DefaultConfig_autoDefault,
);

$menuSetting_DefaultConfig = array(
    $CHfw_select_skin_gen => $menuSetting_DefaultConfig_autoDefault,
);

$TopNavBarSetting_DefaultConfig = array(
    $CHfw_select_skin_gen => $TopNavBarSetting_DefaultConfig_autoDefault,
);


$mobileMenuSetting_DefaultConfig = array(
    $CHfw_select_skin_gen => $mobileMenuSetting_DefaultConfig_autoDefault,
);

$blogPostListStyle_DefaultConfig = array(
    $CHfw_select_skin_gen => $blogPostListStyle_DefaultConfig_autoDefault,
);

$sidebarStyle_DefaultConfig = array(
    $CHfw_select_skin_gen => $sidebarStyle_DefaultConfig_autoDefault,
);

$MobileMenuAdvancedSettings_DefaultConfig = array(
    $CHfw_select_skin_gen => $MobileMenuAdvancedSettings_DefaultConfig_autoDefault,

);

$shopsetting_DefaultConfig = array(
    $CHfw_select_skin_gen => $shopsetting_DefaultConfig_autoDefault,

);

$FooterStyle_DefaultConfig = array(
    $CHfw_select_skin_gen => $FooterStyle_DefaultConfig_autoDefault,

);

class SkinGenerator {

    var $skin_Name;
    var $ThemeStyleSetting_DefaultConfig;
    var $MainPageSetting_DefaultConfig;
    var $HeaderSetting_DefaultConfig;
    var $MenuSettings_DefaultConfig;
    var $TopNavBarSetting_DefaultConfig;
    var $BlogPostListStyleSetting_DefaultConfig;
    var $SidebarSetting_DefaultConfig;
    var $MobileMenuAdvancedSettings_DefaultConfig;
    var $ShopSetting_DefaultConfig;
    var $FooterSetting_DefaultConfig;
    var $MobileMenuSetting_DefaultConfig;

    public function ThemeStyleSetting_( $sections ) {
        $skinName = $this->skin_Name;

        $Settings = array(
            array(
                'id'      => 'skin_selected_' . $skinName,
                'type'    => 'image_select',
                'title'   => __( 'Site skins', 'redux-framework-demo' ),
                'desc'    => 'Selected Skin :' . $skinName,
                'options' => array(
                    $skinName => array(
                        'alt' => $skinName,
                        'img' => ReduxFramework::$_url . 'assets/img/skins/' . $skinName . '.png'
                    ),
                ),
                'default' => $skinName,

            ),
            array(
                'id'       => 'logo2x_' . $skinName,
                'type'     => 'media',
                'title'    => __( 'Logo For Retina-Ready Devices (Big)', 'chfw-lang' ),
                'compiler' => 'true',
                'mode'     => false,
                'default'  => array(
                    'url' => $this->ThemeStyleSetting_DefaultConfig[ $skinName ]['logo2x_']['url'],

                ),
                // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => __( 'Upload the double-size version of your logo for retina-ready devices .. this is an optional step you can skip it
. <br /> <br /><b>Note: </b> You can change logo margin from <b>Theme Style Settings</b>
Size:190*75 px', 'chfw-lang' )
            ),

            array(
                'id'       => 'logo2x_mini_' . $skinName,
                'type'     => 'media',
                'title'    => __( 'Logo For Retina-Ready Devices (Mini)', 'chfw-lang' ),
                'compiler' => 'true',
                'mode'     => false,
                'default'  => array(
                    'url' => $this->ThemeStyleSetting_DefaultConfig[ $skinName ]['logo2x_mini_']['url'],

                ),
                // Can be set to false to allow any media type, or can also be set to any mime type.
                'desc'     => __( 'Upload the double-size version of your logo for retina-ready devices .. this is an optional step you can skip it. <br />
<br /><b>Note: </b> You can change logo margin from <b>Theme Style Settings</b>
Size:150*45 px', 'chfw-lang' )
            ),


            array(
                'id'      => 'siteBodyLayoutSetting_' . $skinName,
                'type'    => 'select',
                'title'   => __( 'Body Layout Setting', 'chfw-lang' ),
                'desc'    => __( 'You can select a site Body Layout type from these options', 'chfw-lang' ),
                'default' => $this->ThemeStyleSetting_DefaultConfig[ $skinName ]['siteBodyLayoutSetting_'],
                'options' => array(
                    'stretched'      => __( 'Stretched', 'chfw-lang' ),
                    'boxed'          => __( 'Boxed', 'chfw-lang' ),
                    'boxed-attached' => __( 'Boxed - Attached', 'chfw-lang' ),
                ),

            ),

        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function MainPageSetting_( $sections ) {
        $skinName = $this->skin_Name;

        $Settings = array(

            array(
                'id'       => 'android_theme_color_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Support for theme color in Chrome 39 for Android', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['android_theme_color_'],
                'validate' => 'color',
                'hint'     => array(
                    'content' => __( 'Starting in version 39 of Chrome for Android on Lollipop, you all now be able to use the theme-color meta tag to set the toolbar color this means no more Seattle gray toolbars', 'chfw-lang' ),
                ),

            ),

            array(
                'id'       => 'body_font_two_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Post Alternative Font Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for post meta , author section typography .. etc ', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['body_font_two_'],
                'validate' => 'color',

            ),


            array(
                'id'       => 'siteBodyBackgroundOptions_' . $skinName,
                'type'     => 'background',
                'title'    => __( 'Body Background', 'chfw-lang' ),
                'subtitle' => __( 'Body background with image, color, etc.', 'chfw-lang' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'background-color'      => $this->MainPageSetting_DefaultConfig[ $skinName ]['siteBodyBackgroundOptions_']['background-color'],
                    'background-repeat'     => $this->MainPageSetting_DefaultConfig[ $skinName ]['siteBodyBackgroundOptions_']['background-repeat'],
                    'background-attachment' => $this->MainPageSetting_DefaultConfig[ $skinName ]['siteBodyBackgroundOptions_']['background-attachment'],
                    'background-position'   => $this->MainPageSetting_DefaultConfig[ $skinName ]['siteBodyBackgroundOptions_']['background-position'],
                    'background-image'      => $this->MainPageSetting_DefaultConfig[ $skinName ]['siteBodyBackgroundOptions_']['background-image'],
                    'background-size'       => $this->MainPageSetting_DefaultConfig[ $skinName ]['siteBodyBackgroundOptions_']['background-size'],
                    'media'                 => $this->MainPageSetting_DefaultConfig[ $skinName ]['siteBodyBackgroundOptions_']['media'],
                ),

            ),


            array(
                'id'             => 'EntriePage_typography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Main Page Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => false,
                'subsets'        => false,
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                'letter-spacing' => false,
                'color'          => true,
                'preview'        => false,
                'all_styles'     => true,
                'text-align'     => false,
                'text-transform' => false,
                'font-family'    => false,
                'output'         => array(
                    'h2.site-description'
                ),
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                'units'          => 'px',
                'desc'           => __( 'Customize all style posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'       => $this->MainPageSetting_DefaultConfig[ $skinName ]['EntriePage_typography_']['color'],
                    'font-style'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['EntriePage_typography_']['font-style'],
                    'font-size'   => $this->MainPageSetting_DefaultConfig[ $skinName ]['EntriePage_typography_']['font-size'],
                    'line-height' => $this->MainPageSetting_DefaultConfig[ $skinName ]['EntriePage_typography_']['line-height'],

                ),

            ),


            array(
                'id'   => 'theme_setting_centerbox_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Center Box Setting', 'chfw-lang' ) . '</h3>',

            ),


            array(
                'id'            => 'SiteCenterBorder_' . $skinName,
                'type'          => 'border',
                'border-bottom' => true,
                'border-left'   => true,
                'border-right'  => true,
                'border-top'    => true,
                'title'         => __( 'Site Center Border Option', 'chfw-lang' ),
                'subtitle'      => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'output'        => array( '.site-header' ),
                'desc'          => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'       => array(
                    'border-color'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBorder_']['border-color'],
                    'border-style'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBorder_']['border-style'],
                    'border-bottom' => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBorder_']['border-bottom'],
                    'border-left'   => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBorder_']['border-left'],
                    'border-right'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBorder_']['border-right'],
                    'border-top'    => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBorder_']['border-top'],
                ),

            ),


            array(
                'id'      => 'SiteCenterBoxShadowEnableDisable_' . $skinName,
                'type'    => 'switch',
                'title'   => __( 'Site Center Box Shadow Enable Disable', 'chfw-lang' ),
                'desc'    => __( 'You can disable / enable', 'chfw-lang' ),
                'default' => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBoxShadowEnableDisable_'],
                'on'      => 'Enabled',
                'off'     => 'Disabled',

            ),


            array(
                'id'      => 'SiteCenterBoxShadow_BgColor_' . $skinName,
                'type'    => 'color_rgba',
                'title'   => __( 'Site Center Box Shadow Background Color', 'chfw-lang' ),
                //'default'  => 'rgba(0,0,0,0.85)',
                'default' => array(
                    'rgba'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBoxShadow_BgColor_']['rgba'],
                    'color' => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBoxShadow_BgColor_']['color'],
                    'alpha' => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenterBoxShadow_BgColor_']['alpha'],
                ),
                'options' => array(
                    'show_input'             => true,
                    'show_initial'           => true,
                    'show_alpha'             => true,
                    'show_palette'           => true,
                    'show_palette_only'      => false,
                    'show_selection_palette' => true,
                    'max_palette_size'       => 10,
                    'allow_empty'            => true,
                    'clickout_fires_change'  => false,
                    'choose_text'            => 'Choose',
                    'cancel_text'            => 'Cancel',
                    'show_buttons'           => true,
                    'use_extended_classes'   => true,
                    'palette'                => null,  // show default
                    'input_text'             => 'Select Color'
                ),

            ),


            array(
                'id'       => 'SiteCenter_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Site Center Background Color', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['SiteCenter_BgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'   => 'theme_setting_pagination_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="">' . __( 'Pagination Setting', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'   => 'theme_setting_pagination_info_pic1' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => 'Example <img src="' . ReduxFramework::$_url . 'assets/img/load_more_pic.png">',

            ),

            array(
                'id'       => 'loadmore_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Load More Button Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for load more button . ', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['loadmore_BgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'loadmore_TextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Load More Button Text Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for load more button . ', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['loadmore_TextColor_'],
                'validate' => 'color',

            ),

            array(
                'id'   => 'theme_setting_pagination_info_pic2' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => 'Example <img src="' . ReduxFramework::$_url . 'assets/img/ch_pagination.png">',

            ),
            array(
                'id'       => 'pagination_ButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Pagination button Background Color', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['pagination_ButtonBgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'pagination_ButtonTextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Pagination button Text Color', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['pagination_ButtonTextColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'pagination_ActiveButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Active Pagination button Background Color', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['pagination_ActiveButtonBgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'pagination_ActiveButtonTextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Active Pagination button Text Color', 'chfw-lang' ),
                'default'  => $this->MainPageSetting_DefaultConfig[ $skinName ]['pagination_ActiveButtonTextColor_'],
                'validate' => 'color',

            ),

        );
        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function TopNavBarSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(


            /*
			  //disable //cancel
			 array(
				'id'             => 'top-navbar_BoxShadow_option_' . $skinName,
				'type'           => 'spacing',
				'output'         => array('.site-header'),
				'mode'           => 'margin',
				'units'          => array('em', 'px'),
				'units_extended' => 'false',
				'title'          => __('Top Navigation Box Shadow Layout Option', 'chfw-lang'),
				'subtitle'       => __('Allow your users to choose the spacing or margin they want.', 'chfw-lang'),
				'desc'           => __('You can enable or disable any piece of this field. Top, Right, Bottom, Left, or Units.', 'chfw-lang'),
				'default'        => array(
					'margin-top'    => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_BoxShadow_option_']['margin-top'],
					'margin-right'  => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_BoxShadow_option_']['margin-right'],
					'margin-bottom' => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_BoxShadow_option_']['margin-bottom'],
					'margin-left'   => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_BoxShadow_option_']['margin-left'],
					'units'         => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_BoxShadow_option_']['units'],
				),
				'required'       =>
					array(

						array('top-navbar_dropdownBoxShadowEnableDisable_' . $skinName, '=', 1 )
					),
			),*/
            array(
                'id'       => 'top-navbarBG_color_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Top Navbar Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbarBG_color_'],
                'validate' => 'color',

            ),

            array(
                'id'      => 'top-navbar_dropdownBoxShadowEnableDisable_' . $skinName,
                'type'    => 'switch',
                'title'   => __( 'Top Navbar Box Shadow', 'chfw-lang' ),
                'desc'    => __( 'You can disable / enable', 'chfw-lang' ),
                'default' => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_dropdownBoxShadowEnableDisable_'],
                'on'      => 'Enabled',
                'off'     => 'Disabled',

            ),
            array(
                'id'           => 'top-megaMenu_BoxShadow_color_' . $skinName,
                'type'         => 'color',
                'title'        => __( 'Top Navbar Box Shadow Color', 'chfw-lang' ),
                'desc'         => __( 'Pick a dropdown Color ', 'chfw-lang' ),
                'default'      => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-megaMenu_BoxShadow_color_'],
                'validate'     => 'color',
                'force_output' => true,
                'required'     =>
                    array(

                        array( 'top-navbar_dropdownBoxShadowEnableDisable_' . $skinName, '=', 1 )
                    ),
            ),

            array(
                'id'   => 'top-navbar_border_' . $skinName,
                'type' => 'border',

                'title'    => __( 'Top Navbar Menu Border Option', 'chfw-lang' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'output'   => array( '.site-header' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'border-color'  => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_border_']['border-color'],
                    'border-style'  => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_border_']['border-style'],
                    'border-bottom' => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_border_']['border-bottom'],
                ),

            ),
            array(
                'id'             => 'top-navbar_typography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Top NavBar Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => false,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => false,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_typography_']['color'],
                    'font-style'     => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_typography_']['font-style'],
                    'font-family'    => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_typography_']['font-family'],
                    'font-size'      => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_typography_']['font-size'],
                    'line-height'    => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_typography_']['line-height'],
                    'text-transform' => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_typography_']['text-transform'],


                ),

            ),


            array(
                'id'       => 'top-navbar_text_shadow_color_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Top Navbar Text Shadow Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_text_shadow_color_'],
                'validate' => 'color',

            ),


            array(
                'id'       => 'top-navbar_icon_color_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Top Navbar Icon Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->TopNavBarSetting_DefaultConfig[ $skinName ]['top-navbar_icon_color_'],
                'validate' => 'color',

            ),
        );
        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function HeaderSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(




            array(
                'id'      => 'shop_mini_cart_enable_disable_' . $skinName,
                'type'    => 'switch',
                'title'   => __( 'Hide the top mini cart in view?', 'chfw-lang' ),
                'default' => 1,
                'on'      => 'Enable',
                'off'     => 'Disable',

            ),

            array(
                'id'   => 'header_center_info' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Header Center Setting', 'chfw-lang' ) . '</h3>',
            ),

            array(
                'id'       => 'headerCenter_bgcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Header Center Background Color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['headerCenter_bgcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'             => 'HeaderCenter_Typography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Header Center Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => false,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => false,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => false,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Header Center Typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'       => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_Typography_']['color'],
                    'font-style'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_Typography_']['font-style'],
                    'font-family' => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_Typography_']['font-family'],
                    'font-size'   => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_Typography_']['font-size'],
                    'line-height' => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_Typography_']['line-height'],

                ),

            ),

            array(
                'id'       => 'HeaderCenter_border_' . $skinName,
                'type'     => 'border',
                'left'     => false,
                'right'    => false,
                'top'      => false,
                'title'    => __( 'Header Center Border Option', 'chfw-lang' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'output'   => array( '.site-header' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'border-color'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_border_']['border-color'],
                    'border-style'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_border_']['border-style'],
                    'border-bottom' => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_border_']['border-bottom'],
                ),

            ),

            array(
                'id' => 'headerCenter_makeAnAppoinment_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw' => '<h3 class="redux_info">' . __('Make An Appointment Button', 'chfw-lang') . '</h3>',

            ),

            array(
                'id' => 'headerCenter_makeAnAppoinmentBgColor_' . $skinName,
                'type' => 'color',
                'title' => __('Background Color', 'chfw-lang'),
                'default' => $this->HeaderSetting_DefaultConfig[$skinName]['headerCenter_makeAnAppoinmentBgColor_'],
                'validate' => 'color',
                'required' => array(),
            ),

            array(
                'id' => 'headerCenter_makeAnAppoinment_Button_' . $skinName,
                'type' => 'typography',
                'title' => __('Typography', 'chfw-lang'),
                'google' => true,
                'font-backup' => false,
                'font-style' => true,
                'subsets' => false,
                'font-size' => true,
                'line-height' => false,
                'word-spacing' => false,
                'letter-spacing' => false,
                'color' => true,
                'preview' => true,
                'all_styles' => true,
                'text-align' => false,
                'text-transform' => true,
                'output' => array(
                    'h2.site-description'
                ),
                'compiler' => array(
                    'h2.site-description-compiler'
                ),
                'units' => 'px',
                'desc' => __('Customize posts and pages typography .', 'chfw-lang'),
                'default' => array(
                    'color' => $this->HeaderSetting_DefaultConfig[$skinName]['headerCenter_makeAnAppoinment_Button_']['color'],
                    'font-style' => $this->HeaderSetting_DefaultConfig[$skinName]['headerCenter_makeAnAppoinment_Button_']['font-style'],
                    'font-weight' => $this->HeaderSetting_DefaultConfig[$skinName]['headerCenter_makeAnAppoinment_Button_']['font-weight'],
                    'font-family' => $this->HeaderSetting_DefaultConfig[$skinName]['headerCenter_makeAnAppoinment_Button_']['font-family'],
                    'font-size' => $this->HeaderSetting_DefaultConfig[$skinName]['headerCenter_makeAnAppoinment_Button_']['font-size'],
                    'text-transform' => $this->HeaderSetting_DefaultConfig[$skinName]['headerCenter_makeAnAppoinment_Button_']['text-transform'],
                ),
            ),


            array(
                'id'   => 'headerCenter_siearchButton_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Header Center Search', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'       => 'headerCenter_siearchButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Search Button Background Color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['headerCenter_siearchButtonBgColor_'],
                'validate' => 'color',
                'required' => array(),
            ),

            array(
                'id'       => 'headerCenter_searchButtonBorder_' . $skinName,
                'type'     => 'border',
                'title'    => __( 'Search Button Option', 'chfw-lang' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'border-color'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['headerCenter_searchButtonBorder_']['border-color'],
                    'border-style'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['headerCenter_searchButtonBorder_']['border-style'],
                    'border-bottom' => $this->HeaderSetting_DefaultConfig[ $skinName ]['headerCenter_searchButtonBorder_']['border-bottom'],
                ),

            ),

            array(
                'id'             => 'HeaderCenter_SearchButtonTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Search Button Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => false,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => false,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => false,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Search Button Typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'       => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_SearchButtonTypography_']['color'],
                    'font-style'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_SearchButtonTypography_']['font-style'],
                    'font-family' => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_SearchButtonTypography_']['font-family'],
                    'font-size'   => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_SearchButtonTypography_']['font-size'],
                    'line-height' => $this->HeaderSetting_DefaultConfig[ $skinName ]['HeaderCenter_SearchButtonTypography_']['line-height'],

                ),
            ),

            array(
                'id'   => 'header_minicart_info' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Header Mini cart setting', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'       => 'header_minicart_cartBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_cartBgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'header_minicart_cartCounterBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Counter background color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_cartCounterBgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'header_minicart_cartCountertextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Counter text color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_cartCountertextColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'header_minicart_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Inside  background color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_BgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'header_minicart_Text_and_Link_Color_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Text and link color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_Text_and_Link_Color_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'header_minicart_Border_' . $skinName,
                'type'     => 'border',
                'left'     => false,
                'right'    => false,
                'top'      => false,
                'title'    => __( 'Button Option', 'chfw-lang' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'output'   => array( '.site-header' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'border-color'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_Border_']['border-color'],
                    'border-style'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_Border_']['border-style'],
                    'border-bottom' => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_Border_']['border-bottom'],
                ),
            ),

            array(
                'id'       => 'header_minicart_editCartButton_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Edit cart background color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_editCartButton_BgColor_'],
                'validate' => 'color',
            ),


            array(
                'id'       => 'header_minicart_editCartButton_textColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Text color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_editCartButton_textColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'header_minicart_checkoutButton_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Checkout button background color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_checkoutButton_BgColor_'],
                'validate' => 'color',
            ),

            array(
                'id'       => 'header_minicart_checkoutButton_textColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Checkout button text color', 'chfw-lang' ),
                'default'  => $this->HeaderSetting_DefaultConfig[ $skinName ]['header_minicart_checkoutButton_textColor_'],
                'validate' => 'color',
            ),

        );
        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function MenuSettings_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(

            array(
                'id'    => 'megaMenu_menu_arrow_' . $skinName,
                'type'  => 'select',
                'title' => __( 'Header menu arrow', 'chfw-lang' ),

                'options' => array(
                    'hide' => 'Hide',
                    'show' => 'Show'
                ),
                'default' => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_menu_arrow_'],

            ),

            array(
                'id'    => 'megaMenu_submenu_arrow_' . $skinName,
                'type'  => 'select',
                'title' => __( 'Header sub menu arrow', 'chfw-lang' ),

                'options' => array(
                    'hide' => 'Hide',
                    'show' => 'Show'
                ),
                'default' => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_menu_arrow_'],

            ),
            array(
                'id'      => 'megaMenu_animation_type_' . $skinName,
                'type'    => 'select',
                'title'   => __( 'Mega menu animation type', 'chfw-lang' ),
                'options' => array(
                    'fadein'  => 'FadeInUp Drop-Down Menu',
                    'slider'  => 'Slider',
                    'nothing' => 'Nothing'
                ),
                'default' => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_animation_type_'],

            ),


            array(
                'id'   => 'theme_dropdown_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Mega Menu Setting', 'chfw-lang' ) . '</h3>INFO <br><img src="' . esc_url( get_stylesheet_directory_uri() ) . '/assets/images/navbar_menu_info.png">',

            ),


            array(
                'id'       => 'megaMenu_backgroundcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a background color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_backgroundcolor_'],
                'validate' => 'color',

            ),


            array(
                'id'       => 'megaMenu_backgroundHoverColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Hover Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a background color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_backgroundHoverColor_'],
                'validate' => 'color',
            ),

            array(
                'id'       => 'megaMenu_textcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Text Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a text color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_textcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'megaMenu_textHoverColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Text Hover Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a hover text color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_textHoverColor_'],
                'validate' => 'color',


            ),
            array(
                'id'             => 'megaMenu_Typography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'NavBar Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => false,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => false,
                'preview'        => false,
                // Disable the previewer
                'all_styles'     => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(

                    'line-height'     => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_Typography_']['line-height'],
                    'font-style'     => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_Typography_']['font-style'],
                    'font-family'    => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_Typography_']['font-family'],
                    'font-size'      => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_Typography_']['font-size'],
                    'text-transform' => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_Typography_']['text-transform'],
                ),

            ),


            /*array(
					'id'       => 'navbar_dropdownBoxShadowEnableDisable_'.$skinName,
					'type'     => 'switch',
					'title'    => __('Navbar Dropdown Box Shadow', 'chfw-lang'),
					'desc'     => __('You can disable / enable', 'chfw-lang'),
					'default'  => '1',
					'on'       => 'Enabled',
					'off'      => 'Disabled',
					'required' => array(
						array('skin_selected', '=', $skinName ),
					),
				),


				array(
					'id'           => 'megaMenu_BoxShadow_color_'.$skinName,
					'type'         => 'color',
					'title'        => __('Box Shadow Color Option', 'chfw-lang'),
					'desc'         => __('Pick a dropdown Color ', 'chfw-lang'),
					'default'      => 'transparent',
					'validate'     => 'color',
					'force_output' => true,
					'required'     =>
							array(
									array('skin_selected', '=', 'redSkin'),
									array('navbar_dropdownBoxShadowEnableDisable_'.$skinName, '=', 'on')
							)
					'required'     => array(
						array('skin_selected', '=', $skinName ),
					)
				),*/
            array(
                'id'       => 'megaMenu_topMenuBorderOption_' . $skinName,
                'type'     => 'border',
                'title'    => __( 'Mega Menu Border Option', 'chfw-lang' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'output'   => array( '.site-header' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'border-color'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_topMenuBorderOption_']['border-color'],
                    'border-style'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_topMenuBorderOption_']['border-style'],
                    'border-bottom' => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_topMenuBorderOption_']['border-bottom'],
                ),

            ),

            array(
                'id'   => 'megaMenu_insideMenu_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Navbar Dropdown Setting', 'chfw-lang' ) . '</h3>',

            ),


            array(
                'id'             => 'megaMenu_insideMenuTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'NavBar Dropdown Menu Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => false,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => false,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => false,
                'preview'        => false,
                // Disable the previewer
                'all_styles'     => false,
                'line-height'    => false,
                'font-weight'    => false,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'font-family'    => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenuTypography_']['font-family'],
                    'text-transform' => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenuTypography_']['text-transform'],
                ),

            ),

            array(
                'id'       => 'megaMenu_insideMenu_backgroundcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Dropdown Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a dropdown Background Color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_backgroundcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'megaMenu_insideMenu_Color' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Dropdown Text Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a dropdown text color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_Color'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'megaMenu_insideMenu_TextHoverColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Dropdown Text Hover Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a dropdown text hover color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_TextHoverColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'megaMenu_insideMenu_ActiveBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Dropdown Active Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a dropdown background color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_ActiveBgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'megaMenu_insideMenu_ActiveTextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Navbar Dropdown Active Text Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a dropdown active color', 'chfw-lang' ),
                'default'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_ActiveTextColor_'],
                'validate' => 'color',

            ),


            array(
                'id'       => 'megaMenu_insideMenu_borderOption_' . $skinName,
                'type'     => 'border',
                'title'    => __( 'Dropdown Menu Border Option', 'chfw-lang' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'output'   => array( '.yamm .dropdown-menu' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'border-color'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_borderOption_']['border-color'],
                    'border-style'  => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_borderOption_']['border-style'],
                    'border-bottom' => $this->MenuSettings_DefaultConfig[ $skinName ]['megaMenu_insideMenu_borderOption_']['border-bottom'],
                ),

            ),

            array(
                'id'       => 'dropdown_menu-border-bottom_text_option_' . $skinName,
                'type'     => 'border',
                'left'     => false,
                'right'    => false,
                'top'      => false,
                'title'    => __( 'Dropdown Menu Text Border Bottom Option', 'chfw-lang' ),
                'subtitle' => __( 'Only color validation can be done on this field type', 'chfw-lang' ),
                'desc'     => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default'  => array(
                    'border-color'  => $this->MenuSettings_DefaultConfig[ $skinName ]['dropdown_menu-border-bottom_text_option_']['border-color'],
                    'border-style'  => $this->MenuSettings_DefaultConfig[ $skinName ]['dropdown_menu-border-bottom_text_option_']['border-style'],
                    'border-bottom' => $this->MenuSettings_DefaultConfig[ $skinName ]['dropdown_menu-border-bottom_text_option_']['border-bottom'],
                ),

            ),
        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function MobileMenuSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(

            array(
                'id'       => 'MobileMenu_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->MobileMenuSetting_DefaultConfig[ $skinName ]['MobileMenu_BgColor_'],
                'validate' => 'color',

            ),


            array(
                'id'       => 'MobileMenu_Submenu_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Sub menu background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->MobileMenuSetting_DefaultConfig[ $skinName ]['MobileMenu_BgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'MobileMenu_linkColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Link Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->MobileMenuSetting_DefaultConfig[ $skinName ]['MobileMenu_linkColor_'],
                'validate' => 'color',

            ),


            array(
                'id'       => 'MobileMenu_arrowColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Arrow Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->MobileMenuSetting_DefaultConfig[ $skinName ]['MobileMenu_arrowColor_'],
                'validate' => 'color',

            ),


            array(
                'id'   => 'MobileMenu_searchButton_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Mobile Menu search', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'       => 'MobileMenu_searchButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Search Button Background Color', 'chfw-lang' ),
                'default'  => $this->MobileMenuSetting_DefaultConfig[ $skinName ]['MobileMenu_searchButtonBgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'MobileMenu_searchButtonBorderColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Canvas bar Search Border Color', 'chfw-lang' ),
                'default'  => $this->MobileMenuSetting_DefaultConfig[ $skinName ]['MobileMenu_searchButtonBorderColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'MobileMenu_searchButtonTextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Search Button Text Color', 'chfw-lang' ),
                'default'  => $this->MobileMenuSetting_DefaultConfig[ $skinName ]['MobileMenu_searchButtonTextColor_'],
                'validate' => 'color',

            ),


        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function OutSideSidebarSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(

            array(
                'id'       => 'OutSideSidebar_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->OutSideSidebarSetting_DefaultConfig[ $skinName ]['OutSideSidebar_BgColor_'],
                'validate' => 'color',

            ),


            array(
                'id'      => 'OutSideSidebar_social_EnableDisable_' . $skinName,
                'type'    => 'switch',
                'title'   => __( 'Social Enable Disable', 'chfw-lang' ),
                'desc'    => __( 'You can disable / enable', 'chfw-lang' ),
                'default' => $this->OutSideSidebarSetting_DefaultConfig[ $skinName ]['OutSideSidebar_social_EnableDisable_'],
                'on'      => 'Enabled',
                'off'     => 'Disabled',

            ),


            array(
                'id'       => 'OutSideSidebar_linkColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Link Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->OutSideSidebarSetting_DefaultConfig[ $skinName ]['OutSideSidebar_linkColor_'],
                'validate' => 'color',

            ),


            array(
                'id'       => 'OutSideSidebar_arrowColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Arrow Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->OutSideSidebarSetting_DefaultConfig[ $skinName ]['OutSideSidebar_arrowColor_'],
                'validate' => 'color',

            ),


            array(
                'id'   => 'OutSideSidebar_searchButton_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Canvas bar search', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'       => 'OutSideSidebar_searchButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Button Background Color', 'chfw-lang' ),
                'default'  => $this->OutSideSidebarSetting_DefaultConfig[ $skinName ]['OutSideSidebar_searchButtonBgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'OutSideSidebar_searchButtonBorderColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Border Color', 'chfw-lang' ),
                'default'  => $this->OutSideSidebarSetting_DefaultConfig[ $skinName ]['OutSideSidebar_searchButtonBorderColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'OutSideSidebar_searchButtonTextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Button Text Color', 'chfw-lang' ),
                'default'  => $this->OutSideSidebarSetting_DefaultConfig[ $skinName ]['OutSideSidebar_searchButtonTextColor_'],
                'validate' => 'color',

            ),


        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function BlogPostListStyleSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(

            array(
                'id'             => 'BlogPostTitleStyleTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Post Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => true,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,

                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,

                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostTitleStyleTypography_']['color'],
                    'font-style'     => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostTitleStyleTypography_']['font-style'],
                    'font-family'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostTitleStyleTypography_']['font-family'],
                    'font-size'      => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostTitleStyleTypography_']['font-size'],
                    'line-height'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostTitleStyleTypography_']['line-height'],
                    'text-transform' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostTitleStyleTypography_']['text-transform'],
                ),


            ),

            array(
                'id'             => 'BlogPostStyleInfoTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Post Info Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleInfoTypography_']['color'],
                    'font-style'     => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleInfoTypography_']['font-style'],
                    'font-family'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleInfoTypography_']['font-family'],
                    'font-size'      => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleInfoTypography_']['font-size'],
                    'line-height'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleInfoTypography_']['line-height'],
                    'text-transform' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleInfoTypography_']['text-transform'],
                ),


            ),

            array(
                'id'             => 'BlogPostStyleTextTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Post Description  Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleTextTypography_']['color'],
                    'font-style'     => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleTextTypography_']['font-style'],
                    'font-family'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleTextTypography_']['font-family'],
                    'font-size'      => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleTextTypography_']['font-size'],
                    'line-height'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleTextTypography_']['line-height'],
                    'text-transform' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleTextTypography_']['text-transform'],
                ),

            ),


            array(
                'id'   => 'theme_settingPost_List_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Post List Setting', 'chfw-lang' ) . '</h3>',

            ),


            array(
                'id'       => 'PostStyleListBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleListBgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'      => 'PostStyleListBoxShadow_' . $skinName,
                'type'    => 'switch',
                'title'   => __( 'BoxShadow', 'chfw-lang' ),
                'desc'    => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleListBoxShadow_'],
                'on'      => 'Enabled',
                'off'     => 'Disabled',

            ),

            array(
                'id'            => 'PostStyleListBorderRadius_' . $skinName,
                'type'          => 'slider',
                'title'         => __( 'Border Radius', 'chfw-lang' ),
                'default'       => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleListBorderRadius_'],
                'min'           => 0,
                'max'           => 100,
                'step'          => 1,
                'display_value' => 'text',

            ),


            array(
                'id'      => 'PostStyleListBorder_' . $skinName,
                'type'    => 'border',
                'left'    => true,
                'right'   => true,
                'top'     => true,
                'bottom'  => true,
                'title'   => __( 'Style Border Option', 'chfw-lang' ),
                'output'  => array( '.site-header' ),
                'desc'    => __( 'This is the description field, again good for additional info.', 'chfw-lang' ),
                'default' => array(
                    'border-color'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleListBorder_']['border-color'],
                    'border-style'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleListBorder_']['border-style'],
                    'border-bottom' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleListBorder_']['border-bottom'],
                ),

            ),

            array(
                'id'       => 'PostStyleListSocialBarBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'SocialBar Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleListSocialBarBgColor_'],
                'validate' => 'color',


            ),
            array(
                'id'   => 'theme_settingBlogPostStyleTags_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Blog Post List Style Setting [TAGS]', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'             => 'PostStyleList_TagTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagTypography_']['color'],
                    'font-style'     => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagTypography_']['font-style'],
                    'font-family'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagTypography_']['font-family'],
                    'font-size'      => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagTypography_']['font-size'],
                    'line-height'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagTypography_']['line-height'],
                    'text-transform' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagTypography_']['text-transform'],
                ),

            ),

            array(
                'id'             => 'PostStyleList_TagHoverTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Typography (Hover)', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagHoverTypography_']['color'],
                    'font-style'     => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagHoverTypography_']['font-style'],
                    'font-family'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagHoverTypography_']['font-family'],
                    'font-size'      => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagHoverTypography_']['font-size'],
                    'line-height'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagHoverTypography_']['line-height'],
                    'text-transform' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagHoverTypography_']['text-transform'],
                ),

            ),
            array(
                'id'       => 'PostStyleList_TagsBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagsBgColor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'PostStyleList_TagsHoverBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Hover Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_TagsHoverBgColor_'],
                'validate' => 'color',

            ),


            array(
                'id'            => 'PostStyleList_SocialBarBorder_' . $skinName,
                'type'          => 'border',
                'border-bottom' => true,
                'border-left'   => true,
                'border-right'  => true,
                'border-top'    => true,
                'title'         => __( 'Border', 'chfw-lang' ),
                'desc'          => __( 'Pick a color', 'chfw-lang' ),
                'output'        => array( '.site-header' ),
                'default'       => array(
                    'border-color'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_SocialBarBorder_']['border-color'],
                    'border-style'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_SocialBarBorder_']['border-style'],
                    'border-bottom' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_SocialBarBorder_']['border-bottom'],
                    'border-left'   => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_SocialBarBorder_']['border-left'],
                    'border-right'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_SocialBarBorder_']['border-right'],
                    'border-top'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_SocialBarBorder_']['border-top'],
                ),

            ),


            array(
                'id'   => 'PostStyleList_ReadMoreButton_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Read More Button Settings', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'       => 'PostStyleList_ReadMoreButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Read More Button Background Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_ReadMoreButtonBgColor_'],
                'validate' => 'color',
            ),


            array(
                'id'   => 'PostStyleList_ReadMoreButtonBgHoverColor_' . $skinName,
                'type' => 'color',

                'title'    => __( 'Read More Button Hover Background  Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['PostStyleList_ReadMoreButtonBgHoverColor_'],
                'validate' => 'color',
            ),

            array(
                'id'             => 'BlogPostStyleReadMoreButtonTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Read More Button Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,

                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleReadMoreButtonTypography_']['color'],
                    'font-style'     => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleReadMoreButtonTypography_']['font-style'],
                    'font-family'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleReadMoreButtonTypography_']['font-family'],
                    'font-size'      => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleReadMoreButtonTypography_']['font-size'],
                    'line-height'    => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleReadMoreButtonTypography_']['line-height'],
                    'text-transform' => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleReadMoreButtonTypography_']['text-transform'],
                ),
            ),

            array(
                'id'       => 'BlogPostStyleReadMoreButtonHoverTypography_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Read More Button Hover Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->BlogPostListStyleSetting_DefaultConfig[ $skinName ]['BlogPostStyleReadMoreButtonHoverTypography_'],
                'validate' => 'color',
            ),

        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function SidebarSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(


            array(
                'id'       => 'sidebar_view_model_' . $skinName,
                'type'     => 'image_select',
                'title'    => __( 'Sidebar model', 'chfw-lang' ),
                'subtitle' => __( 'Select sidebar model ,Chooose between model', 'chfw-lang' ),
                'options'  => array(
                    'unboxed'       => array(
                        'alt' => __( 'Unboxed', 'chfw-lang' ),
                        'img' => ReduxFramework::$_url . 'assets/img/sidebar/unboxed.png'
                    ),
                    'boxed-content' => array(
                        'alt' => __( 'Boxed', 'chfw-lang' ),
                        'img' => ReduxFramework::$_url . 'assets/img/sidebar/boxed.png'
                    ),

                ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_view_model_'],


            ),

            array(
                'id'       => 'sidebar_widget_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_BgColor_'],
                'validate' => 'color',

            ),


            array(
                'id'      => 'sidebar_widget_Border_' . $skinName,
                'type'    => 'border',
                'all'     => true,
                'title'   => __( 'Border Color', 'chfw-lang' ),
                'desc'    => __( 'Pick a color', 'chfw-lang' ),
                'output'  => array( '.site-header' ),
                'default' => array(
                    'border-color'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Border_']['border-color'],
                    'border-style'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Border_']['border-style'],
                    'border-bottom' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Border_']['border-bottom'],
                    'border-left'   => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Border_']['border-left'],
                    'border-right'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Border_']['border-right'],
                    'border-top'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Border_']['border-top'],
                ),

            ),


            array(
                'id'      => 'sidebar_widgetBoxShadowEnableDisable_' . $skinName,
                'type'    => 'switch',
                'title'   => __( 'Box Shadow Enable Disable', 'chfw-lang' ),
                'desc'    => __( 'You can disable / enable', 'chfw-lang' ),
                'default' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widgetBoxShadowEnableDisable_'],
                'on'      => 'Enabled',
                'off'     => 'Disabled',

            ),

            array(
                'id'      => 'sidebar_BoxShadow_BgColor_' . $skinName,
                'type'    => 'color_rgba',
                'title'   => __( 'Box Shadow Background Color', 'chfw-lang' ),
                //'default'  => 'rgba(0,0,0,0.85)',
                'default' => array(
                    'rgba'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_BoxShadow_BgColor_']['rgba'],
                    'color' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_BoxShadow_BgColor_']['color'],
                    'alpha' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_BoxShadow_BgColor_']['alpha'],
                ),
                'options' => array(
                    'show_input'             => true,
                    'show_initial'           => true,
                    'show_alpha'             => true,
                    'show_palette'           => true,
                    'show_palette_only'      => false,
                    'show_selection_palette' => true,
                    'max_palette_size'       => 10,
                    'allow_empty'            => true,
                    'clickout_fires_change'  => false,
                    'choose_text'            => 'Choose',
                    'cancel_text'            => 'Cancel',
                    'show_buttons'           => true,
                    'use_extended_classes'   => true,
                    'palette'                => null,  // show default
                    'input_text'             => 'Select Color'
                ),

            ),

            array(
                'id'       => 'sidebar_widget_Linkcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Link Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Linkcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'sidebar_widget_Textcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Text Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_Textcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'   => 'theme_sidebar_title_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Sidebar Title Info', 'chfw-lang' ) . '</h3>',

            ),
            array(
                'id'       => 'sidebar_widget_title_selected' . $skinName,
                'type'     => 'image_select',
                'title'    => __( 'Widget Title skin', 'chfw-lang' ),
                'subtitle' => __( 'Select Widget Title skin ,Chooose between skin', 'chfw-lang' ),
                'options'  => array(
                    'border_bottom_bg_widget' => array(
                        'alt' => 'Border bottom background widget ',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/border_bottom_bg_widget.png'
                    ),
                    'border_bottom_widget'    => array(
                        'alt' => 'border bottom widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/border_bottom_widget.png'
                    ),
                    'line_left_widget'        => array(
                        'alt' => 'line_left_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/line_left_widget.png'
                    ),
                    'line_transparant_widget' => array(
                        'alt' => 'line_transparant_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/line_transparant_widget.png'
                    ),
                    'line_widget'             => array(
                        'alt' => 'line_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/line_widget.png'
                    ),
                    'colored_widget'          => array(
                        'alt' => 'colored_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/colored_widget.png'
                    ),
                    'colored_two_widget'      => array(
                        'alt' => 'colored_two_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/colored_two_widget.png'
                    ),
                ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_selected'],


            ),
//sidebar widget title typography my application setting
            array(
                'id'             => 'sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Widget Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget']['font-size'],
                    'text-align'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget']['text-align'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_bg_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        /*	array(
									'sidebar_widget_title_options_selected',
									'=',
									'border_bottom_bg_widget'
								),*/
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            array(
                                'border_bottom_bg_widget',
                            )
                        ),
                    )
            ),
            array(
                'id'             => 'sidebar_widget_title_typography_custom_skin_border_bottom_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Widget Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_widget']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_widget']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_widget']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_widget']['font-size'],
                    'text-align'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_widget']['text-align'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_widget']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_border_bottom_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            'border_bottom_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'sidebar_widget_title_typography_custom_skin_line_left_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Widget Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),

                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_left_widget']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_left_widget']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_left_widget']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_left_widget']['font-size'],
                    'text-align'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_left_widget']['text-align'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_left_widget']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_left_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            'line_left_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'sidebar_widget_title_typography_custom_skin_line_transparant_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Widget Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_transparant_widget']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_transparant_widget']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_transparant_widget']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_transparant_widget']['font-size'],
                    'text-align'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_transparant_widget']['text-align'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_transparant_widget']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_transparant_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            'line_transparant_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'sidebar_widget_title_typography_custom_skin_line_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Widget Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_widget']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_widget']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_widget']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_widget']['font-size'],
                    'text-align'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_widget']['text-align'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_widget']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_line_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            'line_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'sidebar_widget_title_typography_custom_skin_colored_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Widget Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_widget']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_widget']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_widget']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_widget']['font-size'],
                    'text-align'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_widget']['text-align'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_widget']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            'colored_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'sidebar_widget_title_typography_custom_skin_colored_two_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Widget Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_two_widget']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_two_widget']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_two_widget']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_two_widget']['font-size'],
                    'text-align'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_two_widget']['text-align'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_two_widget']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_typography_custom_skin_colored_two_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            'colored_two_widget',

                        ),
                    )
            ),

            array(
                'id'       => 'sidebar_widget_title_BgColor_first_custom_skin_border_bottom_bg_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_BgColor_first_custom_skin_border_bottom_bg_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        'border_bottom_bg_widget',

                    ),
                )
            ),

            array(
                'id'       => 'sidebar_widget_title_BgColor_first_custom_skin_colored_two_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_BgColor_first_custom_skin_colored_two_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        'colored_two_widget',

                    ),
                )
            ),
            array(
                'id'       => 'sidebar_widget_title_BgColor_first_custom_skin_colored_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_BgColor_first_custom_skin_colored_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        'colored_widget',

                    ),
                )
            ),
            array(
                'id'       => 'sidebar_widget_title_BgColor_first_custom_skin_line_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_BgColor_first_custom_skin_line_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        'line_widget',

                    ),
                )
            ),
            array(
                'id'       => 'sidebar_widget_title_BgColor_first_custom_skin_line_left_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_BgColor_first_custom_skin_line_left_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        'line_left_widget',

                    ),
                )
            ),
//sidebar widget title BgColor_first ***end
            //sidebar widget title BgColor_second
            array(
                'id'       => 'sidebar_widget_title_BgColor_second_border_bottom_bg_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title Second Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_BgColor_second_border_bottom_bg_widget'],
                'validate' => 'color',
                'required' =>
                    array(

                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        'border_bottom_bg_widget'

                    )

            ),
            array(
                'id'       => 'sidebar_widget_title_BgColor_second_border_bottom_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title Second Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_BgColor_second_border_bottom_widget'],
                'validate' => 'color',
                'required' =>
                    array(
                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        'border_bottom_widget'
                    ),

            ),
//sidebar widget title BgColor_second
            array(
                'id'       => 'sidebar_widget_title_LineColor' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title Line Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_LineColor'],
                'validate' => 'color',
                'required' =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            array( 'line_left_widget', 'line_widget' )
                        ),
                    )
            ),

            array(
                'id'       => 'sidebar_widget_title_colored_widgetTopBorderColor' . $skinName,
                'type'     => 'color',
                'title'    => __( 'widget Top Border Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_colored_widgetTopBorderColor'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'sidebar_widget_title_selected' . $skinName,
                        '=',
                        array( 'colored_two_widget' )
                    ),
                )
            ),

            array(
                'id'       => 'sidebar_widget_title_borderColor' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Widget Title Border Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_borderColor'],
                'validate' => 'color',
                'required' =>
                    array(
                        array(
                            'sidebar_widget_title_selected' . $skinName,
                            '=',
                            array( 'border_bottom_bg_widget', 'border_bottom_widget' )
                        ),

                    )
            ),

//Sidebar Tag
            array(
                'id'   => 'theme_sidebar_tags_widget_setting_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Sidebar Tag Widget setting', 'chfw-lang' ) . '</h3>',

            ),
            array(
                'id'       => 'sidebar_widget_title_TagbgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Tag Widget Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_TagbgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'sidebar_widget_title_Tag_HoverbgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Tag Widget Background Hover Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_Tag_HoverbgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'            => 'sidebar_widget_TagsWidgetBorder_' . $skinName,
                'type'          => 'border',
                'border-bottom' => true,
                'border-left'   => true,
                'border-right'  => true,
                'border-top'    => true,
                'title'         => __( 'Tag Widget Widget Border', 'chfw-lang' ),
                'desc'          => __( 'Pick a color', 'chfw-lang' ),
                'output'        => array( '.site-header' ),
                'default'       => array(
                    'border-color'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_TagsWidgetBorder_']['border-color'],
                    'border-style'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_TagsWidgetBorder_']['border-style'],
                    'border-bottom' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_TagsWidgetBorder_']['border-bottom'],
                    'border-left'   => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_TagsWidgetBorder_']['border-left'],
                    'border-right'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_TagsWidgetBorder_']['border-right'],
                    'border-top'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_TagsWidgetBorder_']['border-top'],
                ),

            ),
            array(
                'id'             => 'sidebar_widget_title_TagWidgetTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Tag Widget Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_TagWidgetTypography_']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_TagWidgetTypography_']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_TagWidgetTypography_']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_TagWidgetTypography_']['font-size'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_TagWidgetTypography_']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_TagWidgetTypography_']['text-transform'],
                ),

            ),
            array(
                'id'             => 'sidebar_widget_title_WidgetHoverTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Tag Widget Hover Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_WidgetHoverTypography_']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_WidgetHoverTypography_']['font-style'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_WidgetHoverTypography_']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_WidgetHoverTypography_']['font-size'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_WidgetHoverTypography_']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_title_WidgetHoverTypography_']['text-transform'],
                ),

            ),

            array(
                'id'   => 'theme_sidebar_serachButton_setting_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Sidebar Search Button', 'chfw-lang' ) . '</h3>',

            ),
            array(
                'id'       => 'sidebar_widget_searchButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Search Button Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButtonBgColor_'],
                /*'default'  => '#dd3333',*/
                'validate' => 'color',


            ),
            array(
                'id'             => 'sidebar_widget_searchButton_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Search Button Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButton_']['color'],
                    'font-style'     => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButton_']['font-style'],
                    'font-weight'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButton_']['font-weight'],
                    'font-family'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButton_']['font-family'],
                    'font-size'      => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButton_']['font-size'],
                    'line-height'    => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButton_']['line-height'],
                    'text-transform' => $this->SidebarSetting_DefaultConfig[ $skinName ]['sidebar_widget_searchButton_']['text-transform'],
                ),

            ),


        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }




    public function ShopSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(

            array(
                'id'       => 'Shop_product_image_bgcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Product image background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for product image background color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['Shop_product_image_bgcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'Shop_sale_badge_textcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Badge text color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for sale badge background color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['Shop_sale_badge_textcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'Shop_sale_badge_bgcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Sale badge background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for sale badge background color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['Shop_sale_badge_bgcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'Shop_outofstock_badge_bgcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Out of stock badge background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for out of stock background color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['Shop_outofstock_badge_bgcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'Shop_new_badge_bgcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'New badge background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for new badge background color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['Shop_new_badge_bgcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'Shop_discountPercentage_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Discount percentage background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for discount percentage background color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['Shop_discountPercentage_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'Shop_quickview_bgcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Quickview background color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color for Quickview background color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['Shop_quickview_bgcolor_'],
                'validate' => 'color',
            ),

            array(
                'id'   => 'shop_options_AddToCart_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Add To Cart Style', 'chfw-lang' ) . '</h3>',

            ),
            array(
                'id'       => 'AddToCart_btn_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Add To Cart button Background Color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['AddToCart_btn_BgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'AddToCart_btn_TextColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Add To Cart button Text Color', 'chfw-lang' ),
                'default'  => $this->ShopSetting_DefaultConfig[ $skinName ]['AddToCart_btn_TextColor_'],
                'validate' => 'color',

            ),

        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;
    }

    public function FooterSetting_( $sections ) {
        $skinName = $this->skin_Name;
        $Settings = array(




            array(
                'id'       => 'footer_widget_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_BgColor_'],
                'validate' => 'color',


            ),


            array(
                'id'           => 'footer_widget_Border_' . $skinName,
                'type'         => 'border',
                'all'          => true,
                'border-style' => true,
                'border-color' => true,
                'title'        => __( 'Border Color ', 'chfw-lang' ),
                'desc'         => __( 'Pick a color', 'chfw-lang' ),
                'output'       => array( '.site-header' ),
                'default'      => array(
                    'border-color'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Border_']['border-color'],
                    'border-style'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Border_']['border-style'],
                    'border-bottom' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Border_']['border-bottom'],
                    'border-left'   => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Border_']['border-left'],
                    'border-right'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Border_']['border-right'],
                    'border-top'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Border_']['border-top'],
                ),

            ),


            array(
                'id'       => 'footer_widget_Linkcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Link Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Linkcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'footer_widget_Textcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Text Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_Textcolor_'],
                'validate' => 'color',

            ),


            array(
                'id'   => 'theme_Footer_title_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Footer Title Info', 'chfw-lang' ) . '</h3>',

            ),
            array(
                'id'       => 'footer_widget_title_selected' . $skinName,
                'type'     => 'image_select',
                'title'    => __( 'Title skin', 'chfw-lang' ),
                'subtitle' => __( 'Select Widget Title skin ,Chooose between skin ', 'chfw-lang' ),
                'options'  => array(
                    'border_bottom_bg_widget' => array(
                        'alt' => 'Border bottom background widget ',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/border_bottom_bg_widget.png'
                    ),
                    'border_bottom_widget'    => array(
                        'alt' => 'border bottom widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/border_bottom_widget.png'
                    ),
                    'line_left_widget'        => array(
                        'alt' => 'line_left_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/line_left_widget.png'
                    ),
                    'line_transparant_widget' => array(
                        'alt' => 'line_transparant_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/line_transparant_widget.png'
                    ),
                    'line_widget'             => array(
                        'alt' => 'line_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/line_widget.png'
                    ),
                    'colored_widget'          => array(
                        'alt' => 'colored_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/colored_widget.png'
                    ),
                    'colored_two_widget'      => array(
                        'alt' => 'colored_two_widget',
                        'img' => ReduxFramework::$_url . 'assets/img/widget/colored_two_widget.png'
                    ),
                ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_selected'],


            ),
//Footer widget title typography my application setting
            array(
                'id'             => 'footer_widget_title_typography_custom_skin_border_bottom_bg_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_bg_widget']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_bg_widget']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_bg_widget']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_bg_widget']['font-size'],
                    'text-align'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_bg_widget']['text-align'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_bg_widget']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_bg_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        /*	array(
											'footer_widget_title_options_selected',
											'=',
											'border_bottom_bg_widget'
										),*/
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            array(
                                'border_bottom_bg_widget',
                            )
                        ),
                    )
            ),
            array(
                'id'             => 'footer_widget_title_typography_custom_skin_border_bottom_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_widget']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_widget']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_widget']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_widget']['font-size'],
                    'text-align'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_widget']['text-align'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_widget']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_border_bottom_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            'border_bottom_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'footer_widget_title_typography_custom_skin_line_left_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_left_widget']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_left_widget']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_left_widget']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_left_widget']['font-size'],
                    'text-align'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_left_widget']['text-align'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_left_widget']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_left_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            'line_left_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'footer_widget_title_typography_custom_skin_line_transparant_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_transparant_widget']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_transparant_widget']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_transparant_widget']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_transparant_widget']['font-size'],
                    'text-align'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_transparant_widget']['text-align'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_transparant_widget']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_transparant_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            'line_transparant_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'footer_widget_title_typography_custom_skin_line_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_widget']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_widget']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_widget']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_widget']['font-size'],
                    'text-align'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_widget']['text-align'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_widget']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_line_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            'line_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'footer_widget_title_typography_custom_skin_colored_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_widget']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_widget']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_widget']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_widget']['font-size'],
                    'text-align'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_widget']['text-align'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_widget']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            'colored_widget',

                        ),
                    )
            ),
            array(
                'id'             => 'footer_widget_title_typography_custom_skin_colored_two_widget' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Title Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => true,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_two_widget']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_two_widget']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_two_widget']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_two_widget']['font-size'],
                    'text-align'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_two_widget']['text-align'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_two_widget']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_typography_custom_skin_colored_two_widget']['text-transform'],
                ),
                'required'       =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            'colored_two_widget',

                        ),
                    )
            ),

            array(
                'id'       => 'footer_widget_title_BgColor_first_custom_skin_border_bottom_bg_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_BgColor_first_custom_skin_border_bottom_bg_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'footer_widget_title_selected' . $skinName,
                        '=',
                        'border_bottom_bg_widget',

                    ),
                )
            ),

            array(
                'id'       => 'footer_widget_title_BgColor_first_custom_skin_colored_two_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_BgColor_first_custom_skin_colored_two_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'footer_widget_title_selected' . $skinName,
                        '=',
                        'colored_two_widget',

                    ),
                )
            ),
            array(
                'id'       => 'footer_widget_title_BgColor_first_custom_skin_colored_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title First Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_BgColor_first_custom_skin_colored_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'footer_widget_title_selected' . $skinName,
                        '=',
                        'colored_widget',

                    ),
                )
            ),
            array(
                'id'       => 'footer_widget_title_BgColor_first_custom_skin_line_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title First Background Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_BgColor_first_custom_skin_line_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'footer_widget_title_selected' . $skinName,
                        '=',
                        'line_widget',

                    ),
                )
            ),
            array(
                'id'       => 'footer_widget_title_BgColor_first_custom_skin_line_left_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title First Background Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_BgColor_first_custom_skin_line_left_widget'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'footer_widget_title_selected' . $skinName,
                        '=',
                        'line_left_widget',

                    ),
                )
            ),
//Footer widget title BgColor_first ***end
            //Footer widget title BgColor_second
            array(
                'id'       => 'footer_widget_title_BgColor_second_border_bottom_bg_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title Second Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_BgColor_second_border_bottom_bg_widget'],
                'validate' => 'color',
                'required' =>
                    array(

                        'footer_widget_title_selected' . $skinName,
                        '=',
                        'border_bottom_bg_widget'

                    )

            ),
            array(
                'id'       => 'footer_widget_title_BgColor_second_border_bottom_widget' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title Second Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_BgColor_second_border_bottom_widget'],
                'validate' => 'color',
                'required' =>
                    array(
                        'footer_widget_title_selected' . $skinName,
                        '=',
                        'border_bottom_widget'
                    ),

            ),
//Footer widget title BgColor_second
            array(
                'id'       => 'footer_widget_title_LineColor' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title Line Color ', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_LineColor'],
                'validate' => 'color',
                'required' =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            array( 'line_left_widget', 'line_widget' )
                        ),
                    )
            ),

            array(
                'id'       => 'footer_widget_title_top_borderColor' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title widget Top Border Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_top_borderColor'],
                'validate' => 'color',
                'required' => array(
                    array(
                        'footer_widget_title_selected' . $skinName,
                        '=',
                        array( 'colored_two_widget' )
                    ),
                )
            ),

            array(
                'id'       => 'footer_widget_title_borderColor' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Title Border Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_borderColor'],
                'validate' => 'color',
                'required' =>
                    array(
                        array(
                            'footer_widget_title_selected' . $skinName,
                            '=',
                            array( 'border_bottom_bg_widget', 'border_bottom_widget' )
                        ),

                    )
            ),


//Footer Tag
            array(
                'id'   => 'theme_Footer_tags_widget_setting_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Footer Tag Widget setting', 'chfw-lang' ) . '</h3>',

            ),
            array(
                'id'       => 'footer_widget_title_TagbgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Tag Title Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagbgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'       => 'footer_widget_title_Tag_HoverbgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Tag Background Hover Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_Tag_HoverbgColor_'],
                'validate' => 'color',

            ),
            array(
                'id'            => 'footer_widget_TagsWidgetBorder_' . $skinName,
                'type'          => 'border',
                'border-bottom' => true,
                'border-left'   => true,
                'border-right'  => true,
                'border-top'    => true,
                'title'         => __( 'Tag Border', 'chfw-lang' ),
                'desc'          => __( 'Pick a color', 'chfw-lang' ),
                'output'        => array( '.site-header' ),
                'default'       => array(
                    'border-color'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_TagsWidgetBorder_']['border-color'],
                    'border-style'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_TagsWidgetBorder_']['border-style'],
                    'border-bottom' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_TagsWidgetBorder_']['border-bottom'],
                    'border-left'   => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_TagsWidgetBorder_']['border-left'],
                    'border-right'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_TagsWidgetBorder_']['border-right'],
                    'border-top'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_TagsWidgetBorder_']['border-top'],
                ),

            ),
            array(
                'id'             => 'footer_widget_title_TagWidgetTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Tag Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetTypography_']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetTypography_']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetTypography_']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetTypography_']['font-size'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetTypography_']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetTypography_']['text-transform'],
                ),

            ),
            array(
                'id'             => 'footer_widget_title_TagWidgetHoverTypography_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Tag Widget Hover Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetHoverTypography_']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetHoverTypography_']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetHoverTypography_']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetHoverTypography_']['font-size'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetHoverTypography_']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_title_TagWidgetHoverTypography_']['text-transform'],
                ),

            ),

            array(
                'id'   => 'theme_Footer_serachButton_setting_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Footer Search Button', 'chfw-lang' ) . '</h3>',

            ),
            array(
                'id'       => 'footer_widget_searchButtonBgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Search Button Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_searchButtonBgColor_'],
                /*'default'  => '#dd3333',*/
                'validate' => 'color',


            ),
            array(
                'id'             => 'footer_widget_searchButton_' . $skinName,
                'type'           => 'typography',
                'title'          => __( 'Search Button Typography', 'chfw-lang' ),
                // 'compiler'=>true, // Use if you want to hook in your own CSS compiler
                'google'         => true,
                // Disable google fonts. Won't work if you haven't defined your google api key
                'font-backup'    => false,
                // Select a backup non-google font in addition to a google font
                'font-style'     => true,
                // Includes font-style and weight. Can use font-style or font-weight to declare
                'subsets'        => false,
                // Only appears if google is true and subsets not set to false
                'font-size'      => true,
                'line-height'    => true,
                'word-spacing'   => false,
                // Defaults to false
                'letter-spacing' => false,
                // Defaults to false
                'color'          => true,
                'preview'        => true,
                // Disable the previewer
                'all_styles'     => true,
                'line-height'    => true,
                'text-align'     => false,
                'text-transform' => true,
                // Enable all Google Font style/weight variations to be added to the page
                'output'         => array(
                    'h2.site-description'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'compiler'       => array(
                    'h2.site-description-compiler'
                ),
                // An array of CSS selectors to apply this font style to dynamically
                'units'          => 'px',
                // Defaults to px
                'desc'           => __( 'Customize posts and pages typography .', 'chfw-lang' ),
                'default'        => array(
                    'color'          => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_searchButton_']['color'],
                    'font-style'     => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_searchButton_']['font-style'],
                    'font-family'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_searchButton_']['font-family'],
                    'font-size'      => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_searchButton_']['font-size'],
                    'line-height'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_searchButton_']['line-height'],
                    'text-transform' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_widget_searchButton_']['text-transform'],
                ),

            ),
            array(
                'id'   => 'theme_Footer_minimal_general_info_' . $skinName,
                'icon' => true,
                'type' => 'info',
                'raw'  => '<h3 class="redux_info">' . __( 'Minimal Footer General Info', 'chfw-lang' ) . '</h3>',

            ),

            array(
                'id'       => 'footer_minimal_widget_BgColor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Background Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_BgColor_'],
                'validate' => 'color',


            ),

            array(
                'id'           => 'footer_minimal_widget_Border_' . $skinName,
                'type'         => 'border',
                'all'          => true,
                'border-style' => true,
                'border-color' => true,
                'title'        => __( 'Border Color', 'chfw-lang' ),
                'desc'         => __( 'Pick a color', 'chfw-lang' ),
                'output'       => array( '.site-header' ),
                'default'      => array(
                    'border-color'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Border_']['border-color'],
                    'border-style'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Border_']['border-style'],
                    'border-bottom' => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Border_']['border-bottom'],
                    'border-left'   => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Border_']['border-left'],
                    'border-right'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Border_']['border-right'],
                    'border-top'    => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Border_']['border-top'],
                ),

            ),

            array(
                'id'       => 'footer_minimal_widget_Linkcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Link Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Linkcolor_'],
                'validate' => 'color',

            ),

            array(
                'id'       => 'footer_minimal_widget_Textcolor_' . $skinName,
                'type'     => 'color',
                'title'    => __( 'Text Color', 'chfw-lang' ),
                'desc'     => __( 'Pick a color', 'chfw-lang' ),
                'default'  => $this->FooterSetting_DefaultConfig[ $skinName ]['footer_minimal_widget_Textcolor_'],
                'validate' => 'color',

            ),

        );

        foreach ( $Settings as $field ) {
            array_push( $sections, $field );
        }


        return $sections;

    }
}

$SkinGenerator                                         = new SkinGenerator();
$SkinGenerator->skin_Name                              = $CHfw_select_skin_gen;
$SkinGenerator->ThemeStyleSetting_DefaultConfig        = $ThemeStyleSetting_DefaultConfig;
$SkinGenerator->MainPageSetting_DefaultConfig          = $MainPageSetting_DefaultConfig;
$SkinGenerator->HeaderSetting_DefaultConfig            = $headerSetting_DefaultConfig;
$SkinGenerator->MenuSettings_DefaultConfig             = $menuSetting_DefaultConfig;
$SkinGenerator->TopNavBarSetting_DefaultConfig         = $TopNavBarSetting_DefaultConfig;
$SkinGenerator->MobileMenuSetting_DefaultConfig        = $mobileMenuSetting_DefaultConfig;
$SkinGenerator->BlogPostListStyleSetting_DefaultConfig = $blogPostListStyle_DefaultConfig;
$SkinGenerator->SidebarSetting_DefaultConfig           = $sidebarStyle_DefaultConfig;
$SkinGenerator->OutSideSidebarSetting_DefaultConfig    = $MobileMenuAdvancedSettings_DefaultConfig;
$SkinGenerator->ShopSetting_DefaultConfig              = $shopsetting_DefaultConfig;
$SkinGenerator->FooterSetting_DefaultConfig            = $FooterStyle_DefaultConfig;
//print_r  ($this->sections);

$ThemeStyleSettings['fields']    = $SkinGenerator->ThemeStyleSetting_( $ThemeStyleSettings['fields'] );
$MainPageSetting['fields']       = $SkinGenerator->MainPageSetting_( $MainPageSetting['fields'] );
$TopNavBarSetting['fields']      = $SkinGenerator->TopNavBarSetting_( $TopNavBarSetting['fields'] );
$HeaderSetting['fields']         = $SkinGenerator->HeaderSetting_( $HeaderSetting['fields'] );
$MenuSettings['fields']          = $SkinGenerator->MenuSettings_( $MenuSettings['fields'] );
$MobileMenuSettings['fields']    = $SkinGenerator->MobileMenuSetting_( $MobileMenuSettings['fields'] );
$MobileMenuAdvancedSettings['fields'] = $SkinGenerator->OutSideSidebarSetting_( $MobileMenuAdvancedSettings['fields'] );
$BlogPostListStyle['fields']     = $SkinGenerator->BlogPostListStyleSetting_( $BlogPostListStyle['fields'] );
$SidebarSetting['fields']        = $SkinGenerator->SidebarSetting_( $SidebarSetting['fields'] );
$ShopSetting['fields']           = $SkinGenerator->ShopSetting_( $ShopSetting['fields'] );
$FooterSetting['fields']         = $SkinGenerator->FooterSetting_( $FooterSetting['fields'] );


Redux::setSection( $opt_name, $ThemeStyleSettings );
Redux::setSection( $opt_name, $MainPageSetting );
Redux::setSection( $opt_name, $TopNavBarSetting );
Redux::setSection( $opt_name, $HeaderSetting );
Redux::setSection( $opt_name, $MenuSettings );
Redux::setSection( $opt_name, $MobileMenuSettings );
Redux::setSection( $opt_name, $MobileMenuAdvancedSettings );
Redux::setSection( $opt_name, $BlogPostListStyle );
Redux::setSection( $opt_name, $SidebarSetting );
Redux::setSection( $opt_name, $ShopSetting );
Redux::setSection( $opt_name, $FooterSetting );