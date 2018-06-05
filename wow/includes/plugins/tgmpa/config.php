<?php
/**
 * This file represents an example of the code that themes would use to register
 * the required plugins.
 *
 * It is expected that theme authors would copy and paste this code into their
 * functions.php file, and amend to suit.
 *
 * @see http://tgmpluginactivation.com/configuration/ for detailed documentation.
 *
 * @package    TGM-Plugin-Activation
 * @subpackage Example
 * @version    2.5.2
 * @author     Thomas Griffin, Gary Jones, Juliette Reinders Folmer
 * @copyright  Copyright (c) 2011, Thomas Griffin
 * @license    http://opensource.org/licenses/gpl-2.0.php GPL v2 or later
 * @link       https://github.com/TGMPA/TGM-Plugin-Activation
 */

/**
 * Include the TGM_Plugin_Activation class.
 */
get_template_part("includes/plugins/tgmpa/class-tgm-plugin-activation");
add_action('tgmpa_register', 'scFW_tgm_plugin_activation_config');
/**
 * Register the required plugins for this theme.
 *
 * The variable passed to tgmpa_register_plugins() should be an array of plugin
 * arrays.
 *
 * This function is hooked into tgmpa_init, which is fired within the
 * TGM_Plugin_Activation class constructor.
 */

function scFW_tgm_plugin_activation_config()
{
    $plugins = array(
        array(
            'name' => esc_html__('Regenerate Thumbnails', 'chfw-lang'),
            'slug' => 'regenerate-thumbnails',
            'required' => true,
            'force_activation' => false,

        ),

        array(
            'name' => esc_html__('Timetable and Event Schedule', 'chfw-lang'),
            'slug' => 'mp-timetable',
            'source' => CHfw_PLUGIN_DIR . '/install/mp-timetable2.1.10.zip',
            'required' => true,
            'version' => '2.1.10',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),

        array(
            'name' => esc_html__('Contact Form 7', 'chfw-lang'),
            'slug' => 'contact-form-7',
            'required' => true,
            'force_activation' => false,
        ),

        array(
            'name' => esc_html__('Nav Menu Images', 'chfw-lang'),
            'slug' => 'nav-menu-images',
            'required' => true,
            'force_activation' => false,
        ),

        array(
            'name' => esc_html__('Revolution Slider', 'chfw-lang'),
            'slug' => 'revslider',
            'source' => CHfw_PLUGIN_DIR . '/install/revslider5.4.7.zip',
            'required' => true,
            'version' => '5.4.7',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),
        array(
            'name' => esc_html__('* Visual Composer: Page Builder for WordPress', 'chfw-lang'),
            'slug' => 'js_composer',
            'source' => CHfw_PLUGIN_DIR . '/install/js_composer5.4.7.zip',
            'required' => true,
            'version' => '5.4.7',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),

        array(
            'name' => esc_html__('Booked Appointments', 'chfw-lang'),
            'slug' => 'booked',
            'source' => CHfw_PLUGIN_DIR . '/install/booked2.0.10.zip',
            'required' => true,
            'version' => '2.0.10',
            'force_activation' => false,
            'force_deactivation' => false,
            'external_url' => ''
        ),

        array(
            'name' => esc_html__('One Click Demo Import', 'chfw-lang'),
            'slug' => 'one-click-demo-import',
            'required' => true,
            'force_activation' => false,
        ),


    ); // If set, overrides default API URL and points to an external URL

    include("my_plugin.php");
    $plugins = array_merge($plugins, $My_plugins);

    /**
     * Array of configuration settings.
     * Amend each line as needed.
     * If you want the default strings to be available under your own theme domain,
     * leave the strings uncommented.
     * Some of the strings are added into a sprintf, so see the comments at the
     * end of each line for what each argument will be.
     */
    $config = array(
        'id' => 'tgmpa',
        // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',
        // Default absolute path to bundled plugins.
        'menu' => 'tgmpa-install-plugins',
        // Menu slug.
        'parent_slug' => 'themes.php',
        // Parent menu slug.
        'capability' => 'edit_theme_options',
        // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices' => true,
        // Show admin notices or not.
        'dismissable' => true,
        // If false, a user cannot dismiss the nag message.
        'dismiss_msg' => '',
        // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,
        // Automatically activate plugins after installation or not.
        'message' => '',
        // Message to output right before the plugins table.

    ); // Determines admin notice type - can only be 'updated' or 'error'


    tgmpa($plugins, $config);
}
