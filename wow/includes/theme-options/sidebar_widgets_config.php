<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit();
}


/*
 * --------------------------------------------------------------
 * Sidebars
 * --------------------------------------------------------------
 */

function CHfw_sidebars() {
	global $CHfw_rdx_options, $CHfw_select_skin;
	/*
	 * IMPORTANT NOTES
	"colored_widget";
	"colored_two_widget";
	"line_widget";//default
	"line_left_widget";
	"line_transparant_widget";
	"border_bottom_widget";
	"border_bottom_bg_widget";
	*/

	// REDUX SELECT SKIN CONFIG ------------------------------
	$select_widget_title_skin = " custom_skin";
	if ( $select_widget_title_skin == ' custom_skin' ) {
		if ( isset( $CHfw_rdx_options[ 'sidebar_widget_title_selected' . $CHfw_select_skin ] ) ) {
			$select_widget_type = $CHfw_rdx_options[ 'sidebar_widget_title_selected' . $CHfw_select_skin ];
		} else {
			$select_widget_type = "line_widget";
		}
	}

	$footer_select_widget_title_skin = " custom_skin";
	if ( $footer_select_widget_title_skin == ' custom_skin' ) {
		if ( isset( $CHfw_rdx_options[ 'footer_widget_title_selected' . $CHfw_select_skin ] ) ) {
			$footer_select_widget_type = $CHfw_rdx_options[ 'footer_widget_title_selected' . $CHfw_select_skin ];
		} else {
			$footer_select_widget_type = "line_widget";
		}
	}

	// BLOG SIDEBAR ------------------------------
	register_sidebar( array(
		'name'          => 'sidebar1',
		'id'            => 'sidebar-1',
		'description'   => 'Sidebar 1 Widgets',
		'before_widget' => ' <section id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'  => '</section>',
		'before_title'  => '<div class="widget-heading ' . $select_widget_type . $select_widget_title_skin . ' clearfix"><h4><span>',
		'after_title'   => '</span></h4></div>'
	) );

	// SHOP SIDEBAR ------------------------------
	register_sidebar( array(
		'name'          => 'shop-sidebar',
		'id'            => 'shop-sidebar1',
		'description'   => 'Shop Sidebar Widgets',
		'before_widget' => ' <div id="%1$s" class="widget sidebar-widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-heading ' . $select_widget_type . $select_widget_title_skin . ' clearfix"> <h4> <span>',
		'after_title'   => '</span></h4></div>'
	) );

	//TOP SHOP SIDEBAR ------------------------------
	register_sidebar( array(
		'name'          => 'widgetTopShop',
		'id'            => 'widgets-top-shop',
		'description'   => 'Top Shop Widgets',
		'before_widget' => '<div id="%1$s" class="widgetTopShop col-xs-6 col-sm-6 col-md-3 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="title_font">',
		'after_title'   => '</h4>'
	) );

	//TOP FOOTER SIDEBAR ------------------------------
	register_sidebar( array(
		'name'          => 'footer1',
		'id'            => 'footer-1',
		'description'   => 'Footer 1 Widgets',
		'before_widget' => '<div class="grid_"><div id="%1$s" class="footer-block  footer-widget widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<div class="widget-heading ' . $footer_select_widget_type . $footer_select_widget_title_skin . ' clearfix">
        <h4>
        <span>',
		'after_title'   => '</span></h4></div>'
	) );

	//BOTTOM FOOTER SIDEBAR ------------------------------
	register_sidebar( array(
		'name'          => 'footer2',
		'id'            => 'footer-2',
		'description'   => 'Footer 2 Widgets',
		'before_widget' => '<div class="grid_"><div id="%1$s" class="footer-block  footer-widget widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="title_font">',
		'after_title'   => '</h4>'
	) );

	//for pages homepages skin SIDEBAR ------------------------------
	register_sidebar( array(
		'name'          => 'homepages_widget',
		'id'            => 'Homepages_widget',
		'description'   => 'Homepage  Widgets',
		'before_widget' => '<div class="grid_"><div id="%1$s" class="homepage-block  homepage-widget widget %2$s">',
		'after_widget'  => '</div></div>',
		'before_title'  => '<h4 class="title_font">',
		'after_title'   => '</h4>'
	) );
}


add_action( 'widgets_init', 'CHfw_sidebars' );