<?php

/**
 * Filter Helper
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 1.0
 * note: https://wordpress.org/plugins/yith-woocommerce-ajax-navigation/screenshots/
 * Note: This is a modified version of the "WooCommerce Price Filter" widget
 */
class CHfw_woo_filter_helper {


	/**
	 * @var bool Check for old WooCommerce Version
	 * @since 3.0
	 */
	public $current_wc_version  = false;
	public $is_wc_older_2_1     = false;
	public $is_wc_older_2_6     = false;


	/**
	 * @var array deprecated array from WC_QUERY
	 * @since version 3.0
	 */
	public $filtered_product_ids_for_taxonomy   = array();
	public $layered_nav_product_ids             = array();
	public $unfiltered_product_ids              = array();
	public $filtered_product_ids                = array();
	public $layered_nav_post__in                = array();

	/**
	 * @var string filtered term fields
	 * Before WooCommerce 2.6 product attribute use term_id for filter.
	 * From WooCommerce 2.6 use slug instead.
	 * @since 3.0.0
	 */
	public $filter_term_field = 'slug';

	public function __construct() {
		$this->current_wc_version =  WC()->version;
		$this->is_wc_older_2_1    = version_compare( $this->current_wc_version, '2.1', '<' );
		$this->is_wc_older_2_6    = version_compare( $this->current_wc_version, '2.6', '<' );

		if( $this->is_wc_older_2_6 ){
			$this->filter_term_field = 'term_id';
		}


		add_filter( 'the_posts', array( $this, 'the_posts' ), 15, 2 );

		add_filter( 'woocommerce_is_layered_nav_active', '__return_true' );

		add_action('wp_ajax_yith_wcan_select_type', array( $this, 'ajax_print_terms') );

	}



	function yit_wcan_get_product_taxonomy() {
		global $_attributes_array;
		$product_taxonomies = ! empty( $_attributes_array ) ? $_attributes_array : get_object_taxonomies( 'product' );

		/** @noinspection PhpInconsistentReturnPointsInspection */
		return array_merge( $product_taxonomies, apply_filters( 'yith_wcan_product_taxonomy_type', array() ) );
	}

	/**
	 * Get the product brands taxonomy name
	 *
	 * @return string the product brands taxonomy name if YITH WooCommerce Brands addons is currently activated
	 *
	 * @since    2.7.6
	 * @author   Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	function yit_get_brands_taxonomy(){

		$taxonomy = "product_brand";

		return $taxonomy;
	}

	/**
	 * Get current layered link
	 *
	 * @return string|bool The new link
	 *
	 * @since    1.4
	 * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 */
	function yit_get_woocommerce_layered_nav_link() {
		$return = false;
		if ( defined( 'SHOP_IS_ON_FRONT' ) || ( is_shop() && ! is_product_category() ) ) {
			$taxonomy           = get_query_var( 'taxonomy' );
			$brands_taxonomy    = $this->yit_get_brands_taxonomy();
			$return             = get_post_type_archive_link( 'product' );
			if( ! empty( $brands_taxonomy ) && $brands_taxonomy == $taxonomy ){
				$return = add_query_arg( array( $taxonomy => get_query_var( 'term' ) ), $return );
			}
			return apply_filters( 'yith_wcan_untrailingslashit', true ) && is_string( $return ) ? untrailingslashit( $return ) : $return;
		}

		elseif ( is_product_category() ) {
			$return = get_term_link( get_queried_object()->slug, 'product_cat' );
			return apply_filters( 'yith_wcan_untrailingslashit', true ) && is_string( $return ) ? untrailingslashit( $return ) : $return;
		}

		else {
			$taxonomy           = get_query_var( 'taxonomy' );
			$brands_taxonomy    = yit_get_brands_taxonomy();

			if( ! empty( $brands_taxonomy ) && $brands_taxonomy == $taxonomy ){
				$return = add_query_arg( array( $taxonomy => get_query_var( 'term' ) ), get_post_type_archive_link( 'product' ) );
			}

			else {
				$term = get_query_var( 'term' );
				$return = get_term_link( yith_wcan_is_product_attribute() && is_numeric( $term ) ? intval( $term ) : $term, $taxonomy );
			}

			return apply_filters( 'yith_wcan_untrailingslashit', true ) && is_string( $return ) ? untrailingslashit( $return ) : $return;
		}

		return $return;
	}

