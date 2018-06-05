<?php
/*
 * Template Name:Find a Doctor
 * Description: Find a Doctor
* @package wow
 */
global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class, $wpdb;
global $wp;
$page_type_ = 'list';
$page_type_result = 'embed';

$scFW_globals['page_type_'] = $page_type_;
$scFW_globals['page_type_result'] = $page_type_result;
$page_setting_class->is_archive_page_ref = $scFW_globals['is_archive_page_ref'];
$page_setting_class->is_search_page_ref = $scFW_globals['is_search_page_ref'];
$image_overlay_type = $page_setting_class->image_overlay_type();
$page_setting_class->blog_list_view_layout = 'small-layout';
$page_setting_class->image_effect_type_for_post_page = 'overlay';
$view_options = $page_setting_class->view_options('full', 'page-bloglist_small ');
$page_setting_class->user_defined_page_type = $page_type_;
$pid = get_the_ID();
$header_setting = $page_setting_class->header_type_selected($pid, 'page-bloglist_small');
$post_border_class = $page_setting_class->PostBorderControl();
get_header($header_setting['header_type']);

$firstname = isset($_GET['firstname']) ? sanitize_text_field($_GET['firstname']) : false;
$departmans = isset($_GET['departmans']) ? sanitize_text_field($_GET['departmans']) : false;
$subDepartman = isset($_GET['subDepartman']) ? sanitize_text_field($_GET['subDepartman']) : false;
$location = isset($_GET['location']) ? sanitize_text_field($_GET['location']) : false;
$languages = array();

$gender = isset($_GET['gender']) ? $_GET['gender'] : false;
$mypostids = "";
$departman_Array = "";
$subDepartman_Array = "";
$gender_Array = "";
$location_Array = "";
$language_Array = "";
$finder_ = false;

$nonce = isset($_REQUEST['_wpnonce']) ? sanitize_text_field($_REQUEST['_wpnonce']) : false;
if (wp_verify_nonce($nonce, 'submit_find_doctor')) {
    if (isset($_GET['language']) && $_GET['language'] != "") {
        foreach ($_GET['language'] as $lng) {
            $languages[] = sanitize_text_field($lng);
        }
    }

    if ($firstname != false) {
        $finder_ = true;
        $mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title like '%$firstname%' ");
    }

    if ($departmans != false) {
        $finder_ = true;
        $departman_Array = array('key' => 'CHfw_DrAndDep_display_doctor_department', 'value' => $departmans, 'compare' => 'LIKE');//36
    }

    if ($subDepartman != false) {
        $finder_ = true;
        $subDepartman_Array = array('key' => 'CHfw_DrAndDep_program_and_services', 'value' => $subDepartman, 'compare' => 'LIKE');//pr and service 251
    }

    if ($gender != false) {
        $finder_ = true;
        $gender_Array = array('key' => 'CHfw-staffSetting_gender', 'value' => $gender, 'compare' => 'LIKE');//cinsiyet  female
    }

    if ($location != false) {
        $finder_ = true;
        $location_Array = array('key' => 'CHfw_DrAndDep_display_locations', 'value' => $location, 'compare' => 'LIKE'); //loca 420

    }

    if ($languages != false) {
        $finder_ = true;
        $language_Array = array(
            'taxonomy' => 'staff_languages',
            'field' => 'slug',
            'terms' => $languages,
            'include_children' => true,
        );
    }

    $Find_Doctor_args = array(
        'post_type' => 'staff',
        'post__in' => $mypostids,
        'meta_query' => array(
            $departman_Array,
            $subDepartman_Array,
            $gender_Array,
            $location_Array,
            'relation' => 'AND',
        ),
        'tax_query' => array(
            'relation' => 'OR',
            $language_Array
        )
    );
} else {

    $Find_Doctor_args = array(
        'post_type' => 'staff',
        'post__in' => $mypostids,
        'meta_query' => array(
            $departman_Array,
            $subDepartman_Array,
            $gender_Array,
            $location_Array,
            'relation' => 'AND',
        ),
        'tax_query' => array(
            'relation' => 'OR',
            $language_Array
        )
    );
}


$search_field = new CHfw_SearchProcess();
include("includes/hospital/hospitalFunc.php");


wp_register_style('chosen_CSS', get_template_directory_uri() . '/assets/css/third-party/chosen.min.css', '', '1.8.2', 'all');
wp_enqueue_style('chosen_CSS');

wp_register_script('jq_chosen', get_template_directory_uri() . '/assets/js/third-party/chosen.min.jquery.js', array('jquery'), '2.6', true);
wp_enqueue_script('jq_chosen');

wp_register_script('jq_chained', get_template_directory_uri() . '/assets/js/third-party/jquery.chained.min.js', array('jquery'), '2.6', true);
wp_enqueue_script('jq_chained');

