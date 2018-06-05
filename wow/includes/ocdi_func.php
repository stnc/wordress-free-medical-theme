<?php

/* --------------------------------------------------------------
 one click import -- import content files
-------------------------------------------------------------- */
function CHfw_ocdi_import_files()
{
    global $CHfw_themeReduxOptionName;

    return array(
        array(
            'import_file_name' => 'Demo Import 1',
            'categories' => array('Category 1'),
            'local_import_file' => trailingslashit(get_template_directory()) . 'includes/ocdi/dummy.xml',
            'local_import_widget_file' => trailingslashit(get_template_directory()) . 'includes/ocdi/widgets.json',
            'local_import_redux' => array(
                array(
                    'file_path' => trailingslashit(get_template_directory()) . 'includes/ocdi/redux.json',
                    'option_name' => $CHfw_themeReduxOptionName,
                ),
            ),
            //'import_preview_image_url' => 'http://www.your_domain.com/ocdi/preview_import_image.jpg',
            'import_notice' => esc_html__('After you import this demo, you will have to setup the slider separately.', 'chfw-lang'),
        ),


    );
}

add_filter('pt-ocdi/import_files', 'CHfw_ocdi_import_files');


/* --------------------------------------------------------------
 one click import setup after setting
-------------------------------------------------------------- */
function CHfw_ocdi_after_import_setup()
{
    // Assign menus to their locations.
    global $wpdb;
    $main_menu = get_term_by('name', 'Footer bottom costum menu', 'nav_menu');
    set_theme_mod('nav_menu_locations', array(
            'Footer-bottom-costum-menu' => $main_menu->term_id,
        )
    );

    $main_menu = get_term_by('name', 'Mobil Menu', 'nav_menu');
    set_theme_mod('nav_menu_locations', array(
            'mobil-menu' => $main_menu->term_id,
        )
    );

    $main_menu = get_term_by('name', 'Main Menu', 'nav_menu');
    set_theme_mod('nav_menu_locations', array(
            'main-menu' => $main_menu->term_id,
        )
    );


    $front_page_id = get_page_by_title('Homepage');
    $blog_page_id = get_page_by_title('Blog List');
    update_option('show_on_front', 'page');
    update_option('page_on_front', $front_page_id->ID);
    update_option('page_for_posts', $blog_page_id->ID);

    //Import Revolution Slider
    if (class_exists('RevSlider')) {
        $slider_array = array(
            trailingslashit(get_template_directory()) . "includes/ocdi/RevolutionSlider/dark-dr.zip",
            trailingslashit(get_template_directory()) . "includes/ocdi/RevolutionSlider/doctor.zip",
            trailingslashit(get_template_directory()) . "includes/ocdi/RevolutionSlider/hospitalcopy.zip",
            trailingslashit(get_template_directory()) . "includes/ocdi/RevolutionSlider/hp11.zip",
        );
        $slider = new RevSlider();
        foreach ($slider_array as $filepath) {
            $slider->importSliderFromPost(true, true, $filepath);
        }
        echo ' Slider processed';
    }

    //departman
    update_post_meta(262, 'CHfw_DrAndDep_display_doctor_department', "33");
    update_post_meta(263, 'CHfw_DrAndDep_display_doctor_department', "30");
    update_post_meta(264, 'CHfw_DrAndDep_display_doctor_department', "35");
    update_post_meta(265, 'CHfw_DrAndDep_display_doctor_department', "37");
    update_post_meta(266, 'CHfw_DrAndDep_display_doctor_department', "35");
    update_post_meta(267, 'CHfw_DrAndDep_display_doctor_department', "28");
    update_post_meta(268, 'CHfw_DrAndDep_display_doctor_department', "33");
    update_post_meta(269, 'CHfw_DrAndDep_display_doctor_department', "28");

    //services
    update_post_meta(262, 'CHfw_DrAndDep_program_and_services', 934);
    update_post_meta(263, 'CHfw_DrAndDep_program_and_services', 249);
    update_post_meta(264, 'CHfw_DrAndDep_program_and_services', 818);
    update_post_meta(265, 'CHfw_DrAndDep_program_and_services', 255);
    update_post_meta(266, 'CHfw_DrAndDep_program_and_services', 818);
    update_post_meta(267, 'CHfw_DrAndDep_program_and_services', "251,250");
    update_post_meta(268, 'CHfw_DrAndDep_program_and_services', 934);
    update_post_meta(269, 'CHfw_DrAndDep_program_and_services', "251,250");

    //calendar
    update_post_meta(262, 'CHfw_DrAndDep_display_doctor_calendar', 40);
    update_post_meta(263, 'CHfw_DrAndDep_display_doctor_calendar', 39);
    update_post_meta(264, 'CHfw_DrAndDep_display_doctor_calendar', 42);
    update_post_meta(265, 'CHfw_DrAndDep_display_doctor_calendar', 43);
    update_post_meta(266, 'CHfw_DrAndDep_display_doctor_calendar', 47);
    update_post_meta(267, 'CHfw_DrAndDep_display_doctor_calendar', 32);
    update_post_meta(268, 'CHfw_DrAndDep_display_doctor_calendar', 48);
    update_post_meta(269, 'CHfw_DrAndDep_display_doctor_calendar', 49);

    //locations
    update_post_meta(262, 'CHfw_DrAndDep_display_locations', "420,436,796,803,936");
    update_post_meta(263, 'CHfw_DrAndDep_display_locations', "436,803,936");
    update_post_meta(264, 'CHfw_DrAndDep_display_locations', "436,796,936");
    update_post_meta(265, 'CHfw_DrAndDep_display_locations', "420,796,936");
    update_post_meta(266, 'CHfw_DrAndDep_display_locations', "420,796,803,936");
    update_post_meta(267, 'CHfw_DrAndDep_display_locations', "420,436,796,803,936");
    update_post_meta(268, 'CHfw_DrAndDep_display_locations', "796,936");
    update_post_meta(269, 'CHfw_DrAndDep_display_locations', "420,436,796,803,936");

    $table = $wpdb->prefix . 'term_taxonomy';
    $wpdb->query( $wpdb->prepare( "UPDATE {$table}  SET count =1  WHERE taxonomy = '%s'  ", 'mp-event_category'  ) );

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 1,
        'column_id' => 257,
        'event_id' => 250,
        'event_start' => '09:00:00',
        'event_end' => '05:00:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 2,
        'column_id' => 257,
        'event_id' => 249,
        'event_start' => '09:00:00',
        'event_end' => '05:00:00',
        'user_id' => '-1',
        'description' => '',
    ));


    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 3,
        'column_id' => 260,
        'event_id' => 249,
        'event_start' => '11:00:00',
        'event_end' => '12:00:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 4,
        'column_id' => 256,
        'event_id' => 251,
        'event_start' => '09:00:00',
        'event_end' => '11:00:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 5,
        'column_id' => 259,
        'event_id' => 251,
        'event_start' => '09:00:00',
        'event_end' => '04:50:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 6,
        'column_id' => 251,
        'event_id' => 251,
        'event_start' => '05:00:00',
        'event_end' => '06:30:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 7,
        'column_id' => 258,
        'event_id' => 252,
        'event_start' => '08:00:00',
        'event_end' => '05:30:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 8,
        'column_id' => 259,
        'event_id' => 252,
        'event_start' => '11:00:00',
        'event_end' => '04:00:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 9,
        'column_id' => 256,
        'event_id' => 252,
        'event_start' => '11:00:00',
        'event_end' => '05:00:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 10,
        'column_id' => 257,
        'event_id' => 252,
        'event_start' => '04:00:00',
        'event_end' => '05:30:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 11,
        'column_id' => 258,
        'event_id' => 253,
        'event_start' => '08:00:00',
        'event_end' => '03:30:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 12,
        'column_id' => 260,
        'event_id' => 253,
        'event_start' => '08:00:00',
        'event_end' => '03:30:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 13,
        'column_id' => 261,
        'event_id' => 253,
        'event_start' => '09:00:00',
        'event_end' => '05:30:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 14,
        'column_id' => 259,
        'event_id' => 253,
        'event_start' => '04:00:00',
        'event_end' => '05:30:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 15,
        'column_id' => 258,
        'event_id' => 254,
        'event_start' => '10:00:00',
        'event_end' => '12:00:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 16,
        'column_id' => 259,
        'event_id' => 254,
        'event_start' => '10:00:00',
        'event_end' => '03:30:00',
        'user_id' => '-1',
        'description' => '',
    ));


    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 17,
        'column_id' => 258,
        'event_id' => 255,
        'event_start' => '11:00:00',
        'event_end' => '01:00:00',
        'user_id' => '-1',
        'description' => '',
    ));

    $wpdb->insert($wpdb->prefix . 'mp_timetable_data', array(
        'id' => 18,
        'column_id' => 257,
        'event_id' => 255,
        'event_start' => '03:00:00',
        'event_end' => '06:25:00',
        'user_id' => '-1',
        'description' => '',
    ));
}

add_action('pt-ocdi/after_import', 'CHfw_ocdi_after_import_setup');


