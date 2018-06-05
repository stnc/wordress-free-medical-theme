<?php

/**
 * ReduxFramework Barebones Sample Config File
 * For full documentation, please visit: http://docs.reduxframework.com/
 */

if (!class_exists('Redux')) {
    return;
}
global $CHfw_themeReduxOptionName;
// This is your option name where all the Redux data is stored.
$opt_name = $CHfw_themeReduxOptionName;

/**
 * ---> SET ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 * */

$theme = wp_get_theme(); // For use with some settings. Not necessary.

$args = array(
    'disable_tracking' => false,
    // TYPICAL -> Change these values as you need/desire
    'opt_name' => $opt_name,
    // This is where your data is stored in the database and also becomes your global variable name.
    'display_name' => $theme->get('Name'),
    // Name that appears at the top of your panel
    'display_version' => $theme->get('Version'),
    // Version that appears at the top of your panel
    'menu_type' => 'menu',
    //Specify if the admin menu should appear or not. Options: menu or submenu (Under appearance only)
    'allow_sub_menu' => true,
    // Show the sections below the admin menu item or not
    'menu_title' => __('Theme Settings', 'chfw-lang'),
    'page_title' => __('Theme Settings', 'chfw-lang'),
    // You will need to generate a Google API key to use this feature.
    // Please visit: https://developers.google.com/fonts/docs/developer_api#Auth
    'google_api_key' => '',
    // Set it you want google fonts to update weekly. A google_api_key value is required.
    'google_update_weekly' => false,
    // Must be defined to add google fonts to the typography module
    'async_typography' => true,
    // Use a asynchronous font on the front end or font string
    //'disable_google_fonts_link' => true,                    // Disable this in case you want to create your own google fonts loader
    'admin_bar' => false,
    // Show the panel pages on the admin bar
    'admin_bar_icon' => 'dashicons-portfolio',
    // Choose an icon for the admin bar menu
    'admin_bar_priority' => 50,
    // Choose an priority for the admin bar menu
    'global_variable' => '',
    // Set a different name for your global variable other than the opt_name
    'dev_mode' => false,
    // Show the time the page took to load, etc
    'update_notice' => false,
    // If dev_mode is enabled, will notify developer of updated versions available in the GitHub Repo
    'customizer' => false,
    // Enable basic customizer support
    //'open_expanded'     => true,                    // Allow you to start the panel in an expanded way initially.
    //'disable_save_warn' => true,                    // Disable the save warning when a user changes a field

    // OPTIONAL -> Give you extra features
    'page_priority' => null,
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_parent' => 'themes.php',
    // For a full list of options, visit: http://codex.wordpress.org/Function_Reference/add_submenu_page#Parameters
    'page_permissions' => 'manage_options',
    // Permissions needed to access the options panel.
    'menu_icon' => '',
    // Specify a custom URL to an icon
    'last_tab' => '',
    // Force your panel to always open to a specific tab (by id)
    'page_icon' => 'icon-themes',
    // Icon displayed in the admin panel next to your menu_title
    'page_slug' => '_options',
    // Page slug used to denote the panel
    'save_defaults' => true,
    // On load save the defaults to DB before user clicks save or not
    'default_show' => false,
    // If true, shows the default value next to each field that is not the default value.
    'default_mark' => '',
    // What to print by the field's title if the value shown is default. Suggested: *
    'show_import_export' => true,
    // Shows the Import/Export panel when not used as a field.

    // CAREFUL -> These options are for advanced use only
    'transient_time' => 60 * MINUTE_IN_SECONDS,
    'output' => true,
    // Global shut-off for dynamic CSS output by the framework. Will also disable google fonts output
    'output_tag' => false,
    // Allows dynamic CSS to be generated for customizer and google fonts, but stops the dynamic CSS from going to the head
    // 'footer_credit'     => '',                   // Disable the footer credit of Redux. Please leave if you can help it.

    // FUTURE -> Not in use yet, but reserved or partially implemented. Use at your own risk.
    'database' => '',
    // possible: options, theme_mods, theme_mods_expanded, transient. Not fully functional, warning!

    'use_cdn' => true,
    // If you prefer not to use the CDN for Select2, Ace Editor, and others, you may download the Redux Vendor Support plugin yourself and run locally or embed it in your code.
    'system_info' => false,
    //'compiler'             => true,

    // HINTS
    'hints' => array(
        'icon' => 'el el-question-sign',
        'icon_position' => 'right',
        'icon_color' => 'lightgray',
        'icon_size' => 'normal',
        'tip_style' => array(
            'color' => 'light',
            'shadow' => true,
            'rounded' => false,
            'style' => '',
        ),
        'tip_position' => array(
            'my' => 'top left',
            'at' => 'bottom right',
        ),
        'tip_effect' => array(
            'show' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'mouseover',
            ),
            'hide' => array(
                'effect' => 'slide',
                'duration' => '500',
                'event' => 'click mouseleave',
            ),
        ),
    )
);


// Panel Intro text -> before the form
if (!isset($args['global_variable']) || $args['global_variable'] !== false) {
    if (!empty($args['global_variable'])) {
        $v = $args['global_variable'];
    } else {
        $v = str_replace('-', '_', $args['opt_name']);
    }
    //$args['intro_text'] = sprintf( __( '<p>Did you know that Redux sets a global variable for you? To access any of your saved options from within your code you can use your global variable: <strong>$%1$s</strong></p>', 'redux-framework-demo' ), $v );
} else {
    //$args['intro_text'] = __( '<p>This text is displayed above the options panel. It isn\'t required, but more info is always better! The intro_text field accepts all HTML.</p>', 'redux-framework-demo' );
}

