<?php

global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;

$page_type_ = 'single-locations';


if (is_page_template('single-locations.php')) {
    $page_type_result = 'not_embed';
} else {
    $page_type_result = 'embed';
}

$scFW_globals['page_type_'] = $page_type_;
$scFW_globals['page_type_result'] = $page_type_result;
$CHfw_meta_key_staff = "CHfw-StaffLocation-Setting";
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
$image_location = wp_get_attachment_image_src(get_post_thumbnail_id($pid), 'CHfw-staffPostSize');
$doctor_main_info_container = "margin-size";
$header_setting = $page_setting_class->header_type_selected($pid, 'page');
get_header($header_setting['header_type']);
$page_setting_class->EmbedScript('location-page');
$locc = new CHfw_Locations($pid);
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
                                <a itemprop="item" href="/locations">
                                <span
                                        itemprop="name"><?php echo __("Locations", 'chfw-lang') ?></span>
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
                <div id="SingleLocation">
                    <div class="SingleLocation" id="bodyheader">
                        <div class="ajax-page-content boxed-content clearfix bloglist-page-top contentbar">
                            <section id="doctor-detail-page" class="doctor-detail-page <?php echo $page_setting_class->PostBorderControl() ?>">
                                <div class="doctor-profil-sidebar col-lg-4 col-md-4 col-xs-12">

                                    <div class="heading-line"></div>
                                    <div class="doctor-mini-info <?php echo $doctor_main_info_container ?>">
                                        <p><?php echo get_the_excerpt() ?></p>
                                    </div>
                                    <div class="doctor-mini-info <?php echo $doctor_main_info_container ?>">
                                        <h4> <?php echo __("Hospital Information", 'chfw-lang') ?></h4>
                                        <ul class="about">

                                            <?php
                                            $CHfwPlugin_adress = esc_attr(CHfw_get_meta($pid, 'CHfw-staffLocation-adress', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_adress != ""): ?>
                                                <li>
                                                    <i class="fa fa-map-marker"></i>
                                                    <label> <?php echo __("Adress", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_adress ?></span>
                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_email = esc_attr(CHfw_get_meta($pid, 'CHfw-staffLocation-email', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_email != ""): ?>
                                                <li>
                                                    <i class="fa fa-envelope"></i>
                                                    <label> <?php echo __("Email", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_email ?></span>
                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_phone = esc_attr(CHfw_get_meta($pid, 'CHfw-staffLocation-phone', $CHfw_meta_key_staff));
                                            if ($CHfwPlugin_phone != ""): ?>
                                                <li>
                                                    <i class="fa fa-phone"></i>
                                                    <label><?php echo __("Phone", 'chfw-lang') ?></label>
                                                    <span class="value"><?php echo $CHfwPlugin_phone ?></span>
                                                    <div class="clearfix"></div>
                                                </li>
                                            <?php endif; ?>
                                            <?php
                                            $CHfwPlugin_website = esc_attr(CHfw_get_meta($pid, 'CHfw-staffLocation-website', $CHfw_meta_key_staff));
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
                                </div>

                                <div id="single-page" class="doctor-profil-detail  col-lg-8 col-md-8  col-xs-12  ">
                                    <div class="article entry-content the-content">
                                        <h4><?php echo __("About our Hospital", 'chfw-lang') ?></h4>
                                        <hr>
                                        <?php echo apply_filters('the_content', get_post_field('post_content', $pid)); ?>
                                    </div>

                                    <div class="CHFW-Tabs">
                                        <ul class="nav nav-tabs responsive-tabs" id="myTabs" role="tablist">
                                            <li role="presentation" class="active">
                                                <a href="#DoctorsTabs" role="tab" id="doctors-tabs" data-toggle="tab"
                                                   aria-controls="Doctors"
                                                   aria-expanded="false">
                                                    <i class="fa fa-user-md" aria-hidden="true"></i>
                                                    <?php echo __("Doctors", 'chfw-lang') ?>
                                                </a>
                                            </li>

                                            <li role="presentation">
                                                <a href="#mapTabs" id="map-tab" role="tab" data-toggle="tab"
                                                   aria-controls="mapTabs"
                                                   aria-expanded="true">
                                                    <i class="fa fa-map-marker" aria-hidden="true"></i>
                                                    <?php echo __("Map", 'chfw-lang') ?>
                                                </a></li>
                                            <li role="presentation">
                                                <a href="#GalleryTabs" role="tab" id="profile-tab" data-toggle="tab"
                                                   aria-controls="Gallery"
                                                   aria-expanded="false">
                                                    <i class="fa fa-picture-o" aria-hidden="true"></i>
                                                    <?php echo __("Gallery", 'chfw-lang') ?>
                                                </a>
                                            </li>


                                            </li>
                                            <li role="presentation">
                                                <a href="#ServicesTabs" role="tab" class="active" id="services-tabs"
                                                   data-toggle="tab"
                                                   aria-controls="Services"
                                                   aria-expanded="false">
                                                    <i class="fa fa-h-square" aria-hidden="true"></i>
                                                    <?php echo __("Services", 'chfw-lang') ?>  </a>
                                            </li>
                                        </ul>
                                        <div class="tab-content" id="myTabContent">
                                            <div class="tab-pane fade active in" role="tabpanel" id="DoctorsTabs"
                                                 aria-labelledby="doctors-tab">
                                                <div class="row">
                                                    <?php foreach ($locc->staffs() as $staffs): ?>
                                                        <div class="doctorsLoad col-md-6">
                                                            <div class="row">
                                                                <div class="col-md-4 no-padding">
                                                                    <figure>
                                                                        <a href="<?php echo $staffs['link'] ?>">
                                                                            <img class="img-thumbnail"
                                                                                 src="<?php echo $staffs['img'] ?>"
                                                                                 alt="<?php echo $staffs['title'] ?>">
                                                                        </a>
                                                                    </figure>
                                                                </div>
                                                                <?php
                                                                $ser = "";
                                                                $serID = esc_attr(CHfw_get_metaSingle($staffs['id'], 'CHfw_DrAndDep_program_and_services'));
                                                                $serIDs = explode(',', $serID);
                                                                foreach ($serIDs as $sersid) {
                                                                    $ser .= get_the_title($sersid) . ',';
                                                                }
                                                                $dapID = esc_attr(CHfw_get_metaSingle($staffs['id'], 'CHfw_DrAndDep_display_doctor_department'));
                                                                $term = get_term_by('id', $dapID, 'mp-event_category');

                                                                if (!empty($term)) {
                                                                    $dap = $term->name;
                                                                } else {
                                                                    $dap ="";
                                                                }
                                                                ?>
                                                                <div class="col-md-8">
                                                                    <div class="doctorsLoadInfo">
                                                                        <a href="<?php echo $staffs['link'] ?>"><h2>
                                                                                <span><?php echo esc_attr(CHfw_get_metaSingle($staffs['id'], 'CHfw-staffSetting_title')); ?> </span>
                                                                                <span><?php echo $staffs['title'] ?></span>
                                                                            </h2></a>
                                                                        <span class="extraInstruction"><?php echo $dap; ?></span>
                                                                        <div class="doctorsLoadDetails">
                                                                            <strong><?php echo __("Specialties : ", 'chfw-lang') ?></strong>
                                                                            <p>   <?php echo substr($ser, 0, -1) ?> </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                            <!--end docktors-->


                                            <div class="tab-pane fade" role="tabpanel" id="mapTabs"
                                                 aria-labelledby="map-tab">
                                                <?php
                                                $latitude = CHfw_get_meta($pid, 'CHfw-staffLocation-latitude', 'CHfw-StaffLocation-Setting');
                                                $title = get_the_title();
                                                $adress = CHfw_get_meta($pid, 'CHfw-staffLocation-adress', 'CHfw-StaffLocation-Setting');
                                                $zipCode = CHfw_get_meta($pid, 'CHfw-staffLocation-zipCode', 'CHfw-StaffLocation-Setting');
                                                $email = CHfw_get_meta($pid, 'CHfw-staffLocation-email', 'CHfw-StaffLocation-Setting');
                                                $phone = CHfw_get_meta($pid, 'CHfw-staffLocation-phone', 'CHfw-StaffLocation-Setting');
                                                $latitudeExplode = explode(",", $latitude);

                                                if (!empty($latitude)) {
                                                    $latitudeExplode = explode(",", $latitude);
                                                    $hospitalList["Latitude"] = $latitudeExplode[0];
                                                    $hospitalList["Longitude"] = $latitudeExplode[1];
                                                    $hospitalList1 = '\'{"address":"' . $adress . ' ' . $zipCode . '","title":"' . $title . '","Latitude":' . $latitudeExplode[0] . ',"Longitude":' . $latitudeExplode[1] . ',"tel":"' . $phone . '","mail":"' . $email . '"}\'';
                                                } else {
                                                    $hospitalList["Latitude"] = "";
                                                    $hospitalList["Longitude"] = "";
                                                    $hospitalList1 = '\'{"address":"' . $adress . ' ' . $zipCode . '","title":"' . $title . '","tel":"' . $phone . '","mail":"' . $email . '"}\'';
                                                }
                                                ?>
                                                <script>
                                                    var addresses_localStorage = [<?php echo $hospitalList1 ?> ];
                                                    var FirstAddresses_localStorage = "<?php echo $latitudeExplode[0] . ', ' . $latitudeExplode[1]  ?>";
                                                    localStorage.addresses_localStorage = JSON.stringify(addresses_localStorage);
                                                    localStorage.FirstAddresses_localStorage = JSON.stringify(FirstAddresses_localStorage);
                                                    localStorage.MapZOOM = 7;
                                                    jQuery(function () {
                                                        jQuery('.responsive-tabs').responsiveTabs({
                                                            accordionOn: ['xs', 'sm']
                                                        });
                                                    });
                                                </script>

                                                <div id="map_canvas"></div>
                                            </div>
                                            <!--end maps-->
                                            <div class="tab-pane fade" role="tabpanel" id="GalleryTabs" aria-labelledby="Gallery-tab">
                                                <?php
                                                $imagesBUll_ = trim(CHfw_get_meta($pid, 'CHfw-staffLocation-media', $CHfw_meta_key_staff));
                                                if (!empty($imagesBUll_)) {
                                                    $imagesBUlls = explode(',', $imagesBUll_);
                                                    $imagesBUlls = array_unique($imagesBUlls);
                                                    foreach ($imagesBUlls as $key => $val) {
                                                        if ($val == '') {
                                                            unset($imagesBUlls[$key]);
                                                        }
                                                    }
                                                }
                                                ?>
                                                <div class="CHFW-img-container">
                                                    <div class="images-container">
                                                        <?php
                                                        if (!empty($imagesBUlls)) :
                                                            foreach ($imagesBUlls as $imagesBUll) :
                                                                $imagewow_thumb = wp_get_attachment_image_src($imagesBUll, 'wow-widget-post');
                                                                $imagewow = wp_get_attachment_image_src($imagesBUll, 'wow-BlogList_MediumSmall_SidebarOpen');
                                                                ?>
                                                                <div class="single-image">
                                                                    <a class="ch-lightbox" data-mfp-type="image" href="<?php echo $imagewow[0]; ?>">
                                                                        <img src="<?php echo $imagewow[0] ?>" alt="<?php echo the_title(); ?>">
                                                                    </a>
                                                                </div>
                                                            <?php endforeach; ?>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end gallery-->

                                            <div class="tab-pane fade" role="tabpanel" id="ServicesTabs"
                                                 aria-labelledby="services-tab">
                                                <div class="row">
                                                    <?php foreach ($locc->Program_and_services() as $Program_and_services): ?>
                                                        <ul>
                                                            <li>
                                                                <a href="<?php echo get_the_permalink($Program_and_services->ID) ?>"><?php echo $Program_and_services->post_title ?></a>
                                                            </li>
                                                        </ul>
                                                    <?php endforeach ?>
                                                </div>
                                            </div>
                                            <!--end services-->


                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
<?php
$footer_setting = $page_setting_class->footer_type_selected($pid, $page_type_);
get_footer($footer_setting['footer_type']);
