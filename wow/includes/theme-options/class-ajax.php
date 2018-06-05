<?php
/**
 * The template for displaying content in the single.php and blog pages
 * SLIDER POST
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit();
}

/*-----------------------------------------------------------------------------------*/

/*	 WooCommerce Ajax Options
/*-----------------------------------------------------------------------------------*/

class CHfw_WooCommerceAjaxOptions
{

    var $toolkit;

    public function getCurrentUrl_()
    {
        $pageURL = 'http';
        if (isset($_SERVER["HTTPS"]) and $_SERVER["HTTPS"] == "on") {
            $pageURL .= "s";
        }
        $pageURL .= "://";
        if ($_SERVER["SERVER_PORT"] != "80") {
            $pageURL .= $_SERVER["SERVER_NAME"] . ":" . $_SERVER["SERVER_PORT"] . $_SERVER["REQUEST_URI"];
        } else {
            $pageURL .= $_SERVER["SERVER_NAME"] . $_SERVER["REQUEST_URI"];
        }

        return $pageURL;
    }

    /**
     * init
     */
    public function __construct()
    {
        global $chToolkit;

        $this->toolkit = $chToolkit;

        add_action('wp_footer', array(
            &$this,
            'theme_js_optionsLocalize'
        ), 10);

    }


    /**
     * localize js variables
     * @return mixes
     */
    public function theme_js_optionsLocalize()
    {
        global $CHfw_rdx_options;


        if (isset($CHfw_rdx_options['ajax_popup_notification_off_time'])) {
            if ($CHfw_rdx_options['ajax_popup_notification_off_time'] != 0) {
                $PopupNotificationOffTime = $CHfw_rdx_options['ajax_popup_notification_off_time'] * 1000;
            }
        } else {
            $PopupNotificationOffTime = '5500';
        }
        $WishlistOpen = false;
        if (in_array('yith-woocommerce-wishlist/init.php', apply_filters('active_plugins', get_option('active_plugins')))) {
            $WishlistOpen = true;
        }


        $current_url = $this->getCurrentUrl_();
        // Add local Javascript variables
        $local_js_vars = array(
            'ajaxurl' => admin_url('admin-ajax.php'),
            'ajaxSiteUrl' => esc_url(home_url()),
            'siteThemeUrl' => get_template_directory_uri(),
            'add_to_wishlist_translate' => __('Add to wishlist', 'chfw-lang'),
            'please_wait_translate' => !empty($CHfw_rdx_options['search_loading_text']) ? $CHfw_rdx_options['search_loading_text'] : __('Please Wait...', 'chfw-lang'),
            'ajax_product_pop_up_info' => true,
            'this_page_url' => $current_url,
            'WishlistOpen' => $WishlistOpen,
            'ProductImageZoom' => isset($CHfw_rdx_options['product_image_zoom']) ? $CHfw_rdx_options['product_image_zoom'] : '1',
            'PopupNotification' => isset($CHfw_rdx_options['ajax_popup_notification']) ? $CHfw_rdx_options['ajax_popup_notification'] : '1',
            'PopupNotificationOffTime' => $PopupNotificationOffTime,
            'PopupNotificationAutoClose' => isset($CHfw_rdx_options['ajax_popup_notification_auto_close']) ? $CHfw_rdx_options['ajax_popup_notification_auto_close'] : '0',
            'AjaxSearch' => isset($CHfw_rdx_options['ajax_search']) ? $CHfw_rdx_options['ajax_search'] : '1',
            'lazyyload' => isset($CHfw_rdx_options['lazy_loading_shop_image']) ? $CHfw_rdx_options['lazy_loading_shop_image'] : '1',
            'AjaxAddToCart' => (get_option('woocommerce_enable_ajax_add_to_cart') == 'yes' && get_option('woocommerce_cart_redirect_after_add') == 'no') ? 1 : 0,
            'sticky_menu' => isset($CHfw_rdx_options['sticky_menu']) ? $CHfw_rdx_options['sticky_menu'] : 1,
        );
        wp_localize_script('CHfwJS', 'wow_wp_shop_vars', $local_js_vars);

    }


    /**
     * Check if current request is made via AJAX
     *
     * @return boolean
     */
    public function is_ajax_request()
    {
        if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
            return true;
        }

        return false;
    }

}


$function_ajax = new CHfw_WooCommerceAjaxOptions();

