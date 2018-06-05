<?php
//slug = departmans/bla-bla
global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;
global $taxonomy;
$page_type_ = 'page-bloglist';


if (is_page_template('page-bloglist.php')) {
    $page_type_result = 'not_embed';
} else {
    $page_type_result = 'embed';
}

$scFW_globals['page_type_'] = $page_type_;
$scFW_globals['page_type_result'] = $page_type_result;
$pid = get_the_ID();
$page_setting_class->is_archive_page_ref = $scFW_globals['is_archive_page_ref'];
$page_setting_class->is_search_page_ref = $scFW_globals['is_search_page_ref'];
$page_setting_class->user_defined_page_type = $page_type_;
$page_setting_class->blog_list_view_layout = 'big-layout';//new
$page_setting_class->image_effect_type_for_post_page = 'overlay';
$page_setting_class->readmore_control = true;
$blog_args = $page_setting_class->blog_args();
$image_overlay_type = $page_setting_class->image_overlay_type();
$view_options = $page_setting_class->view_options('full');
$header_setting = $page_setting_class->header_type_selected($pid, $page_type_);
$post_border_class = $page_setting_class->PostBorderControl();
$header_setting = $page_setting_class->header_type_selected($pid, 'page');
$image_location = wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'CHfw-staffPostSize');
$doctor_main_info_container = "margin-size";
get_header($header_setting['header_type']);

$CHfw_Treatments = new CHfw_Treatments($pid);
$url = home_url('/');
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
                                <a itemprop="item" href="/treatments/">
                                <span
                                        itemprop="name"><?php echo __("Treatments ", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>

                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                                    <span itemprop="name">  <?php echo esc_attr(trim(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_title', $CHfw_meta_key_staff))) . ' ' . get_the_title() ?></span>
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
                                    <img src="<?php echo $image_location[0] ?>" alt="<?php echo get_the_title() ?>">
                                </figure>
                            </div>
                        <?php endif ?>
                        <div id="doctorInfo" class="col-md-7 <?php echo $doctor_main_info_container ?>">
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
                <div id="Treatments" class="<?php echo $doctor_main_info_container ?>">
                    <div class="page-bloglist" id="">
                        <div class="ajax-page-content boxed-content clearfix bloglist-page-top contentbar ">
                            <section id="doctor-detail-page"
                                     class="doctor-detail-page event-detail-page  <?php echo $post_border_class ?>">
                                <div id="single-page" class="doctor-profil-detail  col-lg-9 col-md-9  col-xs-12  ">
                                    <div class="article entry-content the-content">
                                        <?php

                                        if (have_posts()) {
                                            while (have_posts()) {
                                                the_post();
                                                $format_typeCH = get_post_format();
                                                unset($previousday);
                                                the_content();
                                            }
                                            wp_reset_postdata();
                                        } else {
                                            get_template_part('content', 'none');
                                        }
                                        ?>
                                    </div>
                                </div>


                                <div class="doctor-profil-sidebar  col-lg-3 col-md-3  col-xs-12 ">
                                    <nav id="accordion-menu-container" class="">
                                        <div class="responsive-menu">
                                            <div class="menu-header">
                                                <ul id="menu-mobil-menu" class="menu">
                                                    <?php if (!empty($CHfw_Treatments->myDepartmanLink)) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page  menu-item-has-children">
                                                            <a href="<?php echo esc_url($url . 'departmans'); ?>"><?php _e('Departman', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <li>
                                                                    <a href="<?php echo $CHfw_Treatments->myDepartmanLink ?>"><?php echo $CHfw_Treatments->MyDepartmanInfo->name ?></a>
                                                                </li>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_Treatments->DepartmentSubCatInfo_forSubProviders())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page  menu-item-has-children">
                                                            <a href="<?php echo esc_url($url . 'departmans'); ?>"><?php _e('Programs and Services', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_Treatments->DepartmentSubCatInfo_forSubProviders() as $DepartmentSubCatInfo_forSubProvider) {
                                                                    echo '<li><a href="' . get_the_permalink($CHfw_Treatments->ProvidersID) . '">' . $DepartmentSubCatInfo_forSubProvider->post_title . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>

                                                    <?php if (!empty($CHfw_Treatments->SubDepartmansList)) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page  menu-item-has-children">
                                                            <a href="<?php echo esc_url($url . 'departmans'); ?>"><?php _e('Related Programs and Services', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_Treatments->SubDepartmansList as $ProgramsandServices) {
                                                                    echo '<li><a href="' . $ProgramsandServices['link'] . '">' . $ProgramsandServices['title'] . '</a></li>';
                                                                }
                                                                ?>

                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_Treatments->staffs())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                                                            <a href="<?php echo esc_url($url . 'staff'); ?>"><?php echo __('Doctors', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_Treatments->staffs() as $staff) {
                                                                    echo '<li><a href="' . $staff['link'] . '">' . $staff['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>


                                                    <?php if (!empty($CHfw_Treatments->treatments())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                                                            <a href="<?php echo esc_url($url . 'resource_family'); ?>"><?php _e('Resource Family', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_Treatments->treatments() as $provider) {
                                                                    echo '<li><a href="' . $provider['link'] . '">' . $provider['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php
                                                    if (!empty($CHfw_Treatments->locations())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page menu-item-has-children">
                                                            <a href="<?php echo esc_url($url . 'locations'); ?>"><?php _e('Locations', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_Treatments->locations() as $location) {
                                                                    echo '<li><a href="' . $location['link'] . '">' . $location['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                </ul>
                                            </div>
                                        </div>
                                    </nav>

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
$footer_setting = $page_setting_class->footer_type_selected($pid, $page_type_);
get_footer($footer_setting['footer_type']);