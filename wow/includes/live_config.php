<?php
/**
 * diffrent skins and blog view options
 * GET options
 * DEV css and js files config
 *
 * @package wow
 * @author Chrom Themes
 * @link https://wow.chromthemes.com
 * @version 2.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly
global $CHfw_themeCurrentSkin_option_name;

/* --------------------------------------------------------------
 *  Default theme options
-------------------------------------------------------------- */
function CHfw_redux_first_import_options() {
	$default_options =

        array (
            'last_tab' => '6',
            'wp_admin_bar' => '1',
            'sticky_menu' => '1',
            'pages_lading_effect' => '0',
            'trackingCode' => '',
            'my_custom_css' => '',
            'copyrights' => '<div class="container">
<div class="row">
    <div class="pull-left">Copyright © 2018 WoW Hospitals </div>
    <div class="pull-right">Design & Development By ChromThemes</div>
    
</div>

</div>',
            'locationGmapApiKey' => 'AIzaSyCl_xFPGVIO8gGTzRFCneO-luTcQdVcz-8',
            'main_font_source' => '1',
            'main_font' =>
                array (
                    'font-family' => 'Open Sans',
                    'font-options' => '',
                    'google' => '1',
                    'subsets' => 'latin',
                ),
            'main_font_typekit_kit_id' => '',
            'secondary_font_source' => '0',
            'secondary_font' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'subsets' => '',
                ),
            'secondary_font_typekit_kit_id' => '',
            'secondary_typekit_font' => '',
            'logo' =>
                array (
                    'url' => 'http://wow.chromthemes.com/wp-content/uploads/2017/08/ch_fw_logo3.png',
                    'id' => '122',
                    'height' => '52',
                    'width' => '151',
                    'thumbnail' => 'http://wow.chromthemes.com/wp-content/uploads/2017/08/ch_fw_logo3-150x52.png',
                    'title' => '',
                    'caption' => '',
                    'alt' => '',
                    'description' => '',
                ),
            'mobile-logo' =>
                array (
                    'url' => 'http://wow.chromthemes.com/wp-content/themes/wow/assets/logo@2x.png',
                    'id' => '',
                    'height' => '',
                    'width' => '',
                    'thumbnail' => '',
                    'title' => '',
                    'caption' => '',
                    'alt' => '',
                    'description' => '',
                ),
            'favicon' =>
                array (
                    'url' => 'http://wow.chromthemes.com/wp-content/uploads/2018/02/favicon.png',
                    'id' => '723',
                    'height' => '46',
                    'width' => '48',
                    'thumbnail' => 'http://wow.chromthemes.com/wp-content/uploads/2018/02/favicon.png',
                    'title' => '',
                    'caption' => '',
                    'alt' => '',
                    'description' => '',
                ),
            'header_text' => '',
            'header_type_selected' => 'standard',
            'footer_type_selected' => 'standard',
            'mobil_menu_LayoutSelect' => 'advanced',
            'skin_selected_Hospital' => 'Hospital',
            'logo2x_Hospital' =>
                array (
                    'url' => 'http://wow.chromthemes.com/wp-content/uploads/2018/04/logos.png',
                    'id' => '960',
                    'height' => '65',
                    'width' => '151',
                    'thumbnail' => 'http://wow.chromthemes.com/wp-content/uploads/2018/04/logos-150x65.png',
                    'title' => 'logos',
                    'caption' => '',
                    'alt' => '',
                    'description' => '',
                ),
            'logo2x_mini_Hospital' =>
                array (
                    'url' => 'http://wow.chromthemes.com/wp-content/uploads/2018/04/logos.png',
                    'id' => '960',
                    'height' => '65',
                    'width' => '151',
                    'thumbnail' => 'http://wow.chromthemes.com/wp-content/uploads/2018/04/logos-150x65.png',
                    'title' => 'logos',
                    'caption' => '',
                    'alt' => '',
                    'description' => '',
                ),
            'siteBodyLayoutSetting_Hospital' => 'stretched',
            'android_theme_color_Hospital' => '#0392ce',
            'body_font_two_Hospital' => '#c1c0c0',
            'siteBodyBackgroundOptions_Hospital' =>
                array (
                    'background-color' => '#ffffff',
                    'background-repeat' => '',
                    'background-size' => '',
                    'background-attachment' => '',
                    'background-position' => '',
                    'background-image' => '',
                    'media' =>
                        array (
                            'id' => '',
                            'height' => '',
                            'width' => '',
                            'thumbnail' => '',
                        ),
                ),
            'EntriePage_typography_Hospital' =>
                array (
                    'font-weight' => '400',
                    'font-style' => '',
                    'font-size' => '12px',
                    'line-height' => '12px',
                    'color' => '#888888',
                ),
            'SiteCenterBorder_Hospital' =>
                array (
                    'border-top' => '1px',
                    'border-right' => '1px',
                    'border-bottom' => '1px',
                    'border-left' => '1px',
                    'border-style' => 'none',
                    'border-color' => '#D7D7D7',
                ),
            'SiteCenterBoxShadowEnableDisable_Hospital' => '0',
            'SiteCenterBoxShadow_BgColor_Hospital' =>
                array (
                    'color' => '#000',
                    'alpha' => '1',
                    'rgba' => 'rgba(0,0,0,0.35)',
                ),
            'SiteCenter_BgColor_Hospital' => 'transparent',
            'loadmore_BgColor_Hospital' => '#4285f4',
            'loadmore_TextColor_Hospital' => '#ffffff',
            'pagination_ButtonBgColor_Hospital' => '#4285f4',
            'pagination_ButtonTextColor_Hospital' => '#ffffff',
            'pagination_ActiveButtonBgColor_Hospital' => '#85b0f8',
            'pagination_ActiveButtonTextColor_Hospital' => '#ffffff',
            'top-navbarBG_color_Hospital' => '#ffffff',
            'top-navbar_dropdownBoxShadowEnableDisable_Hospital' => '0',
            'top-megaMenu_BoxShadow_color_Hospital' => 'transparent',
            'top-navbar_border_Hospital' =>
                array (
                    'border-top' => '0.5px',
                    'border-right' => '0.5px',
                    'border-bottom' => '0.5px',
                    'border-left' => '0.5px',
                    'border-style' => 'solid',
                    'border-color' => '#efefef',
                ),
            'top-navbar_typography_Hospital' =>
                array (
                    'font-family' => 'Open Sans',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '400',
                    'font-style' => '',
                    'text-transform' => 'capitalize',
                    'font-size' => '12px',
                    'line-height' => '11px',
                    'color' => '#000000',
                ),
            'top-navbar_text_shadow_color_Hospital' => '#dddddd',
            'top-navbar_icon_color_Hospital' => '#e2e2e2',
            'shop_mini_cart_enable_disable_Hospital' => '0',
            'headerCenter_bgcolor_Hospital' => '#ffffff',
            'HeaderCenter_Typography_Hospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '400',
                    'font-style' => '',
                    'font-size' => '14px',
                    'line-height' => '14px',
                    'color' => '#ffffff',
                ),
            'HeaderCenter_border_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '1px',
                    'border-left' => '0px',
                    'border-style' => 'solid',
                    'border-color' => '#969696',
                ),
            'headerCenter_makeAnAppoinmentBgColor_Hospital' => '#058cc6',
            'headerCenter_makeAnAppoinment_Button_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '500',
                    'font-style' => '',
                    'text-transform' => 'uppercase',
                    'font-size' => '11px',
                    'color' => '#ffffff',
                ),
            'headerCenter_siearchButtonBgColor_Hospital' => '#ffffff',
            'headerCenter_searchButtonBorder_Hospital' =>
                array (
                    'border-top' => '2px',
                    'border-right' => '2px',
                    'border-bottom' => '2px',
                    'border-left' => '2px',
                    'border-style' => 'solid',
                    'border-color' => '#ffffff',
                ),
            'HeaderCenter_SearchButtonTypography_Hospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'font-size' => '13px',
                    'line-height' => '30px',
                    'color' => '#fff',
                ),
            'header_minicart_cartBgColor_Hospital' => '#1e73be',
            'header_minicart_cartCounterBgColor_Hospital' => '#f4524d',
            'header_minicart_cartCountertextColor_Hospital' => '#000000',
            'header_minicart_BgColor_Hospital' => '#ffffff',
            'header_minicart_Text_and_Link_Color_Hospital' => '#004dac',
            'header_minicart_Border_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '1px',
                    'border-left' => '0px',
                    'border-style' => 'none',
                    'border-color' => '#000',
                ),
            'header_minicart_editCartButton_BgColor_Hospital' => '#004dac',
            'header_minicart_editCartButton_textColor_Hospital' => '#f2ba53',
            'header_minicart_checkoutButton_BgColor_Hospital' => '#f2ba53',
            'header_minicart_checkoutButton_textColor_Hospital' => '#52191d',
            'megaMenu_menu_arrow_Hospital' => 'show',
            'megaMenu_submenu_arrow_Hospital' => 'hide',
            'megaMenu_animation_type_Hospital' => 'nothing',
            'megaMenu_backgroundcolor_Hospital' => '#ffffff',
            'megaMenu_backgroundHoverColor_Hospital' => '#ffffff',
            'megaMenu_textcolor_Hospital' => '#000000',
            'megaMenu_textHoverColor_Hospital' => '#347cdb',
            'megaMenu_Typography_Hospital' =>
                array (
                    'font-family' => 'Open Sans',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '400',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '18px',
                    'line-height' => '20px',
                ),
            'megaMenu_topMenuBorderOption_Hospital' =>
                array (
                    'border-top' => '0.5px',
                    'border-right' => '0.5px',
                    'border-bottom' => '0.5px',
                    'border-left' => '0.5px',
                    'border-style' => 'solid',
                    'border-color' => '#eeeeee',
                ),
            'megaMenu_insideMenuTypography_Hospital' =>
                array (
                    'font-family' => 'Open Sans',
                    'font-options' => '',
                    'google' => '1',
                    'text-transform' => 'none',
                ),
            'megaMenu_insideMenu_backgroundcolor_Hospital' => '#ffffff',
            'megaMenu_insideMenu_ColorHospital' => '#000000',
            'megaMenu_insideMenu_TextHoverColor_Hospital' => '#347cdb',
            'megaMenu_insideMenu_ActiveBgColor_Hospital' => '#ffffff',
            'megaMenu_insideMenu_ActiveTextColor_Hospital' => '#347cdb',
            'megaMenu_insideMenu_borderOption_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '0px',
                    'border-left' => '0px',
                    'border-style' => 'none',
                    'border-color' => '#000000',
                ),
            'dropdown_menu-border-bottom_text_option_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '1px',
                    'border-left' => '0px',
                    'border-style' => 'none',
                    'border-color' => '#dddddd',
                ),
            'MobileMenu_BgColor_Hospital' => '#ffffff',
            'MobileMenu_Submenu_BgColor_Hospital' => '#ffffff',
            'MobileMenu_linkColor_Hospital' => '#000000',
            'MobileMenu_arrowColor_Hospital' => '#000000',
            'MobileMenu_searchButtonBgColor_Hospital' => '#ffffff',
            'MobileMenu_searchButtonBorderColor_Hospital' => '#8c8c8c',
            'MobileMenu_searchButtonTextColor_Hospital' => '#000000',
            'OutSideSidebar_BgColor_Hospital' => '#ffffff',
            'OutSideSidebar_social_EnableDisable_Hospital' => '#93af76',
            'OutSideSidebar_linkColor_Hospital' => '#8c8c8c',
            'OutSideSidebar_arrowColor_Hospital' => '#8c8c8c',
            'OutSideSidebar_searchButtonBgColor_Hospital' => '#ffffff',
            'OutSideSidebar_searchButtonBorderColor_Hospital' => '#8c8c8c',
            'OutSideSidebar_searchButtonTextColor_Hospital' => '#000000',
            'BlogPostTitleStyleTypography_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-backup' => '\'Comic Sans MS\', cursive',
                    'font-weight' => '700',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '18px',
                    'line-height' => '29px',
                    'color' => '#494949',
                ),
            'BlogPostStyleInfoTypography_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '500',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '11px',
                    'line-height' => '22px',
                    'color' => '#595959',
                ),
            'BlogPostStyleTextTypography_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '400',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '13px',
                    'line-height' => '22px',
                    'color' => '#888888',
                ),
            'PostStyleListBgColor_Hospital' => '#ffffff',
            'PostStyleListBoxShadow_Hospital' => '1',
            'PostStyleListBorderRadius_Hospital' => '0',
            'PostStyleListBorder_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '1px',
                    'border-left' => '0px',
                    'border-style' => 'none',
                    'border-color' => '#d8d8d8',
                ),
            'PostStyleListSocialBarBgColor_Hospital' => '',
            'PostStyleList_TagTypography_Hospital' =>
                array (
                    'font-family' => '',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-transform' => '',
                    'font-size' => '',
                    'line-height' => '',
                    'color' => '',
                ),
            'PostStyleList_TagHoverTypography_Hospital' =>
                array (
                    'font-family' => '',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-transform' => '',
                    'font-size' => '',
                    'line-height' => '',
                    'color' => '',
                ),
            'PostStyleList_TagsBgColor_Hospital' => '',
            'PostStyleList_TagsHoverBgColor_Hospital' => '',
            'PostStyleList_SocialBarBorder_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '0px',
                    'border-left' => '0px',
                    'border-style' => 'solid',
                    'border-color' => '',
                ),
            'PostStyleList_ReadMoreButtonBgColor_Hospital' => 'transparent',
            'PostStyleList_ReadMoreButtonBgHoverColor_Hospital' => 'transparent',
            'BlogPostStyleReadMoreButtonTypography_Hospital' =>
                array (
                    'font-family' => 'Open Sans',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '400',
                    'font-style' => '',
                    'text-transform' => 'capitalize',
                    'font-size' => '12px',
                    'line-height' => '14px',
                    'color' => '#000000',
                ),
            'BlogPostStyleReadMoreButtonHoverTypography_Hospital' => '#000000',
            'sidebar_view_model_Hospital' => 'boxed-content',
            'sidebar_widget_BgColor_Hospital' => '#ffffff',
            'sidebar_widget_Border_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '0px',
                    'border-left' => '0px',
                    'border-style' => 'none',
                    'border-color' => '#DDD',
                ),
            'sidebar_widgetBoxShadowEnableDisable_Hospital' => '1',
            'sidebar_BoxShadow_BgColor_Hospital' =>
                array (
                    'color' => '#000000',
                    'alpha' => '0.1',
                    'rgba' => 'rgba(0,0,0,0.1)',
                ),
            'sidebar_widget_Linkcolor_Hospital' => '#000000',
            'sidebar_widget_Textcolor_Hospital' => '#000000',
            'sidebar_widget_title_selectedHospital' => 'line_transparant_widget',
            'sidebar_widget_title_typography_custom_skin_border_bottom_bg_widgetHospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '14px',
                    'line-height' => '28px',
                    'color' => '#579aed',
                ),
            'sidebar_widget_title_typography_custom_skin_border_bottom_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#000000',
                ),
            'sidebar_widget_title_typography_custom_skin_line_left_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '700',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#000',
                ),
            'sidebar_widget_title_typography_custom_skin_line_transparant_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '700',
                    'font-style' => '',
                    'text-align' => 'center',
                    'text-transform' => 'uppercase',
                    'font-size' => '17px',
                    'line-height' => '28px',
                    'color' => '#000000',
                ),
            'sidebar_widget_title_typography_custom_skin_line_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '700',
                    'text-align' => 'center',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#000',
                ),
            'sidebar_widget_title_typography_custom_skin_colored_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'uppercase',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#ffffff',
                ),
            'sidebar_widget_title_typography_custom_skin_colored_two_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#fff',
                ),
            'sidebar_widget_title_BgColor_first_custom_skin_border_bottom_bg_widgetHospital' => '#252525',
            'sidebar_widget_title_BgColor_first_custom_skin_colored_two_widgetHospital' => '#dd3333',
            'sidebar_widget_title_BgColor_first_custom_skin_colored_widgetHospital' => '#2d85c4',
            'sidebar_widget_title_BgColor_first_custom_skin_line_widgetHospital' => '#ffffff',
            'sidebar_widget_title_BgColor_first_custom_skin_line_left_widgetHospital' => '#ffffff',
            'sidebar_widget_title_BgColor_second_border_bottom_bg_widgetHospital' => '#1e73be',
            'sidebar_widget_title_BgColor_second_border_bottom_widgetHospital' => 'transparent',
            'sidebar_widget_title_LineColorHospital' => '#000000',
            'sidebar_widget_title_colored_widgetTopBorderColorHospital' => '#ffc908',
            'sidebar_widget_title_borderColorHospital' => '#000000',
            'sidebar_widget_title_TagbgColor_Hospital' => '#2d85c4',
            'sidebar_widget_title_Tag_HoverbgColor_Hospital' => '#2d85c4',
            'sidebar_widget_TagsWidgetBorder_Hospital' =>
                array (
                    'border-top' => '1px',
                    'border-right' => '1px',
                    'border-bottom' => '1px',
                    'border-left' => '1px',
                    'border-style' => 'solid',
                    'border-color' => '#e4e4e4',
                ),
            'sidebar_widget_title_TagWidgetTypography_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '12px',
                    'line-height' => '15px',
                    'color' => '#ffffff',
                ),
            'sidebar_widget_title_WidgetHoverTypography_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '12px',
                    'line-height' => '15px',
                    'color' => '#000000',
                ),
            'sidebar_widget_searchButtonBgColor_Hospital' => '#0072a8',
            'sidebar_widget_searchButton_Hospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '400',
                    'font-style' => '',
                    'text-transform' => 'uppercase',
                    'font-size' => '14px',
                    'line-height' => '28px',
                    'color' => '#ffffff',
                ),
            'Shop_product_image_bgcolor_Hospital' => '',
            'Shop_sale_badge_textcolor_Hospital' => '#ffffff',
            'Shop_sale_badge_bgcolor_Hospital' => '#dd336b',
            'Shop_outofstock_badge_bgcolor_Hospital' => '#333333',
            'Shop_new_badge_bgcolor_Hospital' => '#3885C5',
            'Shop_discountPercentage_Hospital' => '#dd3333',
            'Shop_quickview_bgcolor_Hospital' => '#08c08c',
            'AddToCart_btn_BgColor_Hospital' => '#000000',
            'AddToCart_btn_TextColor_Hospital' => '#ffffff',
            'footer_widget_BgColor_Hospital' => '#363839',
            'footer_widget_Border_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '0px',
                    'border-left' => '0px',
                    'border-style' => 'none',
                    'border-color' => '',
                ),
            'footer_widget_Linkcolor_Hospital' => '#ffffff',
            'footer_widget_Textcolor_Hospital' => '#ffffff',
            'footer_widget_title_selectedHospital' => 'line_transparant_widget',
            'footer_widget_title_typography_custom_skin_border_bottom_bg_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '700',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#d84f5f',
                ),
            'footer_widget_title_typography_custom_skin_border_bottom_widgetHospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '14px',
                    'line-height' => '20px',
                    'color' => '#000000',
                ),
            'footer_widget_title_typography_custom_skin_line_left_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '700',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#ffffff',
                ),
            'footer_widget_title_typography_custom_skin_line_transparant_widgetHospital' =>
                array (
                    'font-family' => 'Open Sans',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '700',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'uppercase',
                    'font-size' => '17px',
                    'line-height' => '28px',
                    'color' => '#ffffff',
                ),
            'footer_widget_title_typography_custom_skin_line_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '700',
                    'font-style' => '',
                    'text-align' => 'center',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#000',
                ),
            'footer_widget_title_typography_custom_skin_colored_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '700',
                    'font-style' => '',
                    'text-align' => 'left',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#fff',
                ),
            'footer_widget_title_typography_custom_skin_colored_two_widgetHospital' =>
                array (
                    'font-family' => 'Roboto Condensed',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '700',
                    'font-style' => '',
                    'text-align' => 'center',
                    'text-transform' => 'none',
                    'font-size' => '16px',
                    'line-height' => '28px',
                    'color' => '#fff',
                ),
            'footer_widget_title_BgColor_first_custom_skin_border_bottom_bg_widgetHospital' => '#252525',
            'footer_widget_title_BgColor_first_custom_skin_colored_two_widgetHospital' => '#000000',
            'footer_widget_title_BgColor_first_custom_skin_colored_widgetHospital' => '#252525',
            'footer_widget_title_BgColor_first_custom_skin_line_widgetHospital' => '#ffffff',
            'footer_widget_title_BgColor_first_custom_skin_line_left_widgetHospital' => 'transparent',
            'footer_widget_title_BgColor_second_border_bottom_bg_widgetHospital' => '#F4524C',
            'footer_widget_title_BgColor_second_border_bottom_widgetHospital' => '#ffffff',
            'footer_widget_title_LineColorHospital' => '#000000',
            'footer_widget_title_top_borderColorHospital' => '#ffc908',
            'footer_widget_title_borderColorHospital' => '#cccccc',
            'footer_widget_title_TagbgColor_Hospital' => '#515151',
            'footer_widget_title_Tag_HoverbgColor_Hospital' => '#424242',
            'footer_widget_TagsWidgetBorder_Hospital' =>
                array (
                    'border-top' => '1px',
                    'border-right' => '1px',
                    'border-bottom' => '1px',
                    'border-left' => '1px',
                    'border-style' => 'solid',
                    'border-color' => '#515151',
                ),
            'footer_widget_title_TagWidgetTypography_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '400',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '11px',
                    'line-height' => '10px',
                    'color' => '#ffffff',
                ),
            'footer_widget_title_TagWidgetHoverTypography_Hospital' =>
                array (
                    'font-family' => 'Poppins',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-transform' => 'none',
                    'font-size' => '12px',
                    'line-height' => '15px',
                    'color' => '#fff',
                ),
            'footer_widget_searchButtonBgColor_Hospital' => '#1e73be',
            'footer_widget_searchButton_Hospital' =>
                array (
                    'font-family' => 'Open Sans',
                    'font-options' => '',
                    'google' => '1',
                    'font-weight' => '',
                    'font-style' => '',
                    'text-transform' => 'uppercase',
                    'font-size' => '14px',
                    'line-height' => '28px',
                    'color' => '#ffffff',
                ),
            'footer_minimal_widget_BgColor_Hospital' => '#2f3232',
            'footer_minimal_widget_Border_Hospital' =>
                array (
                    'border-top' => '0px',
                    'border-right' => '0px',
                    'border-bottom' => '0px',
                    'border-left' => '0px',
                    'border-style' => 'none',
                    'border-color' => '#ece9e9',
                ),
            'footer_minimal_widget_Linkcolor_Hospital' => '#bcbec0',
            'footer_minimal_widget_Textcolor_Hospital' => '#bcbec0',
            'facebook' => 'facebook',
            'twitter' => '',
            'flickr' => '',
            'pinterest' => '',
            'googleplus' => '',
            'instagram' => '',
            'rss' => '#',
            'youtube' => '#',
            'linkedin' => '#',
            'tumblr' => '#',
            'vimeo' => '#',
            'soundcloud' => '#',
            'skype' => '#',
            'github' => '#',
            'dribbble' => '#',
            'main_blog_layout' => 'left',
            'masonry_page_columns' => 'col2',
            'sidebar_status' => '1',
            'hide_sidebar_button' => '1',
            'archive_page_blog_layout' => 'left',
            'archive_view_style' => 'masonry',
            'blog_pagination_type' => 'ajax',
            'blog_pagination_type_ajax' => 'ajax',
            'blog_order' => 'date',
            'limit_posts' => '5',
            'main_page_sidebar_mobile_view' => '1',
            'main_page_sidebar_tablet_view' => '1',
            'pages_list_type_blog_layouts' => 'left',
            'single_blog_layout' => 'left',
            'postpages_sidebar_mobile_view' => '1',
            'postpages_sidebar_tablet_view' => '1',
            'enable_list_facebook_like' => '1',
            'enable_list_socialShare' => '1',
            'blog_social_share_icons_enable_disable' =>
                array (
                    'facebook' => '1',
                    'twitter' => '1',
                    'intagram' => '1',
                    'gplus' => '1',
                    'pinterest' => '1',
                    'flick' => '1',
                    'linkedin' => '',
                    'mail' => '',
                ),
            'image_overlay_type' => 'overlay-image_slide-in-left',
            'enable_readmore' => '1',
            'readmore_text' => 'Read More',
            'enable_author_section' => '1',
            'blog_show_full_posts' => '0',
            'enable_related_posts' => '1',
            'related_post_type' => 'pictures',
            'related_posts_option' => 'category',
            'related_posts_limit' => '4',
            'enable_comments' => '1',
            'comments_system' => 'wp',
            'disqus_shortname' => 'http-chromatin-chromthemes-com-1',
            'facebook_app_id' => '1772955066289016',
            'facebook_comments_count' => '5',
            'facebook_comments_theme' => 'light',
            'facebook_comments_width' => '650px',
            'archive_title' => '',
            'error404' => '',
            'ajax_search' => '1',
            'search_blog_layout' => 'full',
            'search_loading_text' => '',
            'search_title' => '',
            'search_error' => '',
            'searchform_message' => '',
            'staff_main_layout' => 'stack',
            'staff_pagination_type' => 'ajax',
            'DepartmanPageLayoutSelect' => 'five',
            'DepartmanPageDo_not_look_blank_' => '',
            'main_font_info' => '',
            'secondary_font_info' => '',
            'secondary_font_fontdeck_info' => '',
            'mobil_menu_Settings_info' => '',
            'theme_setting_EntriePage_info_' => '',
            'theme_setting_centerbox_info_Hospital' => '',
            'theme_setting_pagination_info_Hospital' => '',
            'theme_setting_pagination_info_pic1Hospital' => '',
            'theme_setting_pagination_info_pic2Hospital' => '',
            'theme_setting_header_info_' => '',
            'header_center_infoHospital' => '',
            'headerCenter_makeAnAppoinment_info_Hospital' => '',
            'headerCenter_siearchButton_info_Hospital' => '',
            'header_minicart_infoHospital' => '',
            'theme_dropdown_info_Hospital' => '',
            'megaMenu_insideMenu_info_Hospital' => '',
            'MobileMenu_info_' => '',
            'MobileMenu_searchButton_info_Hospital' => '',
            'OutSideSidebar_general_info_' => '',
            'OutSideSidebar_searchButton_info_Hospital' => '',
            'theme_settingBlogPostStyle_info_' => '',
            'theme_settingPost_List_info_Hospital' => '',
            'theme_settingBlogPostStyleTags_info_Hospital' => '',
            'PostStyleList_ReadMoreButton_info_Hospital' => '',
            'theme_sidebar_general_info_' => '',
            'theme_sidebar_title_info_Hospital' => '',
            'theme_sidebar_tags_widget_setting_info_Hospital' => '',
            'theme_sidebar_serachButton_setting_info_Hospital' => '',
            'product_page_info_' => '',
            'shop_options_AddToCart_info_Hospital' => '',
            'theme_Footer_general_info_' => '',
            'theme_Footer_title_info_Hospital' => '',
            'theme_Footer_tags_widget_setting_info_Hospital' => '',
            'theme_Footer_serachButton_setting_info_Hospital' => '',
            'theme_Footer_minimal_general_info_Hospital' => '',
            'PageSettings_info' => '',
            'product_quickview_info' => '',
            'pagination_blog_info' => '',
            'pages_setting_mobil_sidebar_info' => '',
            'post_single_info' => '',
            'postpages_setting_mobil_sidebar_info' => '',
            'post_single_social_info' => '',
            'post_single_other_info' => '',
            'related_posts_system_info' => '',
            'Comments System_system_info' => '',
            'Page_staff_Settings_info' => '',
            'Page_Departmens_Settings_info' => '',
            'wbc_demo_importer' => '',
            'redux_options_object' => '',
            'redux_import_export' => '',
            'redux-backup' => 1,
        );


	// Set the options global
	global $CHfw_themeReduxOptionName;

	// Save default options to the database
	update_option( $CHfw_themeReduxOptionName, $default_options );


}
/* ---------------------------------------------------------------------------
*GET request for skin file import
 * --------------------------------------------------------------------------- */