wp_register_script('jq_autocomplete', get_template_directory_uri() . '/assets/js/third-party/jquery.autocomplete.js', array('jquery'), '2.6', true);
wp_enqueue_script('jq_autocomplete');


?>
    <main id="main-container" class="Find-Doctors-Page chfw-advanced-search">
        <!--breadcrumb-container start-->
        <div class="breadcrumb-container h150">
            <div class="container">
                <div class="row">
                    <nav class="breadCrumb">
                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                                        <span
                                              itemprop="name"><?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                                    <span  itemprop="name">  <?php echo __("Find a doctor", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo row">
                        <div id="breadcrumb-Info_archive" class="col-sm-7">
                            <div class="breadcrumb-Sum">
                                <h1 class="breadcrumb-InfoName"><i class="fa fa-user-md" aria-hidden="true"></i><?php _e('Find a doctor', 'chfw-lang') ?></h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb-container end-->
        <div class="container">
            <div class="row">
                <!--sidebar -->
                <div class="col-md-3">
                    <nav class="listdepartmans">
                        <div class="nav-breadcrumbs-level">
                            <h3> <?php _e('All Care Services', 'chfw-lang') ?></h3>

                            <div id="search-mobile">
                                <div role="search">
                                    <input type="text" id="myInput" onkeyup="JSquickSearch('myInput','myUL')"
                                           placeholder="Search for departmans.."
                                           class="input-search">
                                    <span class="button-search"><i class="fa fa-search"></i></span>

                                </div>
                            </div>
                            <ul id="myUL">
                                <?php echo CHfw_AllCareServiceList() ?>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!--sidebar end-->

                <div id="find-doctor" class="col-md-9 find-doctor">
                    <div class="page-bloglist-small" id="bodyheader">
                        <div class="ajax-page-content boxed-content clearfix contentbar">
                            <section class="index-pindexpageage bloglist-small-page blog">
                                <div class="chfw-advanced-search">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="chfw-advanced-searchBorder">

                                                <form action="<?php echo home_url(add_query_arg(array(),$wp->request));  ?>" method="get">
                                                    <label class="search-doctor-by">
                                                        <?php echo __("Search by disease, expertise, or doctor's last name", 'chfw-lang') ?>
                                                    </label>
                                                    <div class="input-group stylish-input-group">
                                                        <input type="text" id="advanced-search-input"
                                                               value="<?php echo $firstname ?>" name="firstname"
                                                               class="form-control"
                                                               placeholder="<?php echo __("Search", 'chfw-lang') ?>">
                                                        <span class="input-group-addon">
                                                    <button type="submit">
                                                       <i class="fa fa-search" aria-hidden="true"></i>
                                                    </button>
                                             </span>
                                                    </div>
                                                    <div class="collabse">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label> <?php echo __("Departmen", 'chfw-lang') ?></label>
                                                                <?php if (!empty($search_field->DepartmanRootList())) : ?>
                                                                    <select name="departmans" id="Departmans"
                                                                            class="sub-menu">
                                                                        <?php
                                                                        foreach ($search_field->DepartmanRootList() as $DepartmanRootList) {
                                                                            if (isset($_GET['departmans']) && sanitize_text_field($_GET['departmans']) == $DepartmanRootList->term_id) {
                                                                                echo '<option  selected="selected" value="' . $DepartmanRootList->term_id . '">' . $DepartmanRootList->name . '</option>';

                                                                            } else {
                                                                                echo '<option  value="' . $DepartmanRootList->term_id . '">' . $DepartmanRootList->name . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                <?php endif ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo __("Program and services", 'chfw-lang') ?></label>
                                                                <?php
                                                                if (!empty($search_field->DepartmanAndRelationCategoriesListAll())) : ?>
                                                                    <select id="subDepartmans" name="subDepartman"
                                                                            class="sub-menu">
                                                                        <?php
                                                                        foreach ($search_field->DepartmanAndRelationCategoriesListAll() as $depRelCat) {
                                                                            if (isset($_GET['subDepartman']) && sanitize_text_field($_GET['subDepartman']) == $depRelCat['id']) {
                                                                                echo '<option selected="selected" class="' . $depRelCat['catID'] . '" value="' . $depRelCat['id'] . '">' . $depRelCat['title'] . '</option>';
                                                                            } else {
                                                                                echo '<option class="' . $depRelCat['catID'] . '" value="' . $depRelCat['id'] . '">' . $depRelCat['title'] . '</option>';

                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                <?php endif ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo __("Languge", 'chfw-lang') ?></label>
                                                                <?php
                                                                if (!empty($search_field->langugeList())) : ?>
                                                                    <select data-placeholder="<?php echo __("Choose a languges...", 'chfw-lang') ?>"
                                                                            id="Languges"
                                                                            name="language[]" multiple
                                                                            class="chosen-select sub-menu">
                                                                        <?php

                                                                        foreach ($search_field->langugeList() as $lang) {
                                                                            if (in_array($lang->slug, $languages)) {
                                                                                $ch_yes = 'selected="selected"';
                                                                                echo '<option ' . $ch_yes . '  value="' . $lang->slug . '">' . $lang->name . '</option>';
                                                                            } else {
                                                                                echo '<option  value="' . $lang->slug . '">' . $lang->name . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                <?php endif ?>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label><?php echo __("Location", 'chfw-lang') ?></label>
                                                                <?php if (!empty($search_field->CHfw_hospitalList())) : ?>
                                                                    <select id="locations" name="location"
                                                                            class="sub-menu">
                                                                        <?php
                                                                        foreach ($search_field->CHfw_hospitalList() as $DepartmanRootList) {
                                                                            if (isset($_GET['location']) && sanitize_text_field($_GET['location']) == $DepartmanRootList['id']) {
                                                                                echo '<option  selected="selected" value="' . $DepartmanRootList['id'] . '">' . $DepartmanRootList['title'] . '</option>';
                                                                            } else {
                                                                                echo '<option  value="' . $DepartmanRootList['id'] . '">' . $DepartmanRootList['title'] . '</option>';
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                <?php endif ?>
                                                            </div>
                                                            <div class="form-group">
                                                                <label><?php echo __("Gender", 'chfw-lang') ?></label>
                                                                <select id="gender" name="gender" class="sub-menu">
                                                                    <option value=""><?php echo __("All", 'chfw-lang') ?></option>
                                                                    <?php if (isset($_GET['gender']) && sanitize_text_field($_GET['gender']) == "male") : ?>
                                                                        <option selected="selected" value="male">
                                                                            <?php echo __("Male", 'chfw-lang') ?>
                                                                        </option>
                                                                    <?php else: ?>
                                                                        <option value="male">
                                                                            <?php echo __("Male", 'chfw-lang') ?>
                                                                        </option>
                                                                    <?php endif; ?>
                                                                    <?php if (isset($_GET['gender']) && sanitize_text_field($_GET['gender']) == "female") : ?>
                                                                        <option selected="selected" value="female">
                                                                            <?php echo __("Female", 'chfw-lang') ?>
                                                                        </option>
                                                                    <?php else: ?>
                                                                        <option value="female">
                                                                            <?php echo __("Female", 'chfw-lang') ?>
                                                                        </option>
                                                                    <?php endif; ?>
                                                                </select>
                                                            </div>
                                                            <hr>
                                                            <div class="form-group">
                                                                <?php wp_nonce_field('submit_find_doctor'); ?>
                                                                <button type="submit" class="advandedButton"><i
                                                                            class="fa fa-search"
                                                                            aria-hidden="true"></i><span> <?php echo __("Search", 'chfw-lang') ?></span>
                                                                </button>
                                                            </div>

                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="findDoctorListable">
                                    <div class="d-Inner">
                                        <?php if ($finder_): ?>
                                            <h2 class="infoH2"><?php echo __("Find A Doctors", 'chfw-lang') ?></h2>
                                        <?php else : ?>
                                            <h2 class="infoH2"><?php echo __("All Doctors", 'chfw-lang') ?></h2>
                                        <?php endif; ?>
                                        <?php
                                        $wp_query = new WP_Query($Find_Doctor_args);
                                        $wp_query->request;
                                        if ($wp_query->have_posts()) {
                                            while ($wp_query->have_posts()) {
                                                $wp_query->the_post();
                                                $format_typeCH = get_post_format();
                                                unset($previousday);
                                                include("includes/hospital/staff-pages/mini_list.php");
                                            }
                                            wp_reset_postdata();
                                        } else {
                                            get_template_part('content', 'none');
                                        }
                                        ?>
                                    </div>
                                </div> <!-- findDoctorListable end-->
                            </section>
                        </div>
                        <?php get_template_part("includes/post-pages/blog_pagination"); ?>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <script>
        jQuery(function () {

            jQuery("#subDepartmans").chained("#Departmans");
            jQuery('#Departmans,#subDepartmans').chosen({width: '410px'});
            jQuery('#locations').chosen({width: '410px'});
            jQuery('#Languges').chosen({width: '410px'});
            jQuery('#gender').chosen({width: '410px'});

            jQuery('#Departmans,#subDepartmans').on('change', function () {
                jQuery('#Departmans,#subDepartmans').trigger('chosen:updated');
            });


            jQuery('#advanced-search-input').autocomplete({
                serviceUrl: '/wp-admin/admin-ajax.php?action=CHfw_StaffFindAjax',
                onSelect: function (suggestion) {
                    window.location.href = suggestion.data;
                },

            });
        });
    </script>
    <!-- main end  -->
<?php

$footer_setting = $page_setting_class->footer_type_selected($pid);
get_footer($footer_setting['footer_type']);
