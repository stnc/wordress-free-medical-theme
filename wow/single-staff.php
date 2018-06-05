<?php
global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;
$page_type_ = 'page-bloglist';

if (is_page_template('single-staff.php')) {
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
$header_setting = $page_setting_class->header_type_selected($pid, $page_type_);
$image_docktor = wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'CHfw-staffPostSize');
$image_docktor = $image_docktor[0];
$doctor_main_info_container = "";
$header_setting = $page_setting_class->header_type_selected($pid, 'page');
$image_location = wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'CHfw-staffPostSize');
$doctor_main_info_container = "margin-size";
get_header($header_setting['header_type']);
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
                                <a itemprop="item" href="/staff">
                                <span
                                      itemprop="name"><?php echo __("Doctors", 'chfw-lang') ?></span>
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
                        <?php if ($image_docktor != ""):
                            $doctor_main_info_container = "doctor-main-info-container";
                            ?>
                            <div id="doctorPhoto" class="col-md-5">
                                <figure class="doc-img">
                                    <img src="<?php echo $image_docktor ?>" alt="<?php echo get_the_title() ?>">
                                </figure>
                            </div>
                        <?php endif ?>
                        <div id="doctorInfo" class="col-md-7 <?php echo $doctor_main_info_container ?>">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName">
	                    <span class="doctorTitle">
		     <?php echo esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_title', $CHfw_meta_key_staff)) ?>
	                </span>
                                    <?php echo get_the_title() ?></h1>
                                <h2 class="doctorDepartment">
                                    <?php echo esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_expertise', $CHfw_meta_key_staff)); ?>
                                </h2>
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
                <div>
                    <div class="page-bloglist" id="bodyheader">
                        <div class="ajax-page-content boxed-content clearfix bloglist-page-top contentbar ">
                            <section id="doctor-detail-page"
                                     class="doctor-detail-page  <?php echo $page_setting_class->PostBorderControl() ?>">
                                <div class="doctor-profil-sidebar  col-lg-4 col-md-4  col-xs-12 ">

                                    <div class="heading-line"></div>
                                    <?php if (get_the_excerpt()!=""): ?>
                                    <div class="doctor-mini-info <?php echo $doctor_main_info_container ?>">
                                        <p><?php echo get_the_excerpt() ?></p>
                                    </div>
                                    <?php endif ?>
                                    <div class="doctor-mini-info doctor-main-info-container">
                                        <h4> <?php echo __("Personel Information", 'chfw-lang') ?></h4>
                                        <ul class="about">
                                            <?php

                                            $CHfwPlugin_birth = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_birth', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_birth != ""): ?>
                                                <li>
                                                    <i class="fa fa-calendar"></i>
                                                    <label><?php echo __("Date of birth", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_birth ?> </span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_adress = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_adress', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_adress != ""): ?>
                                                <li>
                                                    <i class="fa fa-map-marker"></i>
                                                    <label> <?php echo __("Adress", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_adress ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_email = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_email', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_email != ""): ?>
                                                <li>
                                                    <i class="fa fa-envelope"></i>
                                                    <label> <?php echo __("Email", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_email ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_phone = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_phone', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_phone != ""): ?>
                                                <li>
                                                    <i class="fa fa-phone"></i>
                                                    <label><?php echo __("Phone", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_phone ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_website = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_website', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_website != ""): ?>
                                                <li>
                                                    <i class="fa fa-globe"></i>
                                                    <label> <?php echo __("Website", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_website ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                        </ul>
                                    </div>
                                    <div class="doctor-mini-info doctor-main-info-container">
                                        <h4><i
                                                    class="fa fa-calendar"></i><?php echo __("Professional Skills ", 'chfw-lang') ?>
                                        </h4>
                                        <ul class="about">
                                            <?php
                                            $CHfwPlugin_expertise = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_expertise', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_expertise != ""): ?>
                                                <li>
                                                    <label> <?php echo __("Expertise", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_expertise ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_education = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_education', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_education != ""): ?>
                                                <li>
                                                    <label> <?php echo __("Education", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_education ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_degree = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_degree', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_degree != ""): ?>
                                                <li>
                                                    <label> <?php echo __("Degree", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_degree ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_experience = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_experience', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_experience != ""): ?>
                                                <li>
                                                    <label> <?php echo __("Experience", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_experience ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_profession = esc_attr(CHfw_get_metaSingle(get_the_ID(), 'CHfw-staffSetting_profession', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_profession != ""): ?>
                                                <li>
                                                    <label> <?php echo __("Profession", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_profession ?></span>

                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php

                                            $DepartmanProcess = new CHfw_DepartmanProcess();
                                            $CHfwPlugin_profession2 = array();
                                            $CHfwPlugin_profession = get_post_meta(get_the_ID(), 'CHfw_DrAndDep_program_and_services');

                                            if ((!empty($CHfwPlugin_profession))) {
                                                $CHfwPlugin_profession2 = explode(",", $CHfwPlugin_profession[0]);
                                            } else {
                                                $CHfwPlugin_profession2 = $CHfwPlugin_profession;
                                            }
                                            $program_and_services = $DepartmanProcess->DepartmentSubCatInfo_forSubProvider_ArrayList($CHfwPlugin_profession2);

                                            $CHfwLocations = get_post_meta(get_the_ID(), 'CHfw_DrAndDep_display_locations');

                                            if ((!empty($CHfwLocations))) {
                                                $CHfwLocations_ID = explode(",", $CHfwLocations[0]);
                                                $CHfwLocations_LiST = $DepartmanProcess->Department_Location_ArrayList($CHfwLocations_ID);
                                            }


                                            $staff_languages = get_the_terms(get_the_ID(), 'staff_languages');

                                            $CHfwPlugin_departman = get_post_meta(get_the_ID(), 'CHfw_DrAndDep_display_doctor_department');

                                            $MyDepartmanInfo = get_term_by('id', $CHfwPlugin_departman[0], 'mp-event_category');
                                            if (!empty($MyDepartmanInfo)) {
                                                $myDepartmanLink = get_term_link($MyDepartmanInfo->slug, 'mp-event_category');
                                            } else {
                                                $myDepartmanLink = "";
                                                $MyDepartmanInfo = new stdClass;
                                                $MyDepartmanInfo->name = "";
                                            }


                                            ?>
                                        </ul>
                                    </div>

                                    <div class="doctor-mini-info doctor-main-info-container">
                                        <h4><i class="fa fa-calendar"></i><?php echo __("Departmans", 'chfw-lang') ?>
                                        </h4>
                                        <ul class="about">
                                            <li>
                                                <a href="<?php echo $myDepartmanLink ?>"><?php echo $MyDepartmanInfo->name ?></a>
                                            </li>
                                        </ul>
                                    </div>


                                    <div class="doctor-mini-info doctor-main-info-container">
                                        <h4>
                                            <i class="fa fa-calendar"></i><?php echo __("Doctor Schedule", 'chfw-lang') ?>
                                        </h4>

                                        <div id="widgetized-area">
                                            <?php
                                            if (function_exists('dynamic_sidebar') && dynamic_sidebar('mptt-sidebar')) :
                                            else : ?>
                                                <div class="pre-widget">
                                                    <?php
                                                    dynamic_sidebar(get_post_meta(get_the_ID(), 'sidebars', true)); ?>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>

                                <div id="single-page" class="doctor-profil-detail  col-lg-8 col-md-8  col-xs-12  ">
                                    <div class="article entry-content the-content">
                                        <h4><?php echo __("About our Doctor", 'chfw-lang') ?></h4>
                                        <hr>
                                        <?php echo apply_filters('the_content', get_post_field('post_content', get_the_ID())); ?>
                                    </div>
                                    <?php
                                    $docktor_id = CHfw_get_metaSingle($post->ID, 'CHfw_DrAndDep_display_doctor_calendar');
                                    if (!empty($docktor_id)) : ?>
                                        <div id="hrefappoi" class="appoi">
                                            <h2> <?php echo __("Book an Appointment", 'chfw-lang') ?></h2>
                                            <div class="doctor-profil-detail  col-lg-6 col-md-6  col-xs-12">
                                                <?php

                                                echo do_shortcode('[booked-calendar calendar="' . $docktor_id . '"]');

                                                ?>
                                            </div>
                                            <div class="doctor-profil-detail col-lg-6 col-md-6 col-xs-12">
                                                <?php
                                                echo do_shortcode('[booked-appointments]');
                                                ?>
                                            </div>
                                        </div><!-- hrefappoi end-->
                                    <?php endif; ?>
                                </div><!-- single-page end-->
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