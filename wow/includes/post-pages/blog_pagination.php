<?php
/**
 * Global PAgination
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

global $wp_query, $CHfw_rdx_options, $page_setting_class, $scFW_globals;
$center_control_class = $page_setting_class->siteCenterControl();
/*
 * numeric = masonry ,standart
 * forced ajax =timeline,zigzag
 * optional = masonry ,standart
 * */
$page_type_       = $scFW_globals['page_type_'];
$page_type_result = $scFW_globals['page_type_result'];

/*-----------------------------------------------------------------------------------*/
/*	pagination Type (ajax , classic )
/*-----------------------------------------------------------------------------------*/
function scFW_pagination_type( $page_type_, $page_type_result ) {

	global $CHfw_rdx_options;
	$default_pagination_type = array(
			'page-masonry',
			'page-bloglist',
			'page-bloglist_small',
			'page-zigzagOne',
			'page-zigzagTwo',
			'archive_staff',
	);

	if ( $page_type_result == 'not_embed' ) {
		if ( is_archive() ) {

			if ( in_array( $CHfw_rdx_options['archive_view_style'], $default_pagination_type ) ) {
				$ret = true;
			} else {
				$ret = false;
			}
		} else {
			$ret = true;

		}

	} else {

		if ( is_archive() ) {
			if ( in_array( $page_type_, $default_pagination_type ) ) {
				$ret = true;
			} else {
				$ret = false;
			}
		} elseif ( in_array( $page_type_, $default_pagination_type ) ) {
			$ret = true;
		} else {
			$ret = false;
		}

	}

	return $ret;
}

$pagination_type_ = scFW_pagination_type( $page_type_, $page_type_result );

/*-----------------------------------------------------------------------------------*/
/*	Numeric pagination
/*-----------------------------------------------------------------------------------*/

function scFW_numeric_posts_pagination() {
	if ( is_singular() ) {
		return;
	}

	global $wp_query;

	/** Stop execution if there's only 1 page */
	if ( $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/**    Add current page to the array */
	if ( $paged >= 1 ) {
		$links[] = $paged;
	}

	/**    Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	echo '<ul>' . "\n";

	/**    Previous Post Link */
	if ( get_previous_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_previous_posts_link() );
	}

	/**    Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';

		printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );

		if ( ! in_array( 2, $links ) ) {
			echo '<li>&#46;&#46;&#46;</li>';
		}
	}

	/**    Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/**    Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			echo '<li>&#46;&#46;&#46;</li>' . "\n";
		}

		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li><a %s href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/**    Next Post Link */
	if ( get_next_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_next_posts_link() );
	}

	echo '</ul>' . "\n";

}

/*-----------------------------------------------------------------------------------*/
/*	get/redux  pagination
/*-----------------------------------------------------------------------------------*/
if ( isset( $_GET['blog_pagination'] ) ) {
	if ( $_GET['blog_pagination'] == 'ajax' ) {
		$blog_pagination_type = 'ajax';
	} elseif ( $_GET['blog_pagination'] == 'numeric' ) {
		$blog_pagination_type = 'numeric';
	} else {
		$blog_pagination_type = 'ajax';
	}

} elseif ( $scFW_globals['page_type_'] == "archive_staff" ) {
	$blog_pagination_type = isset( $CHfw_rdx_options['team_pagination_type'] ) ? $CHfw_rdx_options['team_pagination_type'] : 'ajax';
} else {
	$blog_pagination_type = isset( $CHfw_rdx_options['blog_pagination_type'] ) ? $CHfw_rdx_options['blog_pagination_type'] : 'ajax';
}

?>
<div class="pagination-centered">
	<div class="pagination-centered-col col-md-12- col-xs-12-">

		<?php if ( $blog_pagination_type == 'numeric' && $pagination_type_ ) : ?>
			<nav class="posts-pagination">
				<div class="pagination">
					<?php if ( function_exists( "scFW_numeric_posts_pagination" ) ) {
						scFW_numeric_posts_pagination();
					}
					?>
				</div>
			</nav>
		<?php endif; ?>
		<?php
		if ( $blog_pagination_type == 'ajax' && $pagination_type_ ) {
			if ( $wp_query->max_num_pages <= 1 ) {
				return;
			}

			?>
			<div id="blog_loadmore-container" class="loadmore-container">
				<div style="display: none" class="loadmore-link"><?php next_posts_link( '&nbsp;' ); ?></div>
				<div class="loadmore-controls">
					<div class="loadinger">
						<div id="Pagination-fountainG">
							<div id="Pagination-fountainG_1" class="Pagination-fountainG"></div>
							<div id="Pagination-fountainG_2" class="Pagination-fountainG"></div>
							<div id="Pagination-fountainG_3" class="Pagination-fountainG"></div>
							<div id="Pagination-fountainG_4" class="Pagination-fountainG"></div>
							<div id="Pagination-fountainG_5" class="Pagination-fountainG"></div>
							<div id="Pagination-fountainG_6" class="Pagination-fountainG"></div>
							<div id="Pagination-fountainG_7" class="Pagination-fountainG"></div>
							<div id="Pagination-fountainG_8" class="Pagination-fountainG"></div>
						</div>
					</div>
					<a href="#" class="loadmore-btn "><?php esc_html_e( 'Load More', 'chfw-lang' ); ?></a>
					<a href="#" style="display: none" class="loadmore-all-loaded"><?php esc_html_e( 'All posts loaded.', 'chfw-lang' ); ?></a>
				</div>
			</div>
		<?php } ?>

	</div>
</div>