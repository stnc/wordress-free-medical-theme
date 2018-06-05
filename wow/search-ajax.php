<?php

global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;

$page_type_ = 'list';
$page_type_result = 'embed';

$scFW_globals['page_type_']       = $page_type_;
$scFW_globals['page_type_result'] = $page_type_result;


$page_setting_class->is_search_page_ref  = $scFW_globals['is_search_page_ref'];
$page_setting_class->blog_list_view_layout           = 'small-layout';
$page_setting_class->image_effect_type_for_post_page = 'overlay';
$image_overlay_type                                  = $page_setting_class->image_overlay_type();
$view_options                                        = $page_setting_class->view_options( 'full', 'page-bloglist_small ' );
$page_setting_class->user_defined_page_type          = $page_type_;
$post_border_class                                   = $page_setting_class->PostBorderControl();
$blog_limit = isset($CHfw_rdx_options['limit_posts']) ? $CHfw_rdx_options['limit_posts'] : 5;
$blog_order = isset($CHfw_rdx_options['blog_order']) ? $CHfw_rdx_options['blog_order'] : 'date';
$blog_args = array(
	'post_type' => 'post',
	'orderby'   => $blog_order,
	'paged'     => $paged,
	's'         => trim( $_GET['s'] )
);
?>

<div class="breadcrumb-container h150">
    <div class="container">
        <div class="row">
            <nav class="breadCrumb">
                <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                    <li>
                        <a itemprop="item" href="/">
                            <span  itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                        </a>
                        <meta itemprop="position" content="1">
                    </li>
                    <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                        <a itemprop="item" href="#">
                            <span itemprop="name"><?php echo __("Search", 'chfw-lang') ?></span>
                        </a>
                        <meta itemprop="position" content="2">
                    </li>
                </ol>
            </nav>
            <div class="breadcrumb-topInfo row">
                <div id="breadcrumb-Info_archive" class="col-sm-7">
                    <div class="breadcrumb-Sum">
                        <h1 class="breadcrumb-InfoName">
                            <?php
                            if ( isset( $CHfw_rdx_options['search_title'] ) && $CHfw_rdx_options['search_title'] != '' ) :
                                echo str_replace( '$', $_GET['s'], $CHfw_rdx_options['search_title'] );
                            else :
                                echo _e( 'Search Results For : ', 'chfw-lang' ) . ' ' . urldecode( $_GET['s'] );
                            endif;
                            ?>
                        </h1>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<section id="search-page" class="search-page_ajax bloglist-small-page blog <?php echo $post_border_class ?>">
	<?php
		$wp_query = new WP_Query( $blog_args );
		if ( $wp_query->have_posts() ) {
			while ( $wp_query->have_posts() ) {
				$wp_query->the_post();
				$format_typeCH = get_post_format();
				unset( $previousday );
				CHfw_get_post_formetter( $format_typeCH, $view_options, $CHfw_rdx_options );
			}
			wp_reset_postdata();
		} else {
			get_template_part( 'content', 'none' );
		}
	?>
</section>