// Add content after the form.
//$args['footer_text'] = __( '<p>This text is displayed below the options panel. It isn\'t required, but more info is always better! The footer_text field accepts all HTML.</p>', 'redux-framework-demo' );

Redux::setArgs($opt_name, $args);

/*
 * ---> END ARGUMENTS
 */

/*
 * ---> START HELP TABS
 */

$tabs = array(
    array(
        'id' => 'redux-help-tab-1',
        'title' => __('Theme Information 1', 'redux-framework-demo'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
    ),
    array(
        'id' => 'redux-help-tab-2',
        'title' => __('Theme Information 2', 'redux-framework-demo'),
        'content' => __('<p>This is the tab content, HTML is allowed.</p>', 'redux-framework-demo')
    )
);
Redux::setHelpTab($opt_name, $tabs);

// Set the help sidebar
$content = __('<p>This is the sidebar content, HTML is allowed.</p>', 'redux-framework-demo');
Redux::setHelpSidebar($opt_name, $content);


/*
 * <--- END HELP TABS
 */


/*
 *
 * ---> START SECTIONS
 *
 */

/*

	As of Redux 3.5+, there is an extensive API. This API can be used in a mix/match mode allowing for


 */

// -> START Basic Fields
//general setting
Redux::setSection($opt_name, array(
    'title' => __('General', 'chfw-lang'),
    'icon' => 'el-icon-cog',
    'fields' => array(


        array(
            'id' => 'wp_admin_bar',
            'type' => 'switch',
            'title' => __('WordPress Admin Bar', 'chfw-lang'),
            'desc' => __('Front-end WordPress admin bar for logged-in users.', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enable',
            'off' => 'Disable'
        ),

        array(
            'id' => 'sticky_menu',
            'type' => 'switch',
            'title' => __('Sticky Position Menu', 'chfw-lang'),
            'desc' => __('Website stick and remain visible', 'chfw-lang'),
            'on' => 'Enable',
            'off' => 'Disable',
            'default' => 1,
        ),


        array(
            'id' => 'pages_lading_effect',
            'type' => 'switch',
            'title' => __('Loading effect', 'chfw-lang'),
            'on' => 'Enable',
            'off' => 'Disable',
            'default' => 0,
        ),


        array(
            'id' => 'trackingCode',
            'type' => 'textarea',
            'title' => __('Tracking Code', 'chfw-lang'),
            'compiler' => 'true',
            'mode' => false,
            // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Add you tracking / analytics code here', 'chfw-lang')
        ),

        array(
            'id' => 'my_custom_css',
            'type' => 'textarea',
            'title' => __('My Custom Css', 'chfw-lang'),
            'compiler' => 'true',
            'mode' => false,
            // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Add you css code --- Please do not put it (<style></style>)', 'chfw-lang')
        ),

        array(
            'id' => 'copyrights',
            'type' => 'textarea',
            'title' => __('Copyrights', 'chfw-lang'),
            'compiler' => 'true',
            'mode' => false,
            // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Add you copyrights , this will be printed in footer section .', 'chfw-lang')
        ),
        array(
            'id' => 'locationGmapApiKey',
            'type' => 'text',
            'title' => __('Google Map API Key', 'chfw-lang'),
            'desc' => __('If you wish to use google fonts you need to paste your google api key here , <br /><br /><b>Get Your API Key :</b><br /> 1- Click on create project <br /> 2- From the left menu click on <b>Credential</b> <br />3- Under <b>Public API access </b> click on <b>CREATE NEW KEY</b> <br />4- From the popup window click on <b>Browser Key</b> and enter your website and hit create . <br />5- Copy and paste the API key here and save .', 'chfw-lang'),


            'default' => ''
        ),


    )
));
Redux::setSection($opt_name, array(
    'title' => __('Typography', 'chfw-lang'),
    'icon' => 'el-icon-font',
    'fields' => array(
        // Main font
        array(
            'id' => 'main_font_info',
            'type' => 'info',
            'icon' => true,
            'raw' => '<h3 class="redux_info">' . __('Main Font', 'chfw-lang') . '</h3>',
        ),
        array(
            'id' => 'main_font_source',
            'type' => 'radio',
            'title' => __('Font Source', 'chfw-lang'),
            'options' => array(
                '1' => 'Standard + Google Webfonts',
                '2' => 'Adobe Typekit',
            ),
            'default' => '1'
        ),
        // Main font: Standard + Google Webfonts
        array(
            'id' => 'main_font',
            'type' => 'typography',
            'title' => __('Font Face', 'chfw-lang'),
            'line-height' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-size' => false,
            'color' => false,
            'default' => array(
                'font-family' => 'Roboto Condensed',
                'subsets' => '',
            ),
            'required' => array('main_font_source', '=', '1')
        ),
        // Main font: Adobe Typekit
        array(
            'id' => 'main_font_typekit_kit_id',
            'type' => 'text',
            'title' => __('Typekit Kit ID', 'chfw-lang'),
            'desc' => __('Enter your Typekit Kit ID for the Main Font.', 'chfw-lang'),
            'default' => '',
            'required' => array('main_font_source', '=', '2')
        ),

        // Secondary font
        array(
            'id' => 'secondary_font_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Secondary Font', 'chfw-lang') . '</h3>',
        ),
        array(
            'id' => 'secondary_font_source',
            'type' => 'radio',
            'title' => __('Font Source', 'chfw-lang'),
            'options' => array(
                '0' => '(none)',
                '1' => 'Standard + Google Webfonts',
                '2' => 'Adobe Typekit',

            ),
            'default' => '0'
        ),
        // Secondary font: Standard + Google Webfonts
        array(
            'id' => 'secondary_font',
            'type' => 'typography',
            'title' => __('Font Face', 'chfw-lang'),
            'line-height' => false,
            'text-align' => false,
            'font-style' => false,
            'font-weight' => false,
            'font-size' => false,
            'color' => false,
            'default' => array(
                'font-family' => 'Roboto Condensed',
                'subsets' => '',
            ),
            'required' => array('secondary_font_source', '=', '1')
        ),
        // Secondary font: Adobe Typekit
        array(
            'id' => 'secondary_font_typekit_kit_id',
            'type' => 'text',
            'title' => __('Typekit Kit ID', 'chfw-lang'),
            'desc' => __('Enter your Typekit Kit ID for the Secondary Font.', 'chfw-lang'),
            'default' => '',
            'required' => array('secondary_font_source', '=', '2')
        ),
        array(
            'id' => 'secondary_typekit_font',
            'type' => 'text',
            'title' => __('Typekit Font Face', 'chfw-lang'),
            'desc' => __('Example: actor', 'chfw-lang'),
            'default' => '',
            'required' => array('secondary_font_source', '=', '2')
        ),
        // Secondary font: Fontdeck
        array(
            'id' => 'secondary_font_fontdeck_info',
            'type' => 'info',
            'style' => 'info',
            'desc' => __('Fontdeck: No need to specify a secondary font for Fontdeck. Edit your Fontdeck CSS instead.', 'chfw-lang'),
            'required' => array('secondary_font_source', '=', '3')
        )
    )
));


// Home Page Settings
Redux::setSection($opt_name, array(
    'title' => __('Home Settings', 'chfw-lang'),
    'desc' => __('You can upload your own website logo , fav icon , tracking code ..', 'chfw-lang'),
    'icon' => 'el-icon-home',
    'fields' => array(


        array(
            'id' => 'logo',
            'type' => 'media',
            'title' => __('Logo', 'chfw-lang'),
            'compiler' => 'true',
            'mode' => false,
            // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your own logo Note:  You can change logo margin from Theme Style Settings', 'chfw-lang'),
            'default' => array(
                'url' => esc_url(get_stylesheet_directory_uri()) . '/assets/logo@2x.png',
            ),

        ),
        array(
            'id' => 'mobile-logo',
            'type' => 'media',
            'title' => __('Mobile Menu Logo', 'chfw-lang'),
            'compiler' => 'true',
            'mode' => false,
            // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your own logo Note:  You can change logo margin from Theme Style Settings', 'chfw-lang'),
            'default' => array(
                'url' => esc_url(get_stylesheet_directory_uri()) . '/assets/logo@2x.png',
            ),

        ),


        array(
            'id' => 'favicon',
            'type' => 'media',
            'title' => __('FavIcon', 'chfw-lang'),
            'compiler' => 'true',
            'mode' => false,
            // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Upload your own favicon .', 'chfw-lang'),
            'default' => array(
                'url' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/favicon.png',
            ),
        ),


        array(
            'id' => 'header_text',
            'type' => 'textarea',
            'title' => __('Header', 'chfw-lang'),
            'compiler' => 'true',
            'mode' => false,
            // Can be set to false to allow any media type, or can also be set to any mime type.
            'desc' => __('Header Text', 'chfw-lang')
        ),


    )

));


Redux::setSection($opt_name, array(
    'title' => __('Header and Footer Settings', 'chfw-lang'),
    'desc' => __('Header and Footer settings .. ', 'chfw-lang'),
    'icon' => 'el-icon-pencil',
    'fields' => array(
        array(
            'id' => 'header_type_selected',
            'type' => 'image_select',
            'title' => __('Header type', 'chfw-lang'),
            'options' => array(
                'standard' => array(
                    'alt' => 'Header Standard',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_full64.png'
                ),

                'minimal' => array(
                    'alt' => 'Header minimal ',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_minimal_64.png'
                ),
                'top_minimal' => array(
                    'alt' => 'Header Top Minimal ',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/header/header_top_minimal_64.png'
                ),

            ),
            'default' => 'standard'

        ),
        array(
            'id' => 'footer_type_selected',
            'type' => 'image_select',
            'title' => __('Footer type', 'chfw-lang'),
            'subtitle' => __('Select footer type', 'chfw-lang'),
            'options' => array(
                'big' => array(
                    'alt' => 'Footer big ',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/footer/footer_big.png'
                ),

                'standard' => array(
                    'alt' => 'Footer Standard ',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/footer/footer_standart.png'
                ),

                'minimal' => array(
                    'alt' => 'Footer Fixed ',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/footer/footer_minimal.png'
                ),
                'no' => array(
                    'alt' => 'Footer Fixed ',
                    'img' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/footer/footer_no.png'
                ),

            ),
            'default' => 'standard',

        ),

    )));
Redux::setSection($opt_name, array(
    'title' => __('Mobil Menu Settings', 'chfw-lang'),
    'desc' => __('Edit Mobil Menu Settings .. ', 'chfw-lang'),
    'icon' => 'el-icon-pencil-alt',

    'fields' => array(
        array(
            'id' => 'mobil_menu_Settings_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Edit Mobil Menu Settings', 'chfw-lang') . '</h3>',
        ),

        array(
            'id' => 'mobil_menu_LayoutSelect',
            'type' => 'select',
            'title' => __('View Layout', 'chfw-lang'),
            'subtitle' => __('Select view layout', 'chfw-lang'),
            'options' => array(
                'simple' => 'Simple',
                'advanced' => 'Advanced',
            ),
            'default' => 'advanced'
        ),

    )
));
include("Skin_MakeDefault.php");
include("SkinGenerator.php");


