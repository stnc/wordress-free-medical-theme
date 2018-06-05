<?php
global $CHfw_rdx_options,$page_setting_class;
$pid=get_the_ID();
$header_setting=$page_setting_class->header_type_selected($pid,'page_404');
get_header( $header_setting['header_type'] );
?>
<main id="main-container" class="404page">
    <div id="page-customize" class="">
        <div class="container">
            <div class="row">

                <!-- right-bar end  -->
                <div id="right-bar" class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div id="bodyheader">
                        <div class="ajax-page-content boxed-content contentbar ">
                            <div id="d404">
                                <h1 class="page-title">
                                    <?php _e('Page not found','chfw-lang') ?>
                                </h1>
                                <section id="404page" class=" blog">
	                                 <?php if ($CHfw_rdx_options['error404']!=''){
		                                 echo esc_attr($CHfw_rdx_options['error404']);
	                                 } else {
                                         wp_link_pages(  );
		                                  _e( 'The page you are looking for might have been removed, had its name changed, or is temporarily unavailable.', 'chfw-lang' );
	                                 }
	                                 ?>
                                    <div class="search-404">
                                        <form role="search" method="get" class="search-form"
                                              action="<?php echo esc_url( home_url('/') ); ?>">
                                            <label>
                                                <span class="screen-reader-text">Search for:</span>
                                                <input type="search" class="search-field" placeholder="Search"
                                                       value="" name="s" title="Search for:">
                                            </label>
                                            <input type="submit" class="search-submit" value="Search">
                                        </form>
                                    </div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- left-bar end  -->
        </div>
        <!-- main end  -->
    </div>
    <!-- row end  --> </main>
<!-- main end  -->
<?php
$footer_setting=$page_setting_class->footer_type_selected($pid,'page_404');
$footer_setting['footer_type'];
get_footer( $footer_setting['footer_type'] );