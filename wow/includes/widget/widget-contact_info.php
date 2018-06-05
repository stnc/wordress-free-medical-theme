<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * Widget Contact
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_Contact_Info extends WP_Widget
{
    /* ---------------------------------------------------------------------------
     * INIT
     * --------------------------------------------------------------------------- */
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'CHfwContactInfo',
            'description' => esc_html__("CH Contact Info  Widget", 'chfw-lang')
        );
        parent::__construct('CHfwContactInfo', esc_html__('CH Contact Info Widget', 'chfw-lang'), $widget_ops);
    }

    /* ---------------------------------------------------------------------------
 * Deals with the settings when they are saved by the admin.
 * --------------------------------------------------------------------------- */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title'] = strip_tags($new_instance['title']);
        $instance['contact_desc'] = strip_tags($new_instance['contact_desc']);
        $instance['contact_adress'] = strip_tags($new_instance['contact_adress']);
        $instance['contact_phone'] = strip_tags($new_instance['contact_phone']);
        $instance['contact_email'] = strip_tags($new_instance['contact_email']);
        $instance['contact_text_color'] = strip_tags($new_instance['contact_text_color']);
        $instance['contact_iconBG_color'] = strip_tags($new_instance['contact_iconBG_color']);
        $instance['contact_icon_color'] = strip_tags($new_instance['contact_icon_color']);

        return $instance;
    }


    /* ---------------------------------------------------------------------------
     * Outputs the HTML for this widget.
     * --------------------------------------------------------------------------- */
    function widget($args, $instance)
    {
        extract($args);
        $title = isset($instance['title']) ? $instance['title'] : '';
        $contact_text_color = '';
        $contact_iconBG_color = '';
        $contact_icon_color = '';
        if (isset($instance['contact_text_color']) && !empty($instance['contact_text_color'])) {
            $contact_text_color = 'color:' . $instance['contact_text_color'] . '!important;';
        }
        if (isset($instance['contact_iconBG_color']) && !empty($instance['contact_iconBG_color'])) {
            $contact_iconBG_color = 'background:' . $instance['contact_iconBG_color'] . ';';
        }

        if (isset ($instance['contact_icon_color']) && !empty ($instance['contact_icon_color'])) {
            $contact_icon_color = 'color:' . $instance['contact_icon_color'] . ';';
        }
        $cwidgetid = $this->id;
        $contact_desc = isset($instance['contact_desc']) ? $instance['contact_desc'] : '';
        $contact_adress = isset($instance['contact_adress']) ? $instance['contact_adress'] : '';
        $contact_phone = isset($instance['contact_phone']) ? $instance['contact_phone'] : '';
        $contact_email = isset($instance['contact_email']) ? $instance['contact_email'] : '';


        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        /**
         * Widget Content
         */

        ?>

        <div class="widget-contact-info">
            <div class="toggle-footer">
                <div style="<?php echo $contact_text_color ?>" class="contact-desc">
                    <?php
                    if ($contact_desc != null) { ?>
                        <span style="<?php echo $contact_text_color ?>"><?php echo $contact_desc ?></span>
                    <?php } ?>
                    <ul>
                        <?php if ($contact_adress != null) { ?>
                            <li>
                                <i style="<?php echo $contact_iconBG_color . $contact_icon_color ?>" class="fa fa-map-marker"></i>
                                <div style="<?php echo $contact_text_color ?>" class="info"><?php echo $instance['contact_adress'] ?></div>
                            </li>
                        <?php } ?>
                        <?php if ($contact_phone != null) { ?>
                            <li>
                                <i style="<?php echo $contact_iconBG_color . $contact_icon_color ?>" class="fa fa-phone"></i>
                                <div style="<?php echo $contact_text_color ?>" class="info"><?php echo $instance['contact_phone'] ?></div>
                            </li>
                        <?php } ?>
                        <?php if ($contact_email != null) { ?>
                            <li>
                                <i style="<?php echo $contact_iconBG_color . $contact_icon_color ?>" class="fa fa-envelope-o"></i>
                                <div style="<?php echo $contact_text_color ?>" class="info">
                                    <a style="<?php echo $contact_text_color ?>" href="mailto:<?php echo $instance['contact_email'] ?>"><?php echo $contact_email ?></a>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
        <?php

        echo $after_widget;
    }

    /* ---------------------------------------------------------------------------
     * Deals with the settings when they are saved by the admin.
     * --------------------------------------------------------------------------- */
    public function form($instance)
    {


        $title = isset($instance['title']) ? ($instance['title']) : esc_html__('Contact', 'chfw-lang');
        $contact_desc = isset($instance['contact_desc']) ? ($instance['contact_desc']) : '';
        $contact_adress = isset($instance['contact_adress']) ? ($instance['contact_adress']) : '';
        $contact_phone = isset($instance['contact_phone']) ? ($instance['contact_phone']) : '';
        $contact_email = isset($instance['contact_email']) ? ($instance['contact_email']) : '';
        $contact_text_color = isset($instance['contact_text_color']) ? ($instance['contact_text_color']) : '';
        $contact_iconBG_color = isset($instance['contact_iconBG_color']) ? ($instance['contact_iconBG_color']) : '';
        $contact_icon_color = isset($instance['contact_icon_color']) ? ($instance['contact_icon_color']) : '';

        ?>
        <div class="tabbingContact_<?php echo $this->id ?>">
            <ul class="tabs_st_studio-engine">
                <li class="tab-link current" data-tab="tab1"><?php esc_html_e('Info', 'chfw-lang') ?></li>
                <li class="tab-link" data-tab="tab2"><?php esc_html_e('Style', 'chfw-lang') ?></li>
            </ul>
            <div id="upload-image_<?php echo $this->id; ?>">
                <div class="tabcontainer">
                    <div class="tab-content tab1 current">
                        <p>
                            <b><label s for="<?php echo esc_attr($this->get_field_id('title')); ?>">
                                    <?php _e('Title ', 'chfw-lang') ?></label></b> <input type="text"
                                                                                          class="input-text"
                                                                                          value="<?php echo esc_attr($title); ?>"
                                                                                          name="<?php echo esc_attr($this->get_field_name('title')); ?>"
                                                                                          id="<?php echo esc_attr($this->get_field_id('title')); ?>"/>
                        </p>

                        <p>
                            <b><label for="<?php echo esc_attr($this->get_field_id('contact_desc')); ?>">
                                    <?php _e('Description ', 'chfw-lang') ?></label></b>
                            <textarea name="<?php echo esc_attr($this->get_field_name('contact_desc')); ?>"
                                      id="<?php echo esc_attr($this->get_field_id('contact_desc')); ?>"
                                      style="float: left; clear: both; height: 100px; width: 100%; padding: 3px;"><?php echo esc_attr($contact_desc); ?></textarea>
                        </p>

                        <p>
                            <b><label for="<?php echo esc_attr($this->get_field_id('contact_adress')); ?>">
                                    <?php _e('Adress ', 'chfw-lang') ?></label></b>
                            <input type="text" class="input-text" value="<?php echo esc_attr($contact_adress); ?>"
                                   name="<?php echo esc_attr($this->get_field_name('contact_adress')); ?>"
                                   id="<?php echo esc_attr($this->get_field_id('contact_adress')); ?>"/>
                        </p>

                        <p>
                            <b><label for="<?php echo esc_attr($this->get_field_id('contact_phone')); ?>">
                                    <?php _e('Phone ', 'chfw-lang') ?></label></b>
                            <input type="text" class="input-text" value="<?php echo esc_attr($contact_phone); ?>"
                                   name="<?php echo esc_attr($this->get_field_name('contact_phone')); ?>"
                                   id="<?php esc_attr($this->get_field_id('contact_phone')); ?>"/>
                        </p>

                        <p>
                            <b><label for="<?php echo esc_attr($this->get_field_id('contact_email')); ?>">
                                    <?php _e('Email ', 'chfw-lang') ?></label></b>
                            <input type="text" class="input-text" value="<?php echo esc_attr($contact_email); ?>"
                                   name="<?php echo esc_attr($this->get_field_name('contact_email')); ?>" id="<?php echo esc_attr($this->get_field_id('contact_email')); ?>"/>
                        </p>

                        <p><br></p>


                    </div>
                    <div class="tab-content tab2">
                        <p>
                            <b><label s for="<?php echo esc_attr($this->get_field_id('contact_text_color')); ?>">
                                    <?php _e('Text Color', 'chfw-lang') ?></label></b><br>
                            <input data-default-color="#000" type="text" class="input-text ch-color-picker"
                                   value="<?php echo esc_attr($contact_text_color); ?>"
                                   name="<?php echo esc_attr($this->get_field_name('contact_text_color')); ?>"
                                   id="<?php esc_attr($this->get_field_id('contact_text_color')); ?>"/>
                        </p>

                        <p>
                            <b><label s for="<?php echo esc_attr($this->get_field_id('contact_iconBG_color')); ?>">
                                    <?php _e('Icon Background Color', 'chfw-lang') ?></label></b><br>
                            <input data-default-color="#A9A49E" type="text" class="input-text ch-color-picker"
                                   value="<?php echo esc_attr($contact_iconBG_color); ?>"
                                   name="<?php echo esc_attr($this->get_field_name('contact_iconBG_color')); ?>"
                                   id="<?php esc_attr($this->get_field_id('contact_iconBG_color')); ?>"/>
                        </p>

                        <p>
                            <b><label s for="<?php echo $this->get_field_id('contact_icon_color'); ?>">
                                    <?php _e('Icon  Color', 'chfw-lang') ?></label></b><br>
                            <input data-default-color="#000" type="text" class="input-text ch-color-picker"
                                   value="<?php echo esc_attr($contact_icon_color); ?>"
                                   name="<?php echo esc_attr($this->get_field_name('contact_icon_color')); ?>"
                                   id="<?php esc_attr($this->get_field_id('contact_icon_color')); ?>"/>
                        </p>


                    </div>
                </div>
            </div>
        </div>

        <script>
            jQuery('.tabbingContact_<?php echo $this->id?> ul.tabs_st_studio-engine li').live("click", function () {
                var tab_id = jQuery(this).attr('data-tab');
                jQuery('.tabbingContact_<?php echo $this->id?> ul.tabs_st_studio-engine li').removeClass('current');
                jQuery('.tabbingContact_<?php echo $this->id?> .tabcontainer .tab-content').removeClass('current');
                jQuery(this).addClass('current');
                jQuery(".tabbingContact_<?php echo $this->id?> ." + tab_id).addClass('current');
            });
        </script>
        <?php
    }
}
