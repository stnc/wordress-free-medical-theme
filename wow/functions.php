<?php
ob_start();
// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}


define( 'NAMESPACE', 'CHfw' );//CHROM framework --> CHfw
// Theme version
define( 'THEME_VERSION', '3.1' );

define( 'CHfw_PLUGIN_DIR', get_template_directory() . '/includes/plugins' );
define( 'CHfw_DIR', get_template_directory() . '/includes' );
define( 'CHfw_URI', get_template_directory_uri() . '/includes' );
define( 'CHfw_THEME_DIR', get_template_directory() );
define( 'CHfw_THEME_URL', get_template_directory_uri() );


$CHfw_themeSettingsOptions         = 'wow_themes_settings';//first install info theme information (option name)
$CHfw_defaultwowSkin               = "Hospital";//important uses raidum import
$CHfw_themeCurrentSkin_option_name = 'wow_theme_current_skin'; //current (option name)
$CHfw_meta_key                     = 'wowPostSetting'; //uses to  includes/theme-options/class-metabox.php and  function --> CHfw_get_meta( ) -->  postmeta name
$CHfw_themeCurrentSkin             = get_option( $CHfw_themeCurrentSkin_option_name );
$CHfw_themeReduxOptionName         = CHfw_skinSelector();//redux name (option name)
$CHfw_placeholder_image            = get_template_directory_uri() . '/assets/images/placeholder/placeholder_catalog_image.jpg';// change this to the URL to your custom placeholder
global $CHfw_rdx_options;
$scFW_globals = array();
// Global: Theme globals
$scFW_globals['is_archive_page_ref'] = false;
$scFW_globals['is_search_page_ref']  = false;


// Global: Visual composer "stock" features
global $CHfw_vcomposer_stock;

$CHfw_vcomposer_stock = ( defined( 'CHFW_VCOMP_STOCK' ) ) ? true : false;


$CHfw_woocommerce_enabled = ( class_exists( 'WooCommerce' ) ) ? true : false;

/* Check if WooCommerce is activated */
function CHfw_woocommerce_activated() {
	global $CHfw_woocommerce_enabled;

	return $CHfw_woocommerce_enabled;
}

/* --------------------------------------------------------------
 	Redux skin name selected
-------------------------------------------------------------- */
function CHfw_skinSelector() {
	global $CHfw_themeCurrentSkin_option_name;

	$CHfw_themeCurrentSkin = get_option( $CHfw_themeCurrentSkin_option_name );
	if ( $CHfw_themeCurrentSkin != '' ) {
		if ( $CHfw_themeCurrentSkin == 'MaterialDesign' ) {
			$CHfw_themeReduxOptionName = 'wow_themes';//??
		} else {
			$CHfw_themeReduxOptionName = 'wow_themes_' . $CHfw_themeCurrentSkin;
		}
	} else {
		$CHfw_themeReduxOptionName = 'wow_themes';//redux name (option name)
	}

	return $CHfw_themeReduxOptionName;
}

/* Includes
=============================================================== */
include( "includes/live_config.php" );


/* Redux Framework
=============================================================== */


// Redux: Theme options framework
if ( ! class_exists( 'ReduxFramework' ) ) {
	require_once( CHfw_PLUGIN_DIR . '/ReduxCore/framework.php' );

	// Remove dashboard widget
	function CHfw_redux_remove_dashboard_widget() {
		remove_meta_box( 'redux_dashboard_widget', 'dashboard', 'side' );
	}

	add_action( 'wp_dashboard_setup', 'CHfw_redux_remove_dashboard_widget', 100 );


	// REMOVE REDUX MESSAGES
	function CHfw_remove_redux_messages() {
		if ( class_exists( 'ReduxFramework' ) ) {
			remove_action( 'admin_notices', array( get_redux_instance( 'theme_options' ), '_admin_notices' ), 99 );
		}
	}

	// HOOK TO REMOVE REDUX MESSAGES
	add_action( 'init', 'CHfw_remove_redux_messages' );


	function CHfw_removeDemoModeLink() { // Be sure to rename this function to something more unique
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_filter( 'plugin_row_meta', array(
					ReduxFrameworkPlugin::instance(),
					'plugin_metalinks'
			), null, 2 );
			// Used to hide the activation notice informing users of the demo panel. Only used when Redux is a plugin.
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::instance(), 'admin_notices' ) );
		}
		if ( class_exists( 'ReduxFrameworkPlugin' ) ) {
			remove_action( 'admin_notices', array( ReduxFrameworkPlugin::get_instance(), 'admin_notices' ) );
		}
	}

	add_action( 'init', 'CHfw_removeDemoModeLink' );
	add_action( 'redux/loaded', 'CHfw_removeDemoModeLink' );
}