	/**
	 * Get choosen attribute args
	 *
	 * @author Andrea Grillo <andrea.grillo@yithemes.com>
	 * @since  2.9.3
	 * @return array
	 */
	public function get_layered_nav_chosen_attributes(){
		$chosen_attributes = array();
		if( $this->is_wc_older_2_6 ){
			global $_chosen_attributes;
			$chosen_attributes = $_chosen_attributes;
		}

		else {

			$chosen_attributes = WC_Query::get_layered_nav_chosen_attributes();


		}
		return $chosen_attributes;
	}

	/**
	 * Layered Nav post filter.
	 *
	 * @param array $filtered_posts
	 * @return array
	 */
	public function layered_nav_query( $filtered_posts  = array() ) {
		$_chosen_attributes = $this->get_layered_nav_chosen_attributes();

		$is_product_taxonomy = false;
		if( is_product_taxonomy() ){
			$is_product_taxonomy = array(
				'taxonomy'  => get_queried_object()->taxonomy,
				'terms'     =>  get_queried_object()->slug,
				'field'     =>$this->filter_term_field
			);
		}

		if ( sizeof( $_chosen_attributes ) > 0 ) {

			$matched_products   = array(
				'and' => array(),
				'or'  => array()
			);
			$filtered_attribute = array(
				'and' => false,
				'or'  => false
			);

			foreach ( $_chosen_attributes as $attribute => $data ) {
				$matched_products_from_attribute = array();
				$filtered = false;

				if ( sizeof( $data['terms'] ) > 0 ) {
					foreach ( $data['terms'] as $value ) {

						$args = array(
							'post_type' 	=> 'product',
							'numberposts' 	=> -1,
							'post_status' 	=> 'publish',
							'meta_key'      => '_visibility',
							'meta_value'    => 'visible',
							'fields' 		=> 'ids',
							'no_found_rows' => true,
							'tax_query' => array(
								array(
									'taxonomy' 	=> $attribute,
									'terms' 	=> $value,
									'field' 	=> $this->filter_term_field
								)
							)
						);


						if( $is_product_taxonomy ){
							$args['tax_query'][] = $is_product_taxonomy;
						}

						//TODO: Increase performance for get_posts()
						$post_ids = apply_filters( 'woocommerce_layered_nav_query_post_ids', get_posts( $args ), $args, $attribute, $value );

						if ( ! is_wp_error( $post_ids ) ) {

							if ( sizeof( $matched_products_from_attribute ) > 0 || $filtered ) {
								$matched_products_from_attribute = $data['query_type'] == 'or' ? array_merge( $post_ids, $matched_products_from_attribute ) : array_intersect( $post_ids, $matched_products_from_attribute );
							} else {
								$matched_products_from_attribute = $post_ids;
							}

							$filtered = true;
						}
					}
				}

				if ( sizeof( $matched_products[ $data['query_type'] ] ) > 0 || $filtered_attribute[ $data['query_type'] ] === true ) {
					$matched_products[ $data['query_type'] ] = ( $data['query_type'] == 'or' ) ? array_merge( $matched_products_from_attribute, $matched_products[ $data['query_type'] ] ) : array_intersect( $matched_products_from_attribute, $matched_products[ $data['query_type'] ] );
				} else {
					$matched_products[ $data['query_type'] ] = $matched_products_from_attribute;
				}

				$filtered_attribute[ $data['query_type'] ] = true;

				$this->filtered_product_ids_for_taxonomy[ $attribute ] = $matched_products_from_attribute;
			}

			// Combine our AND and OR result sets
			if ( $filtered_attribute['and'] && $filtered_attribute['or'] )
				$results = array_intersect( $matched_products[ 'and' ], $matched_products[ 'or' ] );
			else
				$results = array_merge( $matched_products[ 'and' ], $matched_products[ 'or' ] );

			if ( $filtered ) {

				$this->layered_nav_post__in   = $results;
				$this->layered_nav_post__in[] = 0;

				if ( sizeof( $filtered_posts ) == 0 ) {
					$filtered_posts   = $results;
					$filtered_posts[] = 0;
				} else {
					$filtered_posts   = array_intersect( $filtered_posts, $results );
					$filtered_posts[] = 0;
				}

			}
		}

		else {

			$args = array(
				'post_type'     => 'product',
				'numberposts'   => -1,
				'post_status'   => 'publish',
				'meta_key'     => '_visibility',
				'meta_value'   => 'visible',
				'fields'        => 'ids',
				'no_found_rows' => true,
				'tax_query' => array()
			);


			if( $is_product_taxonomy ){
				$args['tax_query'][] = $is_product_taxonomy;
			}

			$queried_object = is_object( get_queried_object() ) ? get_queried_object() : false;

			$taxonomy   = $queried_object && property_exists( $queried_object, 'taxonomy' ) ? $queried_object->taxonomy : false;
			$slug       = $queried_object && property_exists( $queried_object, 'slug' ) ? $queried_object->slug : false;

			//TODO: Increase performance for get_posts()
			$post_ids = apply_filters( 'woocommerce_layered_nav_query_post_ids', get_posts( $args ), $args, $taxonomy, $slug );

			if( ! is_wp_error( $post_ids ) ){
				$this->layered_nav_post__in   = $post_ids;
				$this->layered_nav_post__in[] = 0;

				if ( sizeof( $filtered_posts ) == 0 ) {
					$filtered_posts   = $post_ids;
					$filtered_posts[] = 0;
				}

				else {
					$filtered_posts   = array_intersect( $filtered_posts, $post_ids );
					$filtered_posts[] = 0;
				}
			}
		}

		return (array) $filtered_posts;
	}