Redux::setSection($opt_name, array(
    'title' => __('Social Media Settings', 'chfw-lang'),
    'desc' => __('Edit social icons link , add twitter secret keys .. etc', 'chfw-lang'),
    'icon' => 'el-icon-twitter',
    'fields' => array(
        array(
            'id' => 'facebook',
            'type' => 'text',
            'title' => __('Facebook Page Name', 'chfw-lang'),
            'desc' => __('You can add your Facebook page name here .', 'chfw-lang'),
            'default' => 'facebook'
        ),


        array(
            'id' => 'twitter',
            'type' => 'text',
            'title' => __('Twitter', 'chfw-lang'),
            'desc' => __('You can add your Twitter page name here .', 'chfw-lang'),

        ),


        array(
            'id' => 'flickr',
            'type' => 'text',
            'title' => __('Flickr', 'chfw-lang'),
            'desc' => __('You can add your Flickr url .', 'chfw-lang'),

        ),

        array(
            'id' => 'pinterest',
            'type' => 'text',
            'title' => __('Pinterest', 'chfw-lang'),
            'desc' => __('You can add your Pinterest  url', 'chfw-lang'),

        ),

        array(
            'id' => 'googleplus',
            'type' => 'text',
            'title' => __('Google Plus', 'chfw-lang'),
            'desc' => __('You can add your googleplus url', 'chfw-lang'),

        ),

        array(
            'id' => 'instagram',
            'type' => 'text',
            'title' => __('Instagram', 'chfw-lang'),
            'desc' => __('You can add your instagram url', 'chfw-lang'),

        ),

        array(
            'id' => 'rss',
            'type' => 'text',
            'title' => __('RSS', 'chfw-lang'),
            'desc' => __('You can add your RSS url.', 'chfw-lang'),
            'default' => '#'
        ),


        array(
            'id' => 'youtube',
            'type' => 'text',
            'title' => __('Youtube', 'chfw-lang'),
            'desc' => __('You can add your Youtube channel url', 'chfw-lang'),
            'default' => '#'
        ),


        array(
            'id' => 'linkedin',
            'type' => 'text',
            'title' => __('Linkedin', 'chfw-lang'),
            'desc' => __('You can add your Linkedin  url', 'chfw-lang'),
            'default' => '#'
        ),


        array(
            'id' => 'tumblr',
            'type' => 'text',
            'title' => __('Tumblr', 'chfw-lang'),
            'desc' => __('You can add your tumblr url', 'chfw-lang'),
            'default' => '#'
        ),

        array(
            'id' => 'vimeo',
            'type' => 'text',
            'title' => __('Vimeo', 'chfw-lang'),
            'desc' => __('You can add your vimeo url', 'chfw-lang'),
            'default' => '#'
        ),
        array(
            'id' => 'soundcloud',
            'type' => 'text',
            'title' => __('Soundcloud', 'chfw-lang'),
            'desc' => __('You can add your soundcloud url', 'chfw-lang'),
            'default' => '#'
        ),


        array(
            'id' => 'skype',
            'type' => 'text',
            'title' => __('Skype', 'chfw-lang'),
            'desc' => __('You can add your skype url', 'chfw-lang'),
            'default' => '#'
        ),


        array(
            'id' => 'github',
            'type' => 'text',
            'title' => __('Github', 'chfw-lang'),
            'desc' => __('You can add your Github url', 'chfw-lang'),
            'default' => '#'
        ),


        array(
            'id' => 'dribbble',
            'type' => 'text',
            'title' => __('Dribbble', 'chfw-lang'),
            'desc' => __('You can add url .', 'chfw-lang'),
            'default' => '#'
        ),
    )
));