// Remove redux sub-menu from "Tools" admin menu
function CHfw_remove_redux_menu() {
	remove_submenu_page( 'tools.php', 'redux-about' );
}

add_action( 'admin_menu', 'CHfw_remove_redux_menu', 12 );


if ( ! isset( $redux_demo ) ) {
	require( CHfw_PLUGIN_DIR . '/ReduxCore/config/options-config.php' );
}


// TGM plugin activation
if ( is_admin() ) {
	require( CHfw_PLUGIN_DIR . '/tgmpa/config.php' );
}

// Visual composer
require( CHfw_PLUGIN_DIR . '/visual-composer/vc-init.php' );


/* ------------------------------------------------------------------------------- */
/*
 * Load Translation Text Domain
* Make theme available for translation
* Translations can be filed in the /languages/ directory
* If you're building a theme based on wow, use a find and replace
* to change 'chfw-lang' to the name of your theme in all the template files
 -----------------------------------------------------------------------------------
 */
// WordPress language directory: wp-content/languages/theme-name/en_US.mo
load_theme_textdomain( 'chfw-lang', trailingslashit( WP_LANG_DIR ) . 'chfw-lang' );
// Theme language directory: wp-content/themes/theme-name/languages/en_US.mo
load_theme_textdomain( 'chfw-lang', CHfw_THEME_DIR . '/languages' );

/*includes system files */
include_once( 'includes/page_setting_engine.php' );

get_template_part( 'includes/theme-options/class-ajax' );
get_template_part( 'includes/theme-options/class', 'metabox' );
get_template_part( 'includes/theme-options/sidebar_widgets_config' );

//widget
get_template_part( 'includes/widget/widget', 'advertisement' );
get_template_part( 'includes/widget/widget', 'author_info' );
get_template_part( 'includes/widget/widget', 'contact_info' );
get_template_part( 'includes/widget/widget', 'last_post' );
get_template_part( 'includes/widget/widget', 'lastPost_popularPost_tabs' );
get_template_part( 'includes/widget/widget', 'popular_post' );
get_template_part( 'includes/widget/widget', 'social' );
get_template_part( 'includes/widget/widget', 'testimonials' );

get_template_part( 'includes/widget/social_media/widget', 'dribbble' );
get_template_part( 'includes/widget/social_media/widget', 'flickr' );
get_template_part( 'includes/widget/social_media/widget', 'instagram' );
//get_template_part( 'includes/widget/social_media', 'twitter' );v3


//---------------------options
get_template_part( 'includes/header-menu/wp_bootstrap_navwalker' );
get_template_part( 'includes/theme-options/post_counter_extension' );
include_once( "includes/theme-options/st_studioToolkit_class.php" );
get_template_part( 'includes/theme-options/comments_options' );


/* --------------------------------------------------------------
 	REGISTER  WIDGET
-------------------------------------------------------------- */
function CHfw_register_widget() {
	register_widget( 'CHfw_Testimonials' );
	register_widget( 'CHfw_Social_Widget' );
	register_widget( 'CHfw_Popular_Post' );
	register_widget( 'CHfw_LastPost_PopularPost_Tabs_Widget' );
	register_widget( 'CHfw_Last_Post' );
	register_widget( 'CHfw_Contact_Info' );
	register_widget( 'CHfw_AuthorInfo' );
	register_widget( 'CHfw_Advertisement_Widget' );
	register_widget( 'CHfw_Dribbble_Widget' );
	register_widget( 'CHfw_Flickr_Widget' );

}

add_action( 'widgets_init', 'CHfw_register_widget' );

class CHfw_Theme_Config {

	/**
	 * Construct
	 */
	public function __construct() {
		$this->CHfw_Class_theme_setup();
		$this->CHfw_Class_add_action();
	}