	/**
	 * Select the correct query object
	 *
	 * @access public
	 * @param WP_Query|bool $query (default: false)
	 * @return the query object
	 */
	public function select_query_object( $current_wp_query ){
		global $wp_the_query;
		//print_r($wp_the_query);
		//print_r($current_wp_query);
		//print_r($current_wp_query->query );
		return apply_filters( 'yith_wcan_use_wp_the_query_object', false ) ? $wp_the_query->query : $current_wp_query->query;
	}



	/**
	 * Get the array of objects terms
	 *
	 * @param $type A type of term to display
	 *
	 * @return $terms mixed|array
	 *
	 * @since  1.3.1
	 */
	function yit_get_terms( $case, $taxonomy, $instance = false ) {

		$exclude = apply_filters( 'yith_wcan_exclude_terms', array(), $instance );
		$include = apply_filters( 'yith_wcan_include_terms', array(), $instance );
		$reordered = false;

		switch ( $case ) {

			case 'all':
				$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true, 'exclude' => $exclude ) );
				break;

			case 'hierarchical':
				$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true, 'exclude' => $exclude ) );
				if( ! in_array( $instance['type'], apply_filters( 'yith_wcan_display_type_list', array( 'list' ) ) ) ) {
					$terms = yit_reorder_terms_by_parent( $terms, $taxonomy );
					$reordered = true;
				}
				break;

			case 'parent' :
				$terms = get_terms( array( 'taxonomy' => $taxonomy, 'hide_empty' => true, 'parent' => false, 'exclude' => $exclude ) );
				break;

			default:
				$display= isset($instance['display'] ) ? $instance['display'] :'';
						$args = array( 'taxonomy' => $taxonomy, 'hide_empty' => true, 'exclude' => $exclude, 'include' => $include );
				if ( 'parent' == $display ) {
					$args['parent'] = false;
				}

				$terms = get_terms( $args );

				if ( 'hierarchical' == $display ) {
					if( ! in_array( $instance['type'], apply_filters( 'yith_wcan_display_type_list', array( 'list' ) ) ) ) {
						$terms = yit_reorder_terms_by_parent( $terms, $taxonomy );
						$reordered = true;
					}
				}
				break;
		}

		if( 'product' == $this->yith_wcan_get_option( 'yith_wcan_ajax_shop_terms_order', 'alphabetical' ) && 'hierarchical' !=$display && ! is_wp_error( $terms ) && ! $reordered ){
			usort( $terms, 'yit_terms_sort' );
		}

		return apply_filters( 'yith_wcan_get_terms_list', $terms, $taxonomy, $instance );
	}


	function yith_wcan_get_option( $option_name = false, $default = false ) {
		$options = get_option( 'yit_wcan_options' );

		if ( ! $option_name ) {
			return $options;
		}

		return isset( $options[$option_name] ) ? $options[$option_name] : $default;
	}

	/**
	 * Hook into the_posts to do the main product query if needed - relevanssi compatibility.
	 *
	 * @access public
	 * @param array $posts
	 * @param WP_Query|bool $query (default: false)
	 * @return array
	 */
	public function the_posts( $posts, $query = false ) {



		if( $this->is_wc_older_2_6 ){
			add_action( 'wp', array( $this, 'layered_navigation_array_for_wc_older_26' ) );
		}

		else{

			$filtered_posts   = array();
			$queried_post_ids = array();
			$query_filtered_posts = $this->layered_nav_query();


			foreach ( $posts as $post ) {

				if ( in_array( $post->ID, $query_filtered_posts ) ) {
					$filtered_posts[]   = $post;
					$queried_post_ids[] = $post->ID;
				}
			}

			$query->posts       = $filtered_posts;
			$query->post_count  = count( $filtered_posts );

			// Get main query

			$current_wp_query = $this->select_query_object( $query );

			if( is_array( $current_wp_query ) ){
				// Get WP Query for current page (without 'paged')
				unset( $current_wp_query['paged'] );
			}
			else {
				$current_wp_query = array();
			}


			// Ensure filters are set
			$unfiltered_args = array_merge(
				$current_wp_query,
				array(
					'post_type'              => 'product',
					'numberposts'            => -1,
					'post_status'            => 'publish',
					'meta_query'             => is_object( $current_wp_query ) ? $current_wp_query->meta_query : array(),
					'fields'                 => 'ids',
					'no_found_rows'          => true,
					'update_post_meta_cache' => false,
					'update_post_term_cache' => false,
					'pagename'               => '',
					'wc_query'               => 'get_products_in_view'
				)
			);

			$hide_out_of_stock_items = apply_filters( 'yith_wcan_hide_out_of_stock_items', 'yes' == get_option( 'woocommerce_hide_out_of_stock_items' ) ? true : false );

			if( $hide_out_of_stock_items ){
				$unfiltered_args['meta_query'][] = array(
					'key' => '_stock_status',
					'value' => 'instock',
					'compare' => 'AND'
				);
			}

			$this->unfiltered_product_ids = get_posts( $unfiltered_args );
			$this->filtered_product_ids   = $queried_post_ids;

			// Also store filtered posts ids...
			if ( sizeof( $queried_post_ids ) > 0 ) {
				$this->filtered_product_ids = array_intersect( $this->unfiltered_product_ids, $queried_post_ids );
			} else {
				$this->filtered_product_ids = $this->unfiltered_product_ids;
			}

			if ( sizeof( $this->layered_nav_post__in ) > 0 ) {
				$this->layered_nav_product_ids = array_intersect( $this->unfiltered_product_ids, $this->layered_nav_post__in );
			} else {
				$this->layered_nav_product_ids = $this->unfiltered_product_ids;
			}
		}


		return $posts;
	}


	public function layered_navigation_array_for_wc_older_26(){
		if( $this->is_wc_older_2_6 ){
			$this->filtered_product_ids_for_taxonomy   = WC()->query->filtered_product_ids_for_taxonomy;
			$this->layered_nav_product_ids             = WC()->query->layered_nav_product_ids;
			$this->unfiltered_product_ids              = WC()->query->unfiltered_product_ids;
			$this->filtered_product_ids                = WC()->query->filtered_product_ids;
			$this->layered_nav_post__in                = WC()->query->layered_nav_post__in;
		}
	}
}