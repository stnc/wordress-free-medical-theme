<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

/**
 * Widget Woocomemrce Product Sorting
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_WC_Widget_Product_Sorting extends WC_Widget {

	/* ---------------------------------------------------------------------------
	 * INIT
	 * --------------------------------------------------------------------------- */
	public function __construct() {
		$this->widget_cssclass    = 'ch_product_sorting_widget woocommerce';
		$this->widget_description = __( 'Display a product sorting list.', 'chfw-lang' );
		$this->widget_id          = 'ch_product_sorting_widget';
		$this->widget_name        = __( 'CH WooCommerce Ajax Product Sorting', 'chfw-lang' );
		$this->settings           = array(
			'title' => array(
				'type'  => 'text',
				'std'   => __( 'Sort By', 'chfw-lang' ),
				'label' => __( 'Title', 'chfw-lang' )
			)
		);

		parent::__construct();
	}

	/**
	 * Widget function
	 *
	 * @see WP_Widget
	 * @access public
	 *
	 * @param array $args
	 * @param array $instance
	 *
	 * @return void
	 */
	public function widget( $args, $instance ) {
		global $wp_query;

		extract( $args );

		$title = ( ! empty( $instance['title'] ) ) ? $before_title . $instance['title'] . $after_title : '';

		$output = '';

		if ( 1 != $wp_query->found_posts || woocommerce_products_will_display() ) {
			$output .= '<ul id="chproduct-sorting" class="chproduct-sorting">';

			$orderby = isset( $_GET['orderby'] ) ? wc_clean( $_GET['orderby'] ) : apply_filters( 'woocommerce_default_catalog_orderby', get_option( 'woocommerce_default_catalog_orderby' ) );
			$orderby == ( $orderby === 'title' ) ? 'menu_order' : $orderby; // Fixed: 'title' is default before WooCommerce settings are saved

			$catalog_orderby_options = apply_filters( 'woocommerce_catalog_orderby', array(
				'menu_order' => __( 'Default', 'chfw-lang' ),
				'popularity' => __( 'Popularity', 'chfw-lang' ),
				'rating'     => __( 'Average rating', 'chfw-lang' ),
				'date'       => __( 'Newness', 'chfw-lang' ),
				'price'      => __( 'Price: Low to High', 'chfw-lang' ),
				'price-desc' => __( 'Price: High to Low', 'chfw-lang' )
			) );

			if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
				unset( $catalog_orderby_options['rating'] );
			}


			/* Build entire current page URL (including query strings) */
			global $wp;
			$link = home_url( $wp->request ); // Base page URL

			// Unset query strings used for Ajax shop filters
			unset( $_GET['shop_load'] );
			unset( $_GET['_'] );

			$qs_count = count( $_GET );

			// Any query strings to add?
			if ( $qs_count > 0 ) {
				$i = 0;
				$link .= '?';

				// Build query string
				foreach ( $_GET as $key => $value ) {
					$i ++;
					$link .= $key . '=' . $value;
					if ( $i != $qs_count ) {
						$link .= '&';
					}
				}
			}


			foreach ( $catalog_orderby_options as $id => $name ) {
				if ( $orderby == $id ) {
					$output .= '<li class="active">' . esc_attr( $name ) . '</li>';
				} else {
					// Add 'orderby' URL query string
					$link = add_query_arg( 'orderby', $id, $link );
					$output .= '<li><a href="' . esc_url( $link ) . '">' . esc_attr( $name ) . '</a></li>';
				}
			}

			$output .= '</ul>';
		}

		echo $before_widget . $title . $output . $after_widget;
	}

}