function CHfw_redux_options() {
	global $CHfw_themeReduxOptionName;
	if ( isset ( $_GET['skin'] ) ) {
		$CHfw_select_skin = $_GET['skin'];
		if ( file_exists( get_template_directory() . "/includes/plugins/ReduxCore/inc/extensions/wbc_importer/demo-data/" . $CHfw_select_skin . "/theme-options.txt" ) ) {

			/*$string           = file_get_contents( get_template_directory() . "/includes/plugins/ReduxCore/inc/extensions/wbc_importer/demo-data/" . $CHfw_select_skin . "/theme-options.txt" );//del
			$json_a           = json_decode( $string, true );//del*/

			$path_file = CHfw_THEME_URL . "/includes/plugins/ReduxCore/inc/extensions/wbc_importer/demo-data/" . $CHfw_select_skin . "/theme-options.txt";
			// $path_file = 'https://wow.wow.chromthemes.com/wp-content/themes/wow' . "/includes/plugins/ReduxFramework/inc/extensions/wbc_importer/demo-data/" . $CHfw_select_skin . "/theme-options.txt";


			// Get file contents and decode
			$request = wp_remote_get( $path_file );
// Get the body of the response
			$data = wp_remote_retrieve_body( $request );
// Decode the json
			$json_a = json_decode( $data, true );

			$CHfw_rdx_options = $json_a;
			$result           = true;
		}

	} else {
		$result = false;
// Get theme options
		$CHfw_rdx_options = get_option( $CHfw_themeReduxOptionName );
// Is the theme options array saved?
		if ( ! $CHfw_rdx_options ) {
			// Save default options array
			CHfw_redux_first_import_options();
		}
	}
	$result_data = array(
		'result'       => $result,
		'options_data' => $CHfw_rdx_options
	);

	return $result_data;
}

// load data and select  -------------------------------------------------------
$CHfw_rdx_options    = CHfw_redux_options()['options_data'];
$file_options_result = CHfw_redux_options()['result'];
if ( isset ( $_GET['skin'] ) && $file_options_result ) {
	$CHfw_select_skin = $_GET['skin'];
} else {
	$CHfw_select_skin = get_option( $CHfw_themeCurrentSkin_option_name );
}


// DEV css and js files config   -------------------------------------------------------
$prod_min =array( 'min' => '', 'devpath' => '' );
