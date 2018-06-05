<?php
$ThemeStyleSettings = array(
		'title'  => __( 'Theme Style Settings', 'chfw-lang' ),
		'desc'   => __( 'Edit theme skin settings...', 'chfw-lang' ),
		'fields' => array(

		)
);

$MainPageSetting = array(
	'title'      => __( 'Main Page Setting', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'   => 'theme_setting_EntriePage_info_',
			'icon' => true,
			'type' => 'info',
			'raw'  => '<h3 class="redux_info">' . __( 'Main Page Setting', 'chfw-lang' ) . '</h3>',

		),
	),
);

$TopNavBarSetting = array(
		'title'      => __( 'Top NavBar Setting', 'chfw-lang' ),
		'subsection' => true,
		'fields'     => array(),
);

$HeaderSetting = array(
	'title'      => __( 'Header Setting', 'chfw-lang' ),
	'desc'       => __( 'Edit heder style settings .. ', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'   => 'theme_setting_header_info_',
			'icon' => true,
			'type' => 'info',
			'raw'  => '<h3 class="redux_info">' . __( 'Header Setting', 'chfw-lang' ) . '</h3>',

		),

	),
);




$MenuSettings= array(
	'title'      => __( 'Menu Settings', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(),
);

$MobileMenuSettings = array(
	'title'      => __( 'Mobile Menu "Simple"', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'   => 'MobileMenu_info_',
			'icon' => true,
			'type' => 'info',
			'raw'  => '<h3 class="redux_info">' . __( 'Mobile Menu Setting', 'chfw-lang' ) . '</h3>INFO <br><img src="' . ReduxFramework::$_url . 'assets/img/ch_mobile_menu.png">',
		),

	),
);


$MobileMenuAdvancedSettings = array(
    'title'      => __( 'Mobil Menu "Advanced"', 'chfw-lang' ),
    'desc'       => __( 'Mobil Menu "Advanced"-- settings ...', 'chfw-lang' ),
    'subsection' => true,
    'fields'     => array(
        array(
            'id'   => 'OutSideSidebar_general_info_',
            'icon' => true,
            'type' => 'info',
            'raw'  => '<h3 class="redux_info">' . __( 'Canvas bar general Info', 'chfw-lang' ) . '</h3><img src="' . ReduxFramework::$_url . 'assets/img/ch_outside_menu.png">',

        ),
    ),
);

$BlogPostListStyle = array(
	'title'      => __( 'Blog Post List Style', 'chfw-lang' ),
	'desc'       => __( 'Blog Post List Style Setting.... ', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(

		array(
			'id'   => 'theme_settingBlogPostStyle_info_',
			'icon' => true,
			'type' => 'info',
			'raw'  => '<h3 class="redux_info">' . __( 'Blog Post List Style Setting', 'chfw-lang' ) . '</h3>INFO <br><img src="' . ReduxFramework::$_url . 'assets/img/blog_post_list_style.png">',
		),


	),
);



$SidebarSetting= array(
	'title'      => __( 'Sidebar Setting', 'chfw-lang' ),
	'desc'       => __( 'Edit sidebar style settings .. ', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'   => 'theme_sidebar_general_info_',
			'icon' => true,
			'type' => 'info',
			'raw'  => '<h3 class="redux_info">' . __( 'Sidebar Setting', 'chfw-lang' ) . '</h3>',

		),



	),
);



$ShopSetting = array(
	'title'      => __( 'Shop Setting', 'chfw-lang' ),
	'desc'       => __( 'Edit sidebar style settings .. ', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'   => 'product_page_info_',
			'icon' => true,
			'type' => 'info',
			'raw'  => '<h3 class="redux_info">' . __( 'Badge Options', 'chfw-lang' ) . '</h3>',

		),


	),
);

$FooterSetting = array(
	'title'      => __( 'Footer Setting', 'chfw-lang' ),
	'desc'       => __( 'Edit footer style settings .. ', 'chfw-lang' ),
	'subsection' => true,
	'fields'     => array(
		array(
			'id'   => 'theme_Footer_general_info_',
			'icon' => true,
			'type' => 'info',
			'raw'  => '<h3 class="redux_info">' . __( 'Footer Style', 'chfw-lang' ) . '</h3>',
		),


	),
);