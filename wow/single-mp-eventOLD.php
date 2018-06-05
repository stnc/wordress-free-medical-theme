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
$CHfw_EventInfo = new CHfw_Mp_event_Page($pid);
$url = home_url('/');
?>
    <main id="main-container" class="doctor-detailpage">
        <div class="doctorHead">
            <div class="container">
                <div class="row">
                    <nav class="breadCrumb">
                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                                    <span style="color: #005bd3" itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li>
                                <a itemprop="item" href="/departmans/">
                                    <span style="color: #005bd3" itemprop="name"><?php echo __("Departments", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                        <span style="color: #000"
                              itemprop="name">  <?php echo get_the_title() ?></span>
                                </a>
                                <meta itemprop="position" content="3">
                            </li>
                        </ol>
                    </nav>
                    <div class="doctorTop">
                        <?php if ($image_location[0] != ""):
                            $doctor_main_info_container = "doctor-main-info-container"; ?>
                            <div id="doctorPhoto" class="col-sm-5 col-md-69 col-xs-12 col-ms-12">
                                <figure class="doc-img doctorImg-event">
                                    <?php mptt_event_template_content_thumbnail() ?>
                                </figure>
                            </div>
                        <?php endif ?>
                        <div id="doctorInfo" class="col-sm-7 col-md-69 col-xs-12 col-ms-12 <?php echo $doctor_main_info_container ?>">
                            <div class="doctorSum">
                                <div class="col-sm-6">
                                    <h1 class="doctorName"><?php echo get_the_title() ?></h1>
                                </div>
                                <div class="col-sm-6 hidden-xs hidden-sm">
                                    <a href="#content"
                                       class="btn btn-secondary booking"><?php echo __("Make An Appointment", 'chfw-lang') ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
            <div class="row">
                <div>
                    <div class="page-bloglist" id="bodyheader">
                        <div class="ajax-page-content boxed-content clearfix bloglist-page-top contentbar">
                            <section id="deparmansPage" class="doctor-detail-page event-detail-page <?php echo $post_border_class ?>">
                                <?php
                                if (isset($_GET['staff']) && $_GET['staff'] == 1) {
                                    include "includes/hospital/departman/doctors.php";
                                } else if (isset($_GET['prgAndService']) && $_GET['prgAndService'] == 1) {
                                    include "includes/hospital/departman/programAndServices.php";
                                } else if (isset($_GET['conditions']) && $_GET['conditions'] == 1) {
                                    include "includes/hospital/departman/conditions.php";
                                } else if (isset($_GET['treatments']) && $_GET['treatments'] == 1) {
                                    include "includes/hospital/departman/treatments.php";
                                } else if (isset($_GET['resource_family']) && $_GET['resource_family'] == 1) {
                                    include "includes/hospital/departman/resource_family.php";
                                } else if (isset($_GET['providers']) && $_GET['providers'] == 1) {
                                    include "includes/hospital/departman/providers.php";
                                } else if (isset($_GET['locations']) && $_GET['locations'] == 1) {
                                    include "includes/hospital/departman/locations.php";
                                } else {
                                    include "includes/hospital/departman/masterInfo.php";
                                }
                                ?>
                                <div class="doctor-profil-sidebar col-lg-3 col-md-3  col-xs-12">
                                    <nav id="accordion-menu-container">
                                        <div class="responsive-menu">
                                            <div class="menu-header">
                                                <ul id="menu-mobil-menu" class="menu">
                                                    <?php if (!empty($CHfw_EventInfo->SubDepartmansList_ProgramsandServices)) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children">
                                                            <a href="<?php echo home_url($wp->request) . '?prgAndService=1&dep=' . $pid; ?>"><?php _e('Programs and Services', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_EventInfo->SubDepartmansList_ProgramsandServices as $ProgramsandServices) {
                                                                    echo '<li><a href="' . $ProgramsandServices['link'] . '">' . $ProgramsandServices['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_EventInfo->staffs())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children">
                                                            <a href="<?php echo home_url($wp->request) . '?staff=1&dep=' . $pid; ?>">
                                                                <?php _e('Doctors', 'chfw-lang') ?>
                                                            </a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_EventInfo->staffs() as $staff) {
                                                                    echo '<li><a href="' . $staff['link'] . '">' . $staff['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_EventInfo->conditions())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children">
                                                            <a href="<?php echo home_url($wp->request) . '?conditions=1&dep=' . $pid; ?>">
                                                                <?php _e('Conditions', 'chfw-lang') ?>
                                                            </a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_EventInfo->conditions() as $Conditions) {
                                                                    echo '<li><a href="' . $Conditions['link'] . '">' . $Conditions['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_EventInfo->treatments())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children">
                                                            <a href="<?php echo home_url($wp->request) . '?treatments=1&dep=' . $pid; ?>"><?php _e('Treatments', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_EventInfo->treatments() as $Treatment) {
                                                                    echo '<li><a href="' . $Treatment['link'] . '">' . $Treatment['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_EventInfo->resource_family())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children">
                                                            <a href="<?php echo home_url($wp->request) . '?resource_family=1&dep=' . $pid; ?>">
                                                                <?php _e('Resource Family', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_EventInfo->resource_family() as $resource_family_row) {
                                                                    echo '<li><a href="' . $resource_family_row['link'] . '">' . $resource_family_row['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_EventInfo->providers())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children">
                                                            <a href="<?php echo home_url($wp->request) . '?providers=1&dep=' . $pid; ?>"><?php _e('Resource Providers', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_EventInfo->providers() as $provider) {
                                                                    echo '<li><a href="' . $provider['link'] . '">' . $provider['title'] . '</a></li>';
                                                                }
                                                                ?>
                                                            </ul>
                                                        </li>
                                                    <?php endif ?>
                                                    <?php if (!empty($CHfw_EventInfo->locations())) : ?>
                                                        <li class="menu-item menu-item-type-post_type menu-item-object-page current-menu-ancestor current-menu-parent current_page_parent current_page_ancestor menu-item-has-children">
                                                            <a href="<?php echo home_url($wp->request) . '?locations=1&dep=' . $pid; ?>"><?php _e('Locations', 'chfw-lang') ?></a>
                                                            <ul class="sub-menu">
                                                                <?php
                                                                foreach ($CHfw_EventInfo->locations() as $provider) {
                                                                    echo '<li><a href="' . $provider['link'] . '">' . $provider['title'] . '</a></li>';
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