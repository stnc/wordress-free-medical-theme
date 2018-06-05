<?php
/**
 * eq departmans/airway-lungs/ page uses
 * Created by wow team
 * Date: 14.11.2017
 * Time: 19:19
 */
?>
<div id="single-page" class="doctor-profil-detail  col-lg-5 col-md-5  col-xs-12  ">
    <div class="article entry-content the-content">
		<?php
		do_action('mptt-single-mp-event-before-wrapper');
		do_action('mptt_before_main_wrapper');
		while (have_posts()) : the_post();
			?>
            <div <?php post_class(apply_filters('mptt_main_wrapper_class', 'mptt-main-wrapper')) ?>>
                <div
                        class="<?php echo apply_filters('mptt_event_template_content_class', 'mptt-container') ?>">

                    <hr>

					<?php mptt_event_template_content_post_content() ?>
                </div>
                <div class="mptt-clearfix"></div>
            </div>
			<?php
		endwhile;
		do_action('mptt_after_main_wrapper');
		do_action('mptt-single-mp-event-after-wrapper');
		?>
    </div>
</div>
<div class="doctor-profil-sidebar col-lg-4 col-md-4  col-xs-12">
    <div class="<?php echo apply_filters('mptt_sidebar_class', 'mptt-sidebar') ?>">
        <h1 class="mptt-sideTitle"
            style="margin-bottom: 0"> <?php esc_html_e('Make an appointment', 'chfw-lang'); ?></h1>
		<?php

		if (!empty($CHfw_EventInfo->staffs())) {
			foreach ($CHfw_EventInfo->staffs() as $staff) {
				$booked_calendarID = get_post_meta($staff['id'], 'CHfw_DrAndDep_display_doctor_calendar', true);
				$booked_calendarID_explode = explode(',', $booked_calendarID);

				foreach ($booked_calendarID_explode as $booked_calendarID) {
					echo '<h4 style="text-align: center">' . $staff['title'] . '</h4>';
					echo do_shortcode('[booked-calendar calendar="' . $booked_calendarID . '"]');
				}
			}
		}
		?>
        <h1 class="mptt-sideTitle"><?php esc_html_e('Events', 'chfw-lang'); ?></h1>
		<?php mptt_event_template_content_time_title() ?>
		<?php mptt_event_template_content_time_list() ?>

        <h1 class="mptt-sideTitle"><?php esc_html_e('Prices', 'chfw-lang'); ?></h1>
        <ul class="price">
            <li><?php esc_html_e('Primary care', 'chfw-lang'); ?><span class="pull-right">$30</span></li>
            <li><?php esc_html_e('Dental care', 'chfw-lang'); ?><span class="pull-right">$50</span></li>
            <li><?php esc_html_e('Surgery and pyhsicians', 'chfw-lang'); ?><span
                        class="pull-right">$60</span></li>
            <li><?php esc_html_e('Pediatrics', 'chfw-lang'); ?><span class="pull-right">$60</span></li>
            <li><?php esc_html_e('Physiotherapy', 'chfw-lang'); ?><span class="pull-right">$70</span></li>
            <li><?php esc_html_e('Ophthalmology Clinic', 'chfw-lang'); ?><span
                        class="pull-right">$20</span></li>
            <li><?php esc_html_e('Cardiac Clinicy', 'chfw-lang'); ?><span
                        class="pull-right">$35</span></li>
        </ul>
    </div>
</div>