	/**
	 * initial theme setup
	 *  Theme Support
	 */
	public function CHfw_Class_theme_setup() {

		global $CHfw_rdx_options;
		// Enables post and comment RSS feed links to head
		add_theme_support( 'automatic-feed-links' );

		add_theme_support( 'post-formats', array(
				'video',
				'image',
				'audio',
				'gallery',
				'link',
				'quote',
				'status'
		) );


		// Add menu support
		add_theme_support( 'menus' );


		// featured image box
		add_theme_support( 'post-thumbnails', array(
				'post',
				'product'
		) );


		add_theme_support( 'title-tag' );


		/**
		 * Enable support for Logo
		 */
		add_theme_support( 'custom-header', array(
				'default-image' => get_template_directory_uri() . '/assets/logo@2x.png',
				'width'         => 195,
				'flex-width'    => true,
				'flex-height'   => false,
				'header-text'   => false,
		) );

		/**
		 * Enable custom background support
		 */
		add_theme_support( 'custom-background' );


		// Add WooCommerce support

		$zoom_enabled = isset( $CHfw_rdx_options['product_image_zoom'] ) ? $CHfw_rdx_options['product_image_zoom'] : 0;
		if ( $zoom_enabled ) {
			add_theme_support( 'wc-product-gallery-zoom' );
		}
		add_theme_support( 'wc-product-gallery-lightbox' );
		add_theme_support( 'wc-product-gallery-slider' );


		/**
		 * Theme resize image
		 */
		if ( function_exists( 'add_image_size' ) ) {
			add_image_size( 'wow-widget-post', 80, 80, true );
			add_image_size( 'wow-BlogList_MediumSmall_SidebarOpen', 860, 500, true );
			add_image_size( 'wow-BlogList_MediumLarge', 1100, 530, true );
			add_image_size( 'wow-AllSidebarOpen', 430, 300, true );
			add_image_size( 'wow-Timeline_zigzag1_zigzag2_Large', 570, 380, true );
			add_image_size( 'wow-masonry-BlogListSmall-Large', 420, 370, true );
		}
	}

	/*
	 * --------------------------------------------------------------
	 * ACtion init
	 * --------------------------------------------------------------
	 */
	public function CHfw_Class_add_action() {

		add_action( 'init', array( &$this, 'CHfw_Class_register_my_menu' ) );
		add_action( 'wp_enqueue_scripts', array(
				&$this,
				'CHfw_Class_load_scripts'
		) );
		add_action( 'after_switch_theme', array( &$this, 'CHfw_Class_setup_options' ) );


	}

	/*
	 * --------------------------------------------------------------
	 * Navigation menu
	 * --------------------------------------------------------------
	 */
	public function CHfw_Class_register_my_menu() {
		register_nav_menus( array(
				'main-menu'                 => esc_html__( 'Main Menu', 'chfw-lang' ),
				'mobil-menu'                => esc_html__( 'Mobil Menu', 'chfw-lang' ),
				'Footer-bottom-costum-menu' => esc_html__( 'Footer bottom costum menu', 'chfw-lang' )
		) );
	}

	/*
	 * --------------------------------------------------------------
	 * First theme activation config
	 * --------------------------------------------------------------
	 */
	public function CHfw_Class_setup_options() {
		// $CHfw_placeholder_image  look
		global $CHfw_rdx_options, $CHfw_themeSettingsOptions, $CHfw_placeholder_image, $CHfw_defaultwowSkin, $CHfw_themeCurrentSkin_option_name;
		if ( get_option( $CHfw_themeSettingsOptions ) != '' ) {
			$date_ = date( 'Y.m.d_H:i:s' );
		} else {
			$date_ = '';
		}


		if ( isset( $CHfw_rdx_options['placeholder_image_shop']['url'] ) && $CHfw_rdx_options['placeholder_image_shop']['url'] != '' ) {
			$CHfw_placeholder_image = $CHfw_rdx_options['placeholder_image_shop']['url'];
		}

		$_update_option = array(
				'wow_general_option'     => array(
						'theme_activation_first_date' => $date_,
						'theme_activation_date'       => $date_,
						'theme_version'               => THEME_VERSION,
						'skin_name'                   => get_option( $CHfw_themeCurrentSkin_option_name ),
				),
				'wow_placeholder_option' => array(
						'place_holder_image'      => $CHfw_placeholder_image,
						'shop_catalog_image_size' => get_option( 'shop_catalog_image_size' ),
						'shop_single_image_size'  => get_option( 'shop_single_image_size' ),
				),
		);

		update_option( $CHfw_themeSettingsOptions, json_encode( $_update_option ), false );

		update_option( $CHfw_themeCurrentSkin_option_name, $CHfw_defaultwowSkin );
	}

