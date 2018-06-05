<?php




/*-----------------------------------------------------------------------------------*/
/* Remove third-party plugin elements
/*-----------------------------------------------------------------------------------*/
function CHfw_vc_remove_plugin_elements() {
	vc_remove_element( 'contact-form-7' );
}

add_action( 'vc_after_set_mode', 'CHfw_vc_remove_plugin_elements', 100 );

// WordPress default Widgets (Appearance > Widgets) ----------------------------------


vc_add_param( 'vc_images_carousel', array(
	'type'        => 'dropdown',
	'heading'     => __( 'On click action', 'js_composer' ),
	'param_name'  => 'onclick',
	'value'       => array(
		__( 'Open Photo', 'js_composer' )        => 'link_image',
		__( 'None', 'js_composer' )              => 'link_no',
		__( 'Open custom links', 'js_composer' ) => 'custom_link',
	),
	'description' => __( 'Select action for click event.', 'js_composer' ),
) );

// Custom element params ----------------------------------

// Element: vc_column_text
vc_remove_param( 'vc_column_text', 'css' ); // Disable "Design Options" tab


// Element: vc_message
vc_remove_param( 'vc_message', 'css' ); // Disable "Design Options" tab
vc_remove_param( 'vc_message', 'color' );
vc_remove_param( 'vc_message', 'message_box_style' );
vc_remove_param( 'vc_message', 'style' );
vc_remove_param( 'vc_message', 'message_box_color' );

vc_add_param( 'vc_message', array(
	'type'        => 'dropdown',
	'heading'     => __( 'Message Box Presets', 'js_composer' ),
	'param_name'  => 'color',
	'value'       => array(
		'Information' => 'info',
		'Warning'     => 'warning',
		'Success'     => 'success',
		'Error'       => 'danger'
	),
	'description' => __( 'Select predefined message box design or choose "Custom" for custom styling.', 'js_composer' ),
	'weight'      => 1
) );




// Element: vc_toggle
vc_remove_param( 'vc_toggle', 'css' ); // Disable "Design Options" tab
vc_remove_param( 'vc_toggle', 'style' );
vc_remove_param( 'vc_toggle', 'color' );
vc_remove_param( 'vc_toggle', 'size' );






// Element: vc_tour
vc_remove_param( 'vc_tour', 'title' );


// Element: vc_accordion
vc_remove_param( 'vc_accordion', 'title' );


// Element: vc_widget_sidebar
vc_remove_param( 'vc_widget_sidebar', 'title' );






