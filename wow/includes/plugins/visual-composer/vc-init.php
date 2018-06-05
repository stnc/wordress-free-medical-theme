<?php
/* Visual Composer: Initialize
================================================== */

if (class_exists('WPBakeryVisualComposerAbstract')) {
    global $CHfw_vcomposer_stock;

    // Enable 'theme mode' (disables plugin update message)
    if (function_exists('vc_set_as_theme')) {
        vc_set_as_theme(true);
    }



    /*-----------------------------------------------------------------------------------*/
    /*	Frontend assets
	/*-----------------------------------------------------------------------------------*/
    function CHfw_vc_frontend_assets()
    {
        global $prod_min;

        // Deregister scripts
        wp_deregister_script('wpb_composer_front_js');
      wp_enqueue_script('CHfw_composer_front_js', CHfw_THEME_URL . '/assets/js/third-party/vc_composer_front.min.js', array('jquery'), '1.0', true);


        wp_deregister_script('vc_tabs_script');

    }

    if (!$CHfw_vcomposer_stock) {
        add_action('wp_enqueue_scripts', 'CHfw_vc_frontend_assets', 1);
    }

    add_action('wp_enqueue_scripts', 'CHfw_vc_frontend_assets', 1);
    // Check if "CF7" is enabled
    global $CHfw_cf7_enabled;
    $CHfw_cf7_enabled = (defined('WPCF7_PLUGIN') || is_plugin_active('contact-form-7/wp-contact-form-7.php')) ? true : false;


    if (is_admin()) {

        //Include elements configuration
        get_template_part('includes/plugins/visual-composer/vc-elements-config');


        /*-----------------------------------------------------------------------------------*/
        /*Make elements "un-deprecated"
		/*-----------------------------------------------------------------------------------*/
        function CHfw_vc_undeprecate_elements()
        {
            /* vc_map_update('vc_tabs', array('deprecated' => false));
			 vc_map_update('vc_tour', array('deprecated' => false));
			 vc_map_update( 'vc_accordion', array( 'deprecated' => false ) );*/
        }

        if (!$CHfw_vcomposer_stock) {
            add_action('init', 'CHfw_vc_undeprecate_elements');
        }


        // Include custom params
        get_template_part('includes/plugins/visual-composer/params/iconpicker');


        if (CHfw_woocommerce_activated()) {
            /*-----------------------------------------------------------------------------------*/
            /* Remove default WooCommerce elements
			/*-----------------------------------------------------------------------------------*/
            function ch_vc_remove_woocommerce_elements()
            {
                vc_remove_element('woocommerce_cart');
                vc_remove_element('woocommerce_checkout');
                vc_remove_element('woocommerce_my_account');
                vc_remove_element('product');
                vc_remove_element('product_page');
                //vc_remove_element('product_categories');
            }

            add_action('vc_build_admin_page', 'ch_vc_remove_woocommerce_elements', 11); // Hook for admin editor
            add_action('vc_load_shortcode', 'ch_vc_remove_woocommerce_elements', 11); // Hook for frontend editor
        }


        /*-----------------------------------------------------------------------------------*/
        /*Remove admin menus
		/*-----------------------------------------------------------------------------------*/
        function CHfw_vc_remove_admin_menus()
        {
            remove_submenu_page('vc-general', 'vc-automapper');
            remove_submenu_page('vc-general', 'edit.php?post_type=vc_grid_item');
            remove_submenu_page('vc-general', 'vc-welcome');
        }

        add_action('admin_menu', 'CHfw_vc_remove_admin_menus', 1000);


        // Disable shortcode automapper feature
        if (function_exists('vc_automapper')) {
            vc_automapper()->setDisabled(true);
        }


        /*-----------------------------------------------------------------------------------*/
        /*Remove "vc_teaser" metabox
		/*-----------------------------------------------------------------------------------*/
        function CHfw_vc_remove_teaser_metabox()
        {
            remove_meta_box('vc_teaser', '','side');
        }

        add_action('admin_head', 'CHfw_vc_remove_teaser_metabox');


        // Set default editor post types (will not be used if the "content_types" VC setting is already saved - see fix below)
        $post_types = array(
            'page', 'post', 'staff', ' locations', 'mp-event'
        );
        vc_set_default_editor_post_types($post_types);

        // Default editor post types: Un-comment and refresh WP admin to save/reset the "content_types" VC option
        // NOTE: Remember to comment-out after page refresh!
        //vc_settings()->set( 'content_types', $post_types );
    }


    /*-----------------------------------------------------------------------------------*/
    /*Remove header meta tag
	/*-----------------------------------------------------------------------------------*/
    function CHfw_vc_remove_meta()
    {
        remove_action('wp_head', array(visual_composer(), 'addMetaData'));
    }

    add_action('init', 'CHfw_vc_remove_meta', 100);


    /**--------------------------------------------------------------------------------------
     * VC: Output page and "Design options" tabs styles on the shop pages (Since the WooCommerce shop page is an archive (non-singular), the styles are not output)
     *
     * See "addFrontCss()" in "../js_composer/include/classes/core/class-vc-base.php"
     *----------------------------------------------------------------------*/
    function CHfw_addFrontCss()
    {
        if (is_shop() || is_product_taxonomy()) {
            global $CHR_globals;

            // Get custom styles from the post meta (returns empty strings if no results)
            $post_custom_css = get_post_meta($CHR_globals['shop_page_id'], '_wpb_post_custom_css', true);
            $shortcodes_custom_css = get_post_meta($CHR_globals['shop_page_id'], '_wpb_shortcodes_custom_css', true);

            if ($post_custom_css != '' || $shortcodes_custom_css != '') {
                echo '<style type="text/css" class="ch-vc-styles">' . $post_custom_css . $shortcodes_custom_css . '</style>';
            }
        }
    }

    // Add hook (if WooCommerce is enabled)
    if (CHfw_woocommerce_activated()) {
        add_action('wp_head', 'CHfw_addFrontCss', 1000);
    }

}



