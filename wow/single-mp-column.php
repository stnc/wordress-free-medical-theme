
<?php
global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;
$page_type_ = 'page-bloglist';
if ( is_page_template( 'page-bloglist.php' ) ) {
	$page_type_result = 'not_embed';
} else {
	$page_type_result = 'embed';
}
$scFW_globals['page_type_']       = $page_type_;
$scFW_globals['page_type_result'] = $page_type_result;
$pid                                                 = get_the_ID();
$page_setting_class->is_archive_page_ref             = $scFW_globals['is_archive_page_ref'];
$page_setting_class->is_search_page_ref              = $scFW_globals['is_search_page_ref'];
$page_setting_class->user_defined_page_type          = $page_type_;
$page_setting_class->blog_list_view_layout           = 'big-layout';//new
$page_setting_class->image_effect_type_for_post_page = 'overlay';
$page_setting_class->readmore_control                = true;
$blog_args                                           = $page_setting_class->blog_args();
$image_overlay_type                                  = $page_setting_class->image_overlay_type();
$view_options                                        = $page_setting_class->view_options( 'full' );
$header_setting                                      = $page_setting_class->header_type_selected( $pid, $page_type_ );
$post_border_class                                   = $page_setting_class->PostBorderControl();
$header_setting                       = $page_setting_class->header_type_selected( $pid, 'page' );
get_header($header_setting['header_type'] );
?>
<main id="main-container" class="doctor-detailpage">
    <!--breadcrumb-container start-->
    <div class="breadcrumb-container">
        <div class="container">
            <div class="row">
                <nav class="breadCrumb">

                    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                        <li>
                            <a itemprop="item" href="/">
                                <span style="color: #005bd3"
                                      itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                            </a>
                            <meta itemprop="position" content="1">
                        </li>

                        <li>
                            <a itemprop="item" href="/mp-column">
                                <span
                                        itemprop="name"><?php echo __("Columb", 'chfw-lang') ?></span>
                            </a>
                            <meta itemprop="position" content="2">
                        </li>

                        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                            <a itemprop="item" href="#">
                                <span  itemprop="name">  <?php echo esc_attr(trim(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_title', $CHfw_meta_key_staff))) . ' ' . get_the_title() ?></span>
                            </a>
                            <meta itemprop="position" content="3">
                        </li>

                    </ol>

                </nav>
                <div class="breadcrumb-topInfo">
                    <?php if ($image_location[0] != ""):
                        $doctor_main_info_container = "doctor-main-info-container";
                        ?>
                        <div id="doctorPhoto" class="col-md-5">
                            <figure class="doc-img">
                                <img src="<?php echo   $image_location[0] ?>" alt="<?php echo get_the_title() ?>">
                            </figure>
                        </div>
                    <?php endif ?>
                    <div id="doctorInfo" class="col-md-7 <?php echo $doctor_main_info_container?>">
                        <div class="breadcrumb-Sum">
                            <h1 class="breadcrumb-InfoName">
	                    <span class="doctorTitle">
		                    <br><?php echo get_the_title() ?>
                            </h1>
                            </span>

                            <a href="#hrefappoi"
                               class="btn btn-secondary booking single-staff-btn"><?php echo __("Make An Appointment", 'chfw-lang') ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--breadcrumb-container end-->
   <div class="container">
      <div class="row">
         <div id="<?php echo $page_setting_class->layout_id_content ?>"
              class="<?php echo $page_setting_class->large_layout ?>">
            <div class="page-bloglist" id="bodyheader">
               <div class="ajax-page-content boxed-content clearfix bloglist-page-top contentbar ">
                  <section id="doctor-detail-page" class="doctor-detail-page  <?php echo $post_border_class ?>">

                     <div id="single-page" class="doctor-profil-detail  col-lg-8 col-md-8  col-xs-12  ">
                        <div class="article entry-content the-content">
	                        <?php
	                        do_action('mptt-single-mp-column-before-wrapper');

	                        do_action('mptt-single-before-wrapper');

	                        while (have_posts()) : the_post();
		                        ?>
		                        <div <?php post_class(apply_filters('mptt_main_wrapper_class', 'mptt-main-wrapper')) ?>>
								<?php
								mptt_column_template_content_title();
								mptt_column_template_content_post_content();

								?><div class="mptt-clearfix"></div>
							</div>
		                        <?php
	                        endwhile;
	                        do_action('mptt_after_main_wrapper'); ?>
	                        <div class="mptt-clearfix"></div>
	                        <?php
	                        do_action('mptt-single-mp-column-after-wrapper');

	                        ?>
                        </div>
                     </div>
	           <div class="doctor-profil-sidebar  col-lg-4 col-md-4  col-xs-12 ">
				<?php mptt_column_template_content_events_list()?>
                </div>
                  </section>
               </div>
            </div>
         </div>
      </div>
   </div>
</main>
	<!-- main end  -->
<?php
$footer_setting = $page_setting_class->footer_type_selected( $pid, $page_type_ );
get_footer( $footer_setting['footer_type'] );