	/*
	 * --------------------------------------------------------------
	 *  Theme loading js and css files init
	 * --------------------------------------------------------------
	 */
	public function CHfw_Class_load_scripts() {
		global $prod_min;

		wp_enqueue_script( 'mediaelement' );
		wp_enqueue_style( 'mediaelement' );

		wp_register_script( 'modernizr', get_template_directory_uri() . '/assets/js/third-party/modernizr.min.js', array( 'jquery' ), '2.7.1', true );
		wp_enqueue_script( 'modernizr' );


		/*http://getbootstrap.com/customize/?id=762a49d33b1a6ac9a7798cc31f88cac8*/
		wp_register_style( 'bootstrap', get_template_directory_uri() . '/assets/css/third-party/bootstrap.min.css', '', '3.3.7', 'all' );
		wp_enqueue_style( 'bootstrap' );


		wp_register_style( 'CHfwStylesheet', get_template_directory_uri() . '/assets/css/' . $prod_min['devpath'] . "CHfw-style" . $prod_min['min'] . '.css', '', THEME_VERSION, 'all' );
		wp_enqueue_style( 'CHfwStylesheet' );


        wp_register_style( 'CHfwSkinH', get_template_directory_uri() . '/assets/css/skins/hospital.css', '', THEME_VERSION, 'all' );
        wp_enqueue_style( 'CHfwSkinH' );

		wp_register_style( 'FontAwesome', get_template_directory_uri() . '/assets/fonts/font-awesome/css/font-awesome.min.css', '', '4.7.0', 'all' );
		wp_enqueue_style( 'FontAwesome' );


		wp_register_style( 'CHfw-tools', get_template_directory_uri() . '/assets/css/' . $prod_min['devpath'] . 'CHfw-tools' . $prod_min['min'] . '.css', '', THEME_VERSION, 'all' );
		wp_enqueue_style( 'CHfw-tools' );


		wp_register_script( 'CHfw-JQkit', get_template_directory_uri() . '/assets/js/min/CHfw-JQkit.min.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'CHfw-JQkit' );

		wp_register_script( 'Magnificpopup', get_template_directory_uri() . '/assets/js/third-party/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'Magnificpopup' );

		wp_register_script( 'SlickSlider', get_template_directory_uri() . '/assets/js/third-party/slick.min.js', array( 'jquery' ), '1.6.0', true );
		wp_enqueue_script( 'SlickSlider' );



		$sel_ = '&pid=' . get_the_ID();
		if ( isset ( $_GET['skin'] ) ) {
			$sel_ .= '&skin=' . $_GET['skin'];
		}
		//only bottom
		wp_register_style( 'user_css', get_template_directory_uri() . "/assets/css/user.css.php?" . $sel_, '', THEME_VERSION, 'all' );
		wp_enqueue_style( 'user_css' );

		wp_register_script( 'CHfwJS', get_template_directory_uri() . '/assets/js/' . $prod_min['devpath'] . 'CHfw' . $prod_min['min'] . '.js', array( 'jquery' ), THEME_VERSION, true );
		wp_enqueue_script( 'CHfwJS' );


	}
}

//config init
$CHfw_function = new CHfw_Theme_Config();


/* ---------------------------------------------------------------------------
* Blog Ajax
 * --------------------------------------------------------------------------- */
add_action( 'wp_ajax_ch_ajax_blog_posts', 'CHfw__blog_load_posts' );
add_action( 'wp_ajax_nopriv_ch_ajax_blog_posts', 'CHfw__blog_load_posts' );

function CHfw__blog_load_posts() {
	wc_get_template( 'archive', 'ajax' );
}


/*                         Blog
=============================================================== */

// Maximum width for media
if ( ! isset( $content_width ) ) {
	$content_width = 1230; // Pixels
}


/* Actions & Filters
=============================================================== */
// Add Filters
add_filter( 'use_default_gallery_style', '__return_false' );    // Remove default inline WP gallery styles

// Add Filters
add_filter( 'widget_text', 'do_shortcode' );                    // Allow shortcodes in text-widgets
add_filter( 'widget_text', 'shortcode_unautop' );                // Disable auto-formatting (line breaks) in text-widgets
add_filter( 'the_excerpt', 'shortcode_unautop' );                // Remove auto <p> tags in Excerpt (Manual Excerpts only)


// Add Filters: Contact form 7
add_filter( 'wpcf7_load_css', '__return_false' );    // Disable CF7 styles
add_filter( 'wpcf7_load_js', '__return_false' );    // Disable CF7 JavaScript (included via custom shortcode instead)


/* --------------------------------------------------------------
 Excerpt Length
-------------------------------------------------------------- */
function CHfw_excerpt_length( $length ) {
	return 15;
}

add_filter( '_excerpt_length', 'CHfw_excerpt_length' );

/* --------------------------------------------------------------
 	Read More Links
-------------------------------------------------------------- */
function CHfw_content_more( $readmore_control = false ) {
	// check if read more button is enabled
	//http://bit.ly/2n4gI5K

	global $CHfw_rdx_options;
	$readmore_text = isset( $CHfw_rdx_options['readmore_text'] ) ? $CHfw_rdx_options['readmore_text'] : esc_html__( 'Read More', 'chfw-lang' );
	if ( $readmore_text == '' ) {
		$readmore_text = esc_html__( 'Read More', 'chfw-lang' );
	}
	if ( $readmore_control ) {
		if ( isset( $CHfw_rdx_options ) && $CHfw_rdx_options['enable_readmore'] ) {
			// check if page template
			$link = '<div class="clearfix"></div>';
			$link .= '<!-- read more button -->';
			$link .= '<div class="readmore">';
			$link .= '<a rel="nofollow" href="' . get_permalink() . '" class="cd-read-more">' . $readmore_text . '</a>';
			$link .= '</div><!-- end read more -->';
			return $link;
		}
	}
}

add_filter( 'the_content_more_link', 'CHfw_content_more' );


/* --------------------------------------------------------------
 *  Post excerpt brackets - [...]
-------------------------------------------------------------- */
function CHfw_excerpt_read_more( $excerpt ) {
	$excerpt_more = '&hellip;';
	$trans        = array(
			'[&hellip;]' => $excerpt_more // WordPress >= v3.6
	);

	return strtr( $excerpt, $trans );
}

add_filter( 'wp_trim_excerpt', 'CHfw_excerpt_read_more' );


/*                      FONT SETTING
=============================================================== */

/* Web fonts options
=============================================================== */
global $webfont_status;
$webfont_status = array( 'typekit' => false, 'fontdeck' => false );


/* --------------------------------------------------------------
 *Web fonts: Enqueue scripts
-------------------------------------------------------------- */
function CHfw_webfonts() {
	global $CHfw_rdx_options, $webfont_status;
	// Typekit: Main font kit
	if ( $CHfw_rdx_options['main_font_source'] === '2' && isset( $CHfw_rdx_options['main_font_typekit_kit_id'] ) ) {
		$webfont_status['typekit'] = true;
		wp_enqueue_script( 'wow_typekit_main', '//use.typekit.net/' . esc_attr( $CHfw_rdx_options['main_font_typekit_kit_id'] ) . '.js' );
	}
	// Typekit: Secondary font kit
	if ( $CHfw_rdx_options['secondary_font_source'] === '2' && isset( $CHfw_rdx_options['secondary_font_typekit_kit_id'] ) ) {
		// Make sure typekit kit-id's are different (no need to include the same typekit file for both fonts)
		if ( $CHfw_rdx_options['secondary_font_typekit_kit_id'] !== $CHfw_rdx_options['main_font_typekit_kit_id'] ) {
			$webfont_status['typekit'] = true;
			wp_enqueue_script( 'wow_typekit_secondary', '//use.typekit.net/' . esc_attr( $CHfw_rdx_options['secondary_font_typekit_kit_id'] ) . '.js' );
		}
	}
}

add_action( 'wp_enqueue_scripts', 'CHfw_webfonts' );


/* --------------------------------------------------------------
 * Web fonts: Add inline scripts
-------------------------------------------------------------- */
function CHfw_webfonts_inline() {
	global $webfont_status;

	if ( $webfont_status['typekit'] ) {
		//if ( wp_script_is( 'wow_typekit_main', 'done' ) ) {
		echo "\n" . '<script type="text/javascript">try{Typekit.load();}catch(e){}</script>';
		//}
	}
}

add_action( 'wp_head', 'CHfw_webfonts_inline' );


/* --------------------------------------------------------------
 * Comment reply
-------------------------------------------------------------- */
function CHfw_theme_queue_js() {
	if ( ( ! is_admin() ) && is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_print_scripts', 'CHfw_theme_queue_js' );


/*                      Emoji and editor
=============================================================== */

/* --------------------------------------------------------------
 * Filter function: Remove TinyMCE emoji plugin
-------------------------------------------------------------- */
function CHfw_disable_emojis_tinymce( $plugins ) {
	if ( is_array( $plugins ) ) {
		return array_diff( $plugins, array( 'wpemoji' ) );
	} else {
		return array();
	}
}


/* --------------------------------------------------------------
 *	Disable emoji icons
 * 	Source: https://wordpress.org/plugins/disable-emojis/
-------------------------------------------------------------- */
if ( ! function_exists( 'CHfw_disable_emojis' ) ) {
	function CHfw_disable_emojis() {
		remove_action( 'wp_head', 'print_emoji_detection_script', 7 );
		remove_action( 'admin_print_scripts', 'print_emoji_detection_script' );
		remove_action( 'wp_print_styles', 'print_emoji_styles' );
		remove_action( 'admin_print_styles', 'print_emoji_styles' );
		remove_filter( 'the_content_feed', 'wp_staticize_emoji' );
		remove_filter( 'comment_text_rss', 'wp_staticize_emoji' );
		remove_filter( 'wp_mail', 'wp_staticize_emoji_for_email' );
		add_filter( 'tiny_mce_plugins', 'CHfw_disable_emojis_tinymce' );
	}
}

/*  Hook: Disable emoji icons---------------------------- */
add_action( 'init', 'CHfw_disable_emojis' );

function CHfw_add_editor_styles() {
	add_editor_style( 'custom-editor-style.css' );
}

add_action( 'init', 'CHfw_add_editor_styles' );

/* --------------------------------------------------------------
Add the wp-editor back into WordPress after it was removed in 4.2.2.
* @returns echo'd string
-------------------------------------------------------------- */
if ( ! function_exists( 'CHfw_fix_no_editor_on_posts_page' ) ) {
	function CHfw_fix_no_editor_on_posts_page( $post ) {
		if ( isset( $post ) && $post->ID != get_option( 'page_for_posts' ) ) {
			return;
		}

		remove_action( 'edit_form_after_title', '_wp_posts_page_notice' );
		add_post_type_support( 'page', 'editor' );
	}

	add_action( 'edit_form_after_title', 'CHfw_fix_no_editor_on_posts_page', 0 );
}


/* --------------------------------------------------------------
* Lets add Open Graph Meta Info
* http://bit.ly/1cqmtJL
*-------------------------------------------------------------- */
function CHfw_insert_fb_in_head() {
	global $post;
	if ( ! is_singular() || ! is_404() ) //if it is not a post or a page
	{
		return;
	}
	echo '<meta property="og:title" content="' . get_the_title() . '"/>';
	echo '<meta property="og:type" content="article"/>';
	echo '<meta property="og:url" content="' . get_permalink() . '"/>';
	echo '<meta property="og:site_name" content="' . get_bloginfo( 'name' ) . '"/>';
	if ( ! has_post_thumbnail( $post->ID ) ) { //the post does not have featured image, use a default image
		$default_image = esc_url( get_stylesheet_directory_uri() ) . '/assets/logo@2x.png'; //replace this with a default image on your server or an image in your media library
		echo '<meta property="og:image" content="' . $default_image . '"/>';
	} else {
		$thumbnail_src = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'medium' );
		echo '<meta property="og:image" content="' . esc_attr( $thumbnail_src[0] ) . '"/>';
	}
}

add_action( 'wp_head', 'CHfw_insert_fb_in_head', 5 );


/* --------------------------------------------------------------
*ADMIN ASSETS
-------------------------------------------------------------- */
function CHfw_widget_admin_assets( $hook ) {
	// Widgets page
	wp_register_style( 'CHfw-Admin', get_template_directory_uri() . '/assets/css/min/CHfw-admin.min.css' );
	wp_enqueue_style( 'CHfw-Admin' );
	wp_enqueue_media();
	if ( 'widgets.php' == $hook || 'post.php' == $hook || 'post-new.php' == $hook ) {
		wp_enqueue_style( 'wp-color-picker' );
		wp_enqueue_script( 'wp-color-picker' );
		wp_enqueue_script( 'CHfw-color-picker', get_template_directory_uri() . '/assets/js/min/CHfw-color-picker-init.min.js', array( 'jquery' ), false );

		wp_register_script( 'CHfw-Admin-js', get_template_directory_uri() . '/assets/js/min/CHfw-admin.min.js', '1.0', true );
		wp_enqueue_script( 'CHfw-Admin-js' );
	}
}

add_action( 'admin_enqueue_scripts', 'CHfw_widget_admin_assets' );

/* --------------------------------------------------------------
 *  Front-end WordPress admin bar --for redux config --- "firstable not working only option"
 * @link :http://bit.ly/2iiND3s
-------------------------------------------------------------- */
if ( ! $CHfw_rdx_options['wp_admin_bar'] ) {
	function CHfw_remove_admin_bar() {
		return false;
	}
	add_filter( 'show_adm' . 'in_bar', 'CHfw_remove_admin_bar' );
}


/* --------------------------------------------------------------
 * Build the entire current page URL (incl query strings) and output it
 * Useful for social media plugins and other times you need the full page URL
 * Also can be used outside The Loop, unlike the_permalink
 *
 * @returns the URL in PHP (so echo it if it must be output in the template)
 * Also see the_current_page_url() syntax that echoes it
-------------------------------------------------------------- */
if ( ! function_exists( 'CHfw_get_current_page_url' ) ) {
	function CHfw_get_current_page_url() {
		global $wp;

		return add_query_arg( $_SERVER['QUERY_STRING'], '', esc_url( home_url( $wp->request ) ) );
	}
}



/* --------------------------------------------------------------
* Shorthand for echo get_current_page_url();
* @returns echo'd string
-------------------------------------------------------------- */
if ( ! function_exists( 'CHfw_the_current_page_url' ) ) {
	function CHfw_the_current_page_url() {
		echo get_current_page_url();
	}
}


/* --------------------------------------------------------------
 	JS BLOG VARIABLE (wp_localize_script)
-------------------------------------------------------------- */
function CHfw_theme_enqueue_info_scripts() {
	ob_start(); // Initiate the output buffer
	global $CHfw_rdx_options;
	//https://docs.woocommerce.com/document/conditional-tags/   v2 endpoint page
	$page_name_chi               = '';
	$page_name_zone              = '';
	$shop_layout_type_ShopLayout = '';
	if ( is_page() ) {
		//$page_name_chi  = 'blog-page';
		$page_name_chi  = $pagename = get_query_var( 'pagename' );
		$page_name_zone = 'wp';
	} elseif ( is_archive() ) {
		$page_name_chi  = 'archive-page';
		if ($CHfw_rdx_options['archive_view_style'] == 'masonry'){
			$page_name_chi = 'archive-page_masonry';
		}

		$page_name_zone = 'wp';
	} elseif ( is_search() ) {
		$page_name_chi  = 'search-page';
		$page_name_zone = 'wp';
	} elseif ( is_single() ) {
		$page_name_chi  = 'single-page';
		$page_name_zone = 'wp';
	} elseif ( is_front_page() ) {
		$page_name_chi  = 'front-page';
		$page_name_zone = 'wp';
	} else {
		$page_name_chi  = 'other-page';
		$page_name_zone = 'wp_woo-other';
	}
	if ( CHfw_woocommerce_activated() ) {

		if ( is_shop() ) {
			$page_name_chi               = 'woocommerce-shop-page';
			$page_name_zone              = 'wp-woo';
			$shop_layout_type_ShopLayout = isset( $CHfw_rdx_options['main_shop_layout'] ) ? $CHfw_rdx_options['main_shop_layout'] : '';
		} elseif ( is_product_category() ) {
			$page_name_chi               = 'woocommerce-product_category-page';
			$page_name_zone              = 'wp-woo';
			$shop_layout_type_ShopLayout = isset( $CHfw_rdx_options['product_category_layout'] ) ? $CHfw_rdx_options['product_category_layout'] : '';
		} elseif ( is_product_tag() ) {
			$page_name_chi               = 'woocommerce-product_tag-page';
			$page_name_zone              = 'wp-woo';
			$shop_layout_type_ShopLayout = isset( $CHfw_rdx_options['product_tag_layout'] ) ? $CHfw_rdx_options['product_tag_layout'] : '';
		} elseif ( is_product() ) {
			$page_name_chi  = 'woocommerce-product-page';
			$page_name_zone = 'wp-woo';
		} elseif ( is_cart() ) {
			$page_name_chi  = 'woocommerce-cart-page';
			$page_name_zone = 'wp-woo';
		} elseif ( is_checkout() ) {
			$page_name_chi  = 'woocommerce-checkout-page';
			$page_name_zone = 'wp-woo';
		} elseif ( is_account_page() ) {
			$page_name_chi  = 'woocommerce-account-page';
			$page_name_zone = 'wp-woo';
		}
	}

    $cookiePath = "/";
    $cookieExpire = time()+(60*60*24);//one day -> seconds*minutes*hours
    setcookie("chFW_variable_pagezone",$page_name_zone,$cookieExpire,$cookiePath);

	wp_localize_script( 'CHfwJS', 'wow_pageinfo',
			array(
					'page_name'                      => $page_name_chi,
					'page_zone'                      => $page_name_zone,
					'shop_layout_type_WooShopLayout' => $shop_layout_type_ShopLayout,
			)
	);

}

add_action( 'wp_enqueue_scripts', 'CHfw_theme_enqueue_info_scripts' );


/* --------------------------------------------------------------
 	*who is the page type=  product or post
-------------------------------------------------------------- */
function CHfw_searchParam() {
	/*https://docs.woocommerce.com/document/conditional-tags/*/
	$page_name_c_desktop = esc_html__( 'Search', 'chfw-lang' );
	if ( CHfw_woocommerce_activated() ) {
		if ( is_shop() or is_product() or is_checkout() or is_cart() or is_account_page() or is_product_tag() or is_product_category() or is_woocommerce() or is_wc_endpoint_url() ) {
			$page_val_desktop    = 'product';
			$page_name_c_desktop = esc_html__( 'Search Store', 'chfw-lang' );
		} elseif ( is_page() ) {
			$page_val_desktop = 'post';
		} elseif ( is_single() ) {
			$page_val_desktop = 'post';
		} else {
			$page_val_desktop = 'post';
		}
	} else {
		$page_val_desktop = 'post';
	}
	$ch_zone = isset ( $_COOKIE['chFW_variable_pagezone'] ) ? $_COOKIE['chFW_variable_pagezone'] : '';

	return array(
			'post_type'   => $page_val_desktop,
			'placeholder' => $page_name_c_desktop,
			'post_zone'   => $ch_zone
	);
}


/* --------------------------------------------------------------
 Theme check escape FRAME
-------------------------------------------------------------- */
function CHfw_facebook_frame() {
	global $CHfw_rdx_options;

	return '<iframe class="facebook-iframe"
	        src="//www.facebook.com/plugins/like.php?href=' . get_permalink() . '&amp;width&amp;layout=button_count&amp;action=like&amp;show_faces=false&amp;share=false&amp;height=21&amp;appId=' . $CHfw_rdx_options['facebook_app_id'] . '"></iframe>';

}


/* --------------------------------------------------------------
 one click import function list
-------------------------------------------------------------- */
include ("includes/ocdi_func.php");


//visual composer redirect disable
function CHfw_custom_menu_page_removing() {
    remove_menu_page('vc-welcome'); //vc
}
add_action( 'admin_init', 'CHfw_custom_menu_page_removing' );




/* --------------------------------------------------------------
 * alternative get template part
 * uses includes/plugins/visual-composer/shortcodes/post-slider.php
 * uses includes/plugins/visual-composer/shortcodes/post.php
-------------------------------------------------------------- */
function CHfw_get_template_part( $pathname, $ch_get_template_part_values = '' ) {
	include $pathname . '.php';
}

/* --------------------------------------------------------------
 *Yith wishlist plugin remove
-------------------------------------------------------------- */
function CHfw_get_post_formetter( $format_typeCH, $view_options, $CHfw_rdx_options ) {
	switch ( $format_typeCH ) {
		case 'link':
			include( "includes/post-pages/post-types/link.php" );
			break;

		case 'video':
			include( "includes/post-pages/post-types/video.php" );
			break;

		case 'image':
			include( "includes/post-pages/post-types/image.php" );
			break;

		case 'audio':
			include( "includes/post-pages/post-types/audio.php" );
			break;

		case 'gallery':
			include( "includes/post-pages/post-types/gallery.php" );
			break;

		case 'quote':
			include( "includes/post-pages/post-types/quote.php" );
			break;

		case 'status':
			include( "includes/post-pages/post-types/status.php" );
			break;

		default:
			include( "includes/post-pages/post-types/standart.php" );
	}
}

/* --------------------------------------------------------------
 *CHfw_page_setting_engine.php:line 612
-------------------------------------------------------------- */
function CHfw_echof() {
	echo ': ';
}

/* --------------------------------------------------------------
 * Yith wishlist plugin remove
-------------------------------------------------------------- */
function CHfw_modify_yith() {
	if ( ! is_admin() ) {
		wp_dequeue_style( 'yith-wcwl-main' );
		wp_dequeue_style( 'yith-wcwl-font-awesome' );
	}
}

add_action( 'wp_enqueue_scripts', 'CHfw_modify_yith', 99 );
add_filter( 'yith_wcan_use_wp_the_query_object', '__return_true' );
add_filter( 'yith_wcan_skip_current_category', '__return_false' );

/*--staff  page not found --fixed ---*/
flush_rewrite_rules( false );

// --------------------------------------------------------------
/*
 * Use get_the_excerpt() to print an excerpt by specifying a maximium number of characters.
 * @uses vc post slider and posts
 * * */
//-------------------------------------------------------------- */
function CHfw_the_ExcerptMaxCharLength($charlength) {
	$excerpt = get_the_excerpt();
	$charlength++;

	if ( mb_strlen( $excerpt ) > $charlength ) {
		$subex = mb_substr( $excerpt, 0, $charlength - 5 );
		$exwords = explode( ' ', $subex );
		$excut = - ( mb_strlen( $exwords[ count( $exwords ) - 1 ] ) );
		if ( $excut < 0 ) {
			echo mb_substr( $subex, 0, $excut );
		} else {
			echo $subex;
		}
		echo '[...]';
	} else {
		echo $excerpt;
	}
}
/*style.css param "&#038;" remove  */
add_filter('clean_url', 'so_handle_038', 99, 3);
function so_handle_038($url, $original_url, $_context) {
    if (strstr($url, "googleapis.com") !== false) {
        $url = str_replace("&#038;", "&", $url); // or $url = $original_url
    }

    return $url;
}

include  ("includes/departman_func_list.php");
