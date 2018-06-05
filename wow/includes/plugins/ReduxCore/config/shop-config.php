<?php
Redux::setSection($opt_name, array(
	'title' => __('Shop Options', 'chfw-lang'),
	'id' => 'basic',
	'desc' => __('SHOP Options', 'chfw-lang'),
	'icon' => 'el-icon-shopping-cart',
	'fields' => array(


		array(
			'id' => 'product_shop_layout_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('List Product Setting', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'main_shop_layout',
			'type' => 'image_select',
			'title' => __('Shop Layout', 'chfw-lang'),
			'subtitle' => __('Select shop layout', 'chfw-lang'),
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
				'top' => array(
					'alt' => 'top',
					'img' => ReduxFramework::$_url . 'assets/img/topcl.png'
				),
			),
			'default' => 'right'
		),


		array(
			'id' => 'product_category_layout',
			'type' => 'image_select',
			'title' => __('Product Category Layout', 'chfw-lang'),
			'subtitle' => __('Select product category layout ', 'chfw-lang'),
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
				'top' => array(
					'alt' => 'left',
					'img' => ReduxFramework::$_url . 'assets/img/topcl.png'
				),
			),
			'default' => 'right'
		),


		array(
			'id' => 'product_tag_layout',
			'type' => 'image_select',
			'title' => __('Product Tag Layout', 'chfw-lang'),
			'subtitle' => __('Select product tag layout', 'chfw-lang'),
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
				'top' => array(
					'alt' => 'left',
					'img' => ReduxFramework::$_url . 'assets/img/topcl.png'
				),
			),
			'default' => 'right'
		),


		array(
			'id' => 'product_shop_single_layout_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Single Product Setting', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'product_single_layout',
			'type' => 'image_select',
			'title' => __('Single product layout', 'chfw-lang'),
			'subtitle' => __('Single product layout ', 'chfw-lang'),
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
			'id' => 'shoppages_setting_mobil_sidebar_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Mobile and tablet view settings in sidebar', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'shop_sidebar_mobile_view',
			'type' => 'switch',
			'title' => __('Hide the sidebar in mobile view', 'chfw-lang'),
			'desc' => '',
			'default' => 1,
			'on' => 'Enable',
			'off' => 'Disable'
		),


		array(
			'id' => 'shop_sidebar_tablet_view',
			'type' => 'switch',
			'title' => __('Hide the sidebar in tablet view', 'chfw-lang'),
			'desc' => '',
			'default' => 1,
			'on' => 'Enable',
			'off' => 'Disable'
		),


		array(
			'id' => 'product_quickview_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Categories Grid', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'categories_grid_columns',
			'type' => 'slider',
			'title' => __('Columns (Desktop view)', 'chfw-lang'),
			'desc' => __('Select the number of product columns to display.', 'chfw-lang'),
			'default' => 3,
			'min' => 1,
			'max' => 6,
			'step' => 1,
			'display_value' => 'text'
		),


		array(
			'id' => 'categories_grid_columns_tablet',
			'type' => 'slider',
			'title' => __('Columns (Tablet view)', 'chfw-lang'),
			'desc' => __('Select the number of product columns to display.', 'chfw-lang'),
			'default' => 3,
			'min' => 1,
			'max' => 6,
			'step' => 1,
			'display_value' => 'text'
		),

		array(
			'id' => 'categories_grid_columns_mobil',
			'type' => 'slider',
			'title' => __('Columns (Mobil view)', 'chfw-lang'),
			'desc' => __('Select the number of product columns to display.', 'chfw-lang'),
			'default' => 2,
			'min' => 1,
			'max' => 4,
			'step' => 1,
			'display_value' => 'text'
		),
		array(
			'id' => 'categories_grid_list_type',
			'type' => 'select',
			'title' => __('Categories Pages Grid List Type ', 'chfw-lang'),
			'desc' => __('Configure Categories Pages Grid List Type ', 'chfw-lang'),
			'options' => array(
				'masonry' => 'Masonry',
				'list' => 'List',
			),
			'default' => 'list'
		),

		array(
			'id' => 'product_quickview_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Shop Catalog', 'chfw-lang') . '</h3>',
		),


		array(
			'id' => 'products_per_page',
			'type' => 'slider',
			'title' => __('Products per Page', 'chfw-lang'),
			'desc' => __('Enter the number of products to display per page in the shop-catalog.', 'chfw-lang'),
			'default' => 12,
			'min' => 1,
			'max' => 48,
			'step' => 1,
			'display_value' => 'text'
		),

		array(
			'id' => 'shop_category_title',
			'type' => 'switch',
			'title' => __('Category title', 'chfw-lang'),
			'desc' => __('Display category title.', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enable',
			'off' => 'Disable'
		),

		array(
			'id' => 'shop_category_description',
			'type' => 'switch',
			'title' => __('Description', 'chfw-lang'),
			'desc' => __('Display category description.', 'chfw-lang'),
			'default' => 0,
			'on' => 'Enable',
			'off' => 'Disable'
		),

		array(
			'id' => 'product_quickview_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Quick View', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'quick_view_enable',
			'type' => 'switch',
			'title' => __('Display product quick view links.', 'chfw-lang'),
			'desc' => __('Display product quick view links.', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),


		array(
			'id' => 'related_shop_system_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Related and Up-sells Products', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'enable_related_shop',
			'type' => 'switch',
			'title' => __('Enable Related Products', 'chfw-lang'),
			'desc' => __('You can enable / disable similar products section.', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),

		array(
			'id' => 'enable_upsell_shop',
			'type' => 'switch',
			'title' => __('Enable Upsell Products', 'chfw-lang'),
			'desc' => __('You can enable / disable upsell section.', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),

		array(
			'id' => 'shop_columns',
			'type' => 'slider',
			'title' => __('Columns', 'chfw-lang'),
			'desc' => __('Select the number of product columns to display(For Related products, Up-sells)', 'chfw-lang'),
			'default' => 6,
			'min' => 1,
			'max' => 12,
			'step' => 1,
			'display_value' => 'text'
		),


		array(
			'id' => 'product_page_Loading_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Lazy Loading', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'lazy_loading_shop_image_quickview',
			'type' => 'switch',
			'title' => __('Quickview Image Lazy Loading', 'chfw-lang'),
			'desc' => __('Quickview Lazy load product catalog images when scrolling down the page (speeds up load times). ', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),

		array(
			'id' => 'lazy_loading_shop_image',
			'type' => 'switch',
			'title' => __('Image Lazy Loading', 'chfw-lang'),
			'desc' => __('Lazy load product catalog images when scrolling down the page (speeds up load times). ', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),


		array(
			'id' => 'lazy_loading_shop_bg_image',
			'type' => 'media',
			'title' => __('Image lazy background image select', 'chfw-lang'),
			'desc' => __('eq : www.loading.io', 'chfw-lang'),
			'required' => array('lazy_loading_shop_image', '=', 1),
			'default' => array(
				'url' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/spiffygif_168x168.gif',
			),

		),


		array(
			'id' => 'lazy_loading_shop_bgcolor',
			'type' => 'color',
			'title' => __('Image Lazy Background Color', 'chfw-lang'),
			'default' => '#eeeeee',
			'validate' => 'color',
			'required' => array('lazy_loading_shop_image', '=', 1)
		),

		array(
			'id' => 'product_page_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Product Page', 'chfw-lang') . '</h3>',
		),

		array(
			'id' => 'placeholder_image_catalog',
			'type' => 'media',
			'title' => __('Placeholder Image  (Catalog)', 'chfw-lang'),
			'compiler' => 'true',
			'mode' => false,
			'subtitle' => __('if you image not found the ', 'chfw-lang'),
			'hint' => array(),
			'default' => array(
				'url' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/placeholder/placeholder_cat.png',
			),
		),

		array(
			'id' => 'placeholder_image_single',
			'type' => 'media',
			'title' => __('Placeholder Image (Single Product)  ', 'chfw-lang'),
			'compiler' => 'true',
			'mode' => false,
			'subtitle' => __('if you image not found the ', 'chfw-lang'),
			'hint' => array(),
			'default' => array(
				'url' => esc_url(get_stylesheet_directory_uri()) . '/assets/images/placeholder/placeholder_single_shop.png',
			),
		),


		array(
			'id' => 'product_image_zoom',
			'type' => 'switch',
			'title' => __('Zoom to view full-size product image', 'chfw-lang'),
			'desc' => __('Zoom to view full-size product image', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),


		array(
			'id' => 'discount_percentage',
			'type' => 'switch',
			'title' => __('Discount Percentage', 'chfw-lang'),
			'desc' => __('You can disable / enable discount Percentage show', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),


		array(
			'id' => 'slick_arrow_skin',
			'type' => 'image_select',
			'title' => __('Related and upsells products arrow type', 'chfw-lang'),
			'options' => array(
				'slick-arrow-easy-skin' => array(
					'alt' => 'Easy ',
					'img' => ReduxFramework::$_url . 'assets/img/rel-up-arrows/arrow-easy.png'
				),
				'slick-arrow-white-skin' => array(
					'alt' => 'White',
					'img' => ReduxFramework::$_url . 'assets/img/rel-up-arrows/arrow-white.png'
				),
				'slick-arrow-black-skin' => array(
					'alt' => 'Black',
					'img' => ReduxFramework::$_url . 'assets/img/rel-up-arrows/arrow-black.png'
				),
				'slick-arrow-japan-skin' => array(
					'alt' => 'Japan',
					'img' => ReduxFramework::$_url . 'assets/img/rel-up-arrows/arrow-japan.png'
				),
				'slick-arrow-default-skin' => array(
					'alt' => 'Default',
					'img' => ReduxFramework::$_url . 'assets/img/rel-up-arrows/arrow-default.png'
				),
			),
			'default' => 'slick-arrow-easy-skin'
		),


		array(
			'id' => 'product_page_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Ajax Options', 'chfw-lang') . '</h3>',
		),


		array(
			'id' => 'ajax_popup_notification',
			'type' => 'switch',
			'title' => __('Pop-up notifications', 'chfw-lang'),
			'desc' => __('You can disable / enable popup notification show', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),


		array(
			'id' => 'ajax_popup_notification_auto_close',
			'type' => 'switch',
			'title' => __('Notifications are automatically closed', 'chfw-lang'),
			'desc' => __('Notifications are automatically closed', 'chfw-lang'),
			'default' => 0,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),

		array(
			'id' => 'ajax_popup_notification_off_time',
			'type' => 'slider',
			'title' => __('Pop-up notifications off time', 'chfw-lang'),
			'desc' => __('If open notifications, enter the switch-off time in seconds', 'chfw-lang'),
			'default' => '10',
			"min" => "1",
			"step" => "1",
			"max" => "1000"
		),
		array(
			'id' => 'shop_cart_info',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Cart Options', 'chfw-lang') . '</h3>',
		),


		array(
			'id' => 'cross_sell_show',
			'type' => 'switch',
			'title' => __('Display Cross Sell', 'chfw-lang'),
			'desc' => __('Display Cross Sell', 'chfw-lang'),
			'default' => 1,
			'on' => 'Enable',
			'off' => 'Disable'
		),


		array(
			'id' => 'cross_sell_products_per_page',
			'type' => 'slider',
			'title' => __('Cross Sell per Page', 'chfw-lang'),
			'desc' => __('Enter the number of products to display per page in the shop-catalog.', 'chfw-lang'),
			'default' => 4,
			'min' => 1,
			'max' => 12,
			'step' => 1,
			'display_value' => 'text',
			'required' => array('cross_sell_show', 'equals', array(1)),
		),


		array(
			'id' => 'product_page_info_shopp',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Badge Options', 'chfw-lang') . '</h3>',
		),


		array(
			'id' => 'account_border_select',
			'type' => 'image_select',
			'title' => __('Account Page Border Type ', 'chfw-lang'),
			'subtitle' => __('Select account border type', 'chfw-lang'),
			'options' => array(
				'1' => array(
					'alt' => 'Border ',
					'img' => ReduxFramework::$_url . 'assets/img/account_border.png'
				),
				'2' => array(
					'alt' => 'No Border',
					'img' => ReduxFramework::$_url . 'assets/img/account_non_border.png'
				),
			),
			'default' => '2'
		),

		array(
			'id' => 'new_badge',
			'type' => 'switch',
			'title' => __('Show new items badge ?', 'chfw-lang'),
			// 'desc' => __('Choose if you want to show a  NEW item badge over the new products', 'chfw-lang'),
			'hint' => array(
				'content' => __('Choose if you want to show a  NEW item badge over the new products', 'chfw-lang'),
			),
			'default' => 1,
			'on' => 'Enabled',
			'off' => 'Disabled'
		),
		array(
			'id' => 'new_badge_time',
			'type' => 'text',
			'title' => __('Number of Days to show badge', 'chfw-lang'),
			// 'desc' => __('Please insert the number of days after a product is published to display the badge', 'chfw-lang'),
			'hint' => array(
				// 'title' => '',
				'content' => __('Please insert the number of days after a product is published to display the badge', 'chfw-lang'),
			),
			'subtitle' => __('Subtitle', 'chfw-lang'),
			'default' => '7'
		),


		array(
			'id' => 'pagination_blog_info_shop',
			'icon' => true,
			'type' => 'info',
			'raw' => '<h3 class="redux_info">' . __('Shop Pagination Setting', 'chfw-lang') . '</h3>',
		),


		array(
			'id' => 'shop_pagination_type',
			'type' => 'select',
			'title' => __('Pagination Type', 'chfw-lang'),
			'desc' => __('Configure pagination product loading.', 'chfw-lang'),
			'options' => array(
				'numeric' => 'Numeric Pagination',
				'ajax' => 'Ajax Pagination',
			),
			'default' => 'ajax'
		),


	)
));