//shop conf include

Redux::setSection($opt_name, array(
    'title' => __('Pages Settings', 'chfw-lang'),
    'desc' => __('Edit page settings .. ', 'chfw-lang'),
    'icon' => 'el-icon-pencil-alt',
    'fields' => array(
        array(
            'id' => 'PageSettings_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Main Page Setting', 'chfw-lang') . '</h3>',
        ),

        array(
            'id' => 'main_blog_layout',
            'type' => 'image_select',
            'title' => __('Main Page Layout', 'chfw-lang'),
            'subtitle' => __('Select main blog layout ,Chooose between 1,2 or 3 column layout', 'chfw-lang'),
            'options' => array(
                'full' => array(
                    'alt' => 'full',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'right' => array(
                    'alt' => 'right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'left' => array(
                    'alt' => 'left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
            ),
            'default' => 'full'
        ),


        array(
            'id' => 'masonry_page_columns',
            'type' => 'image_select',
            'title' => __('Masonry Page Columns', 'chfw-lang'),
            'subtitle' => __('Select blog columns ', 'chfw-lang'),
            'options' => array(
                'col2' => array(
                    'alt' => 'COl2  ',
                    'img' => ReduxFramework::$_url . 'assets/img/blog_col2.png'
                ),
                'col3' => array(
                    'alt' => 'Col3 ',
                    'img' => ReduxFramework::$_url . 'assets/img/blog_col3.png'
                ),

            ),
            'default' => 'col2',

        ),


        array(
            'id' => 'sidebar_status',
            'type' => 'select',
            'title' => __('Sidebar Status', 'chfw-lang'),
            'desc' => __('Sidebar is hidden by default , you can select on the following options for the sidebar : <br /> 1- Sidebar Hidden , and users can toggle it <br />2- Sidebar Visible , and users can toggle it . <br />3- Sidebar Always Visible , and users can hide the sidebar', 'chfw-lang'),
            'options' => array(
                '1' => 'Sidebar Hidden',
                '2' => 'Sidebar Visible',
                '3' => 'Sidebar Always Visible'
            ),
            'default' => '1'

        ),
        array(
            'id' => 'hide_sidebar_button',
            'type' => 'switch',
            'title' => __('Hide Sidebar Button', 'chfw-lang'),
            'desc' => __('You can hide sidebar toggle button , By default sidebar toggle button is visible .', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enabled',
            'off' => 'Disabled'
        ),


        array(
            'id' => 'product_quickview_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Archive Page Setting', 'chfw-lang') . '</h3>',
        ),


        array(
            'id' => 'archive_page_blog_layout',
            'type' => 'image_select',
            'title' => __('Archive Page Layout', 'chfw-lang'),
            'subtitle' => __('Select archive layout ,Chooose between 1,2 or 3 column layout', 'chfw-lang'),
            'options' => array(
                'full' => array(
                    'alt' => 'full ',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'right' => array(
                    'alt' => 'right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'left' => array(
                    'alt' => 'left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
            ),
            'default' => 'right'
        ),


        array(
            'id' => 'archive_view_style',
            'type' => 'select',
            'title' => __('Archive Main Style', 'chfw-lang'),
            'desc' => __('How do your archive posts display', 'chfw-lang'),
            'options' => array(
                'list' => 'List',
                'list_small' => 'Small List',
                'masonry' => 'Masonry',

                'timeline' => 'Timeline',

            ),
            'default' => 'timeline'
        ),


        array(
            'id' => 'pagination_blog_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Pagination  Setting', 'chfw-lang') . '</h3>',
        ),


        array(
            'id' => 'blog_pagination_type',
            'type' => 'select',
            'title' => __('Pagination Type ', 'chfw-lang'),
            'desc' => __('Configure pagination  product loading.', 'chfw-lang'),
            'options' => array(
                'numeric' => 'Numeric Pagination',
                'ajax' => 'Ajax Pagination',
            ),
            'default' => 'ajax',

        ),

        array(
            'id' => 'blog_pagination_type_ajax',
            'type' => 'image_select',
            'title' => __('Pagination Type ', 'chfw-lang'),
            'desc' => __('Ajax pagination  product loading.', 'chfw-lang'),
            'options' => array(
                'ajax' => array(
                    'alt' => 'ajax ',
                    'img' => ReduxFramework::$_url . 'assets/img/ajaxpagination-logo1.jpg'
                )
            ),
            'default' => 'ajax',
            'required' => array('blog_pagination_type', 'equals', array('ajax')),


            // https://gist.github.com/dovy/6478863

        ),

        array(
            'id' => 'blog_order',
            'type' => 'select',
            'title' => __('Order Posts By', 'chfw-lang'),
            'desc' => __('Order posts by comments count or date', 'chfw-lang'),
            'options' => array(
                'date' => 'Date',
                'comment_count' => 'Comment Count'
            ),
            'default' => 'date'
        ),

        array(
            'id' => 'limit_posts',
            'type' => 'slider',
            'title' => __('Limit Blog Posts', 'chfw-lang'),
            'desc' => __('Click and hold mouse button to Limit similar posts number or increase / decrease value..', 'chfw-lang'),
            'default' => '5',
            "min" => "1",
            "step" => "1",
            "max" => "50"
        ),

        array(
            'id' => 'pages_setting_mobil_sidebar_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Mobile and tablet view settings in sidebar', 'chfw-lang') . '</h3>',
        ),

        array(
            'id' => 'main_page_sidebar_mobile_view',
            'type' => 'switch',
            'title' => __('Hide the sidebar in mobile view?', 'chfw-lang'),
            'desc' => '',
            'default' => 1,
            'on' => 'Enable',
            'off' => 'Disable'
        ),

        array(
            'id' => 'main_page_sidebar_tablet_view',
            'type' => 'switch',
            'title' => __('Hide the sidebar in tablet  view?', 'chfw-lang'),
            'desc' => '',
            'default' => 1,
            'on' => 'Enable',
            'off' => 'Disable'
        ),

    )
));


Redux::setSection($opt_name, array(
    'title' => __('Posts Settings', 'chfw-lang'),
    'desc' => __('Edit post (blog) settings .. ', 'chfw-lang'),
    'icon' => 'el-icon-pencil',
    'fields' => array(
        array(
            'id' => 'pages_list_type_blog_layouts',
            'type' => 'image_select',
            'title' => __('Post List Layout Type', 'chfw-lang'),
            'subtitle' => __('Select  blog layout ,chooose between zigzag page,blog list_page,timeline page or masonry page column layout', 'chfw-lang'),
            'options' => array(
                'full' => array(
                    'alt' => 'full ',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'right' => array(
                    'alt' => 'right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'left' => array(
                    'alt' => 'left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
            ),
            'default' => 'left'
        ),

        array(
            'id' => 'post_single_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Single Blog Setting', 'chfw-lang') . '</h3>',
        ),


        array(
            'id' => 'single_blog_layout',
            'type' => 'image_select',
            'title' => __('Single Blog Layout', 'chfw-lang'),
            'subtitle' => __('Select archive layout ,Chooose between 1,2 or 3 column layout', 'chfw-lang'),
            'options' => array(
                'full' => array(
                    'alt' => 'full ',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'right' => array(
                    'alt' => 'right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'left' => array(
                    'alt' => 'left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
            ),
            'default' => 'right'
        ),

        array(
            'id' => 'postpages_setting_mobil_sidebar_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Mobile and tablet view settings in sidebar', 'chfw-lang') . '</h3>',
        ),

        array(
            'id' => 'postpages_sidebar_mobile_view',
            'type' => 'switch',
            'title' => __('Hide the sidebar in mobile view?', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enable',
            'off' => 'Disable'
        ),

        array(
            'id' => 'postpages_sidebar_tablet_view',
            'type' => 'switch',
            'title' => __('Hide the sidebar in tablet view?', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enable',
            'off' => 'Disable'
        ),


        array(
            'id' => 'post_single_social_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Social Media Setting', 'chfw-lang') . '</h3>',
        ),
        array(
            'id' => 'enable_list_facebook_like',
            'type' => 'switch',
            'title' => __('Enable Facebook Like', 'chfw-lang'),
            'desc' => __('You can enable / disable share post section.', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enabled',
            'off' => 'Disabled'
        ),

        array(
            'id' => 'enable_list_socialShare',
            'type' => 'switch',
            'title' => __('Enable Social Share in Posts', 'chfw-lang'),
            'desc' => __('You can enable / disable share post section.', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enabled',
            'off' => 'Disabled'
        ),
        array(
            'id' => 'blog_social_share_icons_enable_disable',
            'type' => 'checkbox',
            'title' => __('Blog Social Share Icons Enable Disable', 'chfw-lang'),
            'desc' => __('Blog Social Share Icons Enable Disable', 'chfw-lang'),

            //Must provide key => value pairs for multi checkbox options
            'options' => array(
                'facebook' => 'Facebook',
                'twitter' => 'Twitter',
                'intagram' => 'Intagram',
                'gplus' => 'Google Plus',
                'pinterest' => 'Pinterest',
                'flick' => 'Flick',
                'linkedin' => 'Linkedin',
                'mail' => 'Email',
            ),

            //See how default has changed? you also don't need to specify opts that are 0.
            'default' => array(
                'facebook' => '1',
                'twitter' => '1',
                'intagram' => '1',
                'gplus' => '1',
                'pinterest' => '1',
                'flick' => '1',
                'linkedin' => '0',
                'mail' => '0',
            ),
            'required' => array('enable_list_socialShare', '=', '1')
        ),
        array(
            'id' => 'post_single_other_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Other Blog Settings', 'chfw-lang') . '</h3>',
        ),


        array(
            'id' => 'image_overlay_type',
            'type' => 'select',
            'title' => __('Image Overlay Hover Effects Type', 'chfw-lang'),
            'desc' => __('Configure Image Overlay Hover Effect Type', 'chfw-lang'),
            'options' => array(
                'overlay-image_slide-in-bottom' => 'SLIDE IN BOTTOM',
                'overlay-image_slide-in-top' => 'SLIDE IN TOP',
                'overlay-image_slide-in-left' => 'SLIDE IN LEFT',
                'overlay-image_slide-in-right' => 'SLIDE IN RIGHT',
                'overlay-image_icon-border-animate' => 'ICON BORDER ANIMATE',
                'overlay-image_icon-bounce-in' => 'ICON BOUNCE IN',
                'none-iamge' => 'NONE',
            ),
            'default' => 'overlay-image_icon-bounce-in'
        ),
        array(
            'id' => 'enable_readmore',
            'type' => 'switch',
            'title' => __('Enable Read More Button', 'chfw-lang'),
            'desc' => __('You can disable / enable read more button', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enabled',
            'off' => 'Disabled'
        ),

        array(
            'id' => 'readmore_text',
            'type' => 'text',
            'title' => __('Read More Text', 'chfw-lang'),
            'default' => 'Read More',
            'required' => array('enable_readmore', '=', '1')
        ),

        array(
            'id' => 'enable_author_section',
            'type' => 'switch',
            'title' => __('Enable Author Section', 'chfw-lang'),
            'desc' => __('You can disable / enable about author section', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enabled',
            'off' => 'Disabled'
        ),

        array(
            'id' => 'blog_show_full_posts',
            'type' => 'switch',
            'title' => __('Show Full Posts', 'chfw-lang'),
            'desc' => __('Show full posts on blog listing ,if not selected, see short summary', 'chfw-lang'),
            'default' => 0,
            'on' => 'Enable',
            'off' => 'Disable'
        ),

        array(
            'id' => 'related_posts_system_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Related Posts', 'chfw-lang') . '</h3>',
        ),

        array(
            'id' => 'enable_related_posts',
            'type' => 'switch',
            'title' => __('Enable Related Posts', 'chfw-lang'),
            'desc' => __('You can enable / disable similar posts section .', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enabled',
            'off' => 'Disabled'
        ),

        array(
            'id' => 'related_post_type',
            'type' => 'select',
            'title' => __('View Type', 'chfw-lang'),
            'options' => array(
                'pictures' => 'Pictures',
                'list' => 'List'
            ),
            'default' => 'pictures',
            'required' => array('enable_related_posts', '=', '1')

        ),

        array(
            'id' => 'related_posts_option',
            'type' => 'select',
            'title' => __('List Type', 'chfw-lang'),
            'desc' => __('You can select if similar posts are in the same category or have the same post tags .', 'chfw-lang'),
            'options' => array(
                'category' => 'Category',
                'tags' => 'Tags'
            ),
            'default' => 'category',
            'required' => array('enable_related_posts', '=', '1')
        ),

        array(
            'id' => 'related_posts_limit',
            'type' => 'slider',
            'title' => __('Limit Related Posts', 'chfw-lang'),
            'desc' => __('Click and hold mouse button to Limit similar posts number or increase / decrease value', 'chfw-lang'),
            'default' => '4',
            "min" => "1",
            "step" => "1",
            "max" => "15",
            'required' => array('enable_related_posts', '=', '1')
        ),

        array(
            'id' => 'Comments System_system_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Comments System', 'chfw-lang') . '</h3>',
        ),
        array(
            'id' => 'enable_comments',
            'type' => 'switch',
            'title' => __('Enable Comments Section', 'chfw-lang'),
            'desc' => __('You can enable / disable comments section entirely , including approved comments and comments form.', 'chfw-lang'),
            'default' => 1,
            'on' => 'Enabled',
            'off' => 'Disabled'
        ),

        array(
            'id' => 'comments_system',
            'type' => 'select',
            'title' => __('Select Comments', 'chfw-lang'),
            'desc' => __('You can choose between Wordpress comments system , Facebook , And Disqus', 'chfw-lang'),
            'options' => array(
                'wp' => 'Wordpress Default Comments',
                'disqus' => 'Disqus',
                'facebook' => 'Facebook'
            ),
            'default' => 'wp'

        ),


        array(
            'id' => 'disqus_shortname',
            'type' => 'text',
            'title' => __('Disqus Shortname', 'chfw-lang'),
            'desc' => __('Add your disqus shortname , For example <f>http://shortname.disqus.com</b>', 'chfw-lang'),
            'default' => 'http-chromatin-chromthemes-com-1',
            'required' => array('comments_system', '=', 'disqus')

        ),


        array(
            'id' => 'facebook_app_id',
            'type' => 'text',
            'title' => __('Facebook App ID', 'chfw-lang'),
            'desc' => __('Add your facebook app ID here , To get you facebook App ID : <br> 1- Login in  2- Click on "Apps" from the top menu  <br> 3- You can create a new application or select the current active application <br> 4- On the App page copy the "App ID" and paste it here .', 'chfw-lang'),
            'default' => '1772955066289016',
            'required' => array('comments_system', '=', 'facebook')

        ),
        array(
            'id' => 'facebook_comments_count',
            'type' => 'slider',
            'title' => __('Facebook Comments Count', 'chfw-lang'),
            'desc' => __('Select number of comments  display at facebook comments, default number is 5.', 'chfw-lang'),
            'default' => '5',
            "min" => "1",
            "step" => "1",
            "max" => "1000",
            'required' => array('comments_system', '=', 'facebook')
        ),
        array(
            'id' => 'facebook_comments_theme',
            'type' => 'select',
            'title' => __('Facebook Comments Theme', 'chfw-lang'),
            'desc' => __('You can choose between dark and light skins', 'chfw-lang'),
            'options' => array(
                'dark' => 'Dark',
                'light' => 'Light'
            ),
            'default' => 'light',
            'required' => array('comments_system', '=', 'facebook')

        ),

        array(
            'id' => 'facebook_comments_width',
            'type' => 'text',
            'title' => __('Facebook container comments width', 'chfw-lang'),
            'default' => '650px',
            'required' => array('comments_system', '=', 'facebook')

        ),


    )
));


Redux::setSection($opt_name, array(
    'title' => __('404 Page setting', 'chfw-lang'),
    'desc' => __('Edit 404 page ', 'chfw-lang'),
    'icon' => 'el-icon-remove-sign',
    'fields' => array(

        array(
            'id' => 'archive_title',
            'type' => 'textarea',
            'title' => __('Archive Page Title', 'chfw-lang'),
            'desc' => __('You can add your own archive page title here ..  Important :you need to add $ to the title , it will present the search query .. i.e Search Results For ', 'chfw-lang')

        ),
        array(
            'id' => 'error404',
            'type' => 'textarea',
            'title' => __('404 Error Message', 'chfw-lang'),
            'desc' => __('You can add your own 404 page message here .. ', 'chfw-lang')

        ),


    )
));

Redux::setSection($opt_name, array(
    'title' => __('Search Page Setting', 'chfw-lang'),
    'desc' => __('Edit search page', 'chfw-lang'),
    'icon' => 'el-icon-search-alt',

    'fields' => array(


        array(
            'id' => 'ajax_search',
            'type' => 'switch',
            'title' => __('Ajax Search Enable / Disable ', 'chfw-lang'),
            'desc' => __('Ajax Search Enable / Disable', 'chfw-lang'),
            'on' => 'Enable',
            'off' => 'Disable',
            'default' => 1,
        ),

        array(
            'id' => 'search_blog_layout',
            'type' => 'image_select',
            'title' => __('Search Page Layout', 'chfw-lang'),
            'subtitle' => __('Select search page layout ,Chooose between 1,2 or 3 column layout', 'chfw-lang'),
            'options' => array(
                'full' => array(
                    'alt' => 'full ',
                    'img' => ReduxFramework::$_url . 'assets/img/1col.png'
                ),
                'right' => array(
                    'alt' => 'right',
                    'img' => ReduxFramework::$_url . 'assets/img/2cl.png'
                ),
                'left' => array(
                    'alt' => 'left',
                    'img' => ReduxFramework::$_url . 'assets/img/2cr.png'
                ),
            ),
            'default' => 'full'
        ),


        array(
            'id' => 'search_loading_text',
            'type' => 'textarea',
            'title' => __('Search Loading Text', 'chfw-lang'),
            'desc' => __('You can add your own search loading text here ...  <br />', 'chfw-lang')
        ),

        array(
            'id' => 'search_title',
            'type' => 'textarea',
            'title' => __('Search Page Title', 'chfw-lang'),
            'desc' => __('You can add your own search page title here .. , <br /><b>Important :</b> you need to add $ to the title , it will present the search query .. i.e Search Results For $', 'chfw-lang')

        ),
        array(
            'id' => 'search_error',
            'type' => 'textarea',
            'title' => __('No Search Results Message', 'chfw-lang'),
            'desc' => __('If there is no search results found , this message will appear .. ', 'chfw-lang')

        ),

        array(
            'id' => 'searchform_message',
            'type' => 'textarea',
            'title' => __('Placeholder for Search Form', 'chfw-lang'),
            'desc' => __('Placeholder for search form widget , i.e Type and hit enter ..  ', 'chfw-lang')

        ),


    )
));


// -> START Basic Fields
Redux::setSection($opt_name, array(
    'title' => __('Hospital', 'chfw-lang'),
    'id' => 'hospital',
    'desc' => __('Hospital Options', 'chfw-lang'),
    'customizer_width' => '400px',
    'icon' => 'el el-home'
));


Redux::setSection($opt_name, array(
    'title' => __('Staff Settings', 'chfw-lang'),
    'desc' => __('Edit staff settings .. ', 'chfw-lang'),
    'icon' => 'el-icon-pencil-alt',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'Page_staff_Settings_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Main Page Setting', 'chfw-lang') . '</h3>',
        ),

        array(
            'id' => 'staff_main_layout',
            'type' => 'image_select',
            'title' => __('View Layout', 'chfw-lang'),
            'subtitle' => __('Select view layout ,Choose between stack or Left Align column layout', 'chfw-lang'),
            'options' => array(
                'stack' => array(
                    'alt' => 'Stack',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/stack.jpg'
                ),
                'left_align' => array(
                    'alt' => 'Left',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/left.jpg'
                ),
                'mini_list' => array(
                    'alt' => 'mini list',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/mini.jpg'
                ),

            ),
            'default' => 'stack'
        ),


        array(
            'id' => 'staff_pagination_type',
            'type' => 'select',
            'title' => __('Pagination Type ', 'chfw-lang'),
            'desc' => __('Configure pagination  product loading.', 'chfw-lang'),
            'options' => array(
                'numeric' => 'Numeric Pagination',
                'ajax' => 'Ajax Pagination',
            ),
            'default' => 'ajax',

        ),


    )
));
Redux::setSection($opt_name, array(
    'title' => __('Departmens Settings', 'chfw-lang'),
    'desc' => __('Edit departmens settings .. ', 'chfw-lang'),
    'icon' => 'el-icon-pencil-alt',
    'subsection' => true,
    'fields' => array(
        array(
            'id' => 'Page_Departmens_Settings_info',
            'icon' => true,
            'type' => 'info',
            'raw' => '<h3 class="redux_info">' . __('Departmens Page Setting', 'chfw-lang') . '</h3>',
        ),

        array(
            'id' => 'DepartmanPageLayoutSelect',
            'type' => 'image_select',
            'title' => __('View Layout', 'chfw-lang'),
            'subtitle' => __('Select view layout ,Choose between stack or Left Align column layout', 'chfw-lang'),
            'options' => array(
                'one' => array(
                    'alt' => 'l1',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/l11.jpg'
                ),
                'two' => array(
                    'alt' => 'l2',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/l22.jpg'
                ),
                'three' => array(
                    'alt' => 'l3',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/l3.jpg'
                ),
                'four' => array(
                    'alt' => 'l3',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/l44.jpg'
                ),
                'five' => array(
                    'alt' => 'l3',
                    'img' => ReduxFramework::$_url . 'assets/img/staff/l55.jpg'
                ),

            ),
            'default' => 'five'
        ),

        array(
            'id' => 'DepartmanPageDo_not_look_blank_',
            'type' => 'select',
            'title' => __('Do not look blank', 'chfw-lang'),
            'options' => array(
                0 => 'Visible',
                1 => 'Show',
            ),
            'default' => 'show',
            'required' => array('DepartmanPageLayoutSelect', '=', 'five')
        ),
    )
));

/*redux framwork post per page hook-- for /wp-admin/options-reading.php */
add_action('redux/options/wow_themes/saved', 'redux_ch_hook');
function redux_ch_hook()
{
    global $CHfw_themeReduxOptionName;
    $CHfw_rdx_options = get_option($CHfw_themeReduxOptionName);
    $new_limit = $CHfw_rdx_options['limit_posts'];
    //$new_limit=$_POST['wow_themes']['limit_posts'];
    update_option('posts_per_page', $new_limit);
}

// Remove dashboard widget
function ch_redux_remove_dashboard_widget()
{
    remove_meta_box('redux_dashboard_widget', 'dashboard', 'side');
}

add_action('wp_dashboard_setup', 'ch_redux_remove_dashboard_widget', 100);


