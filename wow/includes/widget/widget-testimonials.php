<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * Widget Testimonials
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_Testimonials extends WP_Widget
{

    /* ---------------------------------------------------------------------------
     * INIT
     * --------------------------------------------------------------------------- */
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'CHfw_Testimonials',
            'description' => esc_html__("CH Testimonials", 'chfw-lang')
        );
        parent::__construct('CHfw_Testimonials', esc_html__('CH Testimonials', 'chfw-lang'), $widget_ops);
    }


    /* ---------------------------------------------------------------------------
    * Deals with the settings when they are saved by the admin.
    * --------------------------------------------------------------------------- */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['testimonial_title'] = strip_tags($new_instance['testimonial_title']);
        $instance['testimonial_color'] = strip_tags($new_instance['testimonial_color']);
        $instance['testimonial_bgcolor'] = strip_tags($new_instance['testimonial_bgcolor']);
        $instance['testimonial_arrow_hover_color'] = strip_tags($new_instance['testimonial_arrow_hover_color']);
        $instance['testimonial_arrow_hover_bgcolor'] = strip_tags($new_instance['testimonial_arrow_hover_bgcolor']);
        $instance['testimonial_link_color'] = strip_tags($new_instance['testimonial_link_color']);
        $instance['testimonial_desc'] = strip_tags($new_instance['testimonial_desc']);
        return $instance;
    }

    /* ---------------------------------------------------------------------------
     * Outputs the HTML for this widget.
     * --------------------------------------------------------------------------- */
    function widget($args, $instance)
    {
        //	print_r($instance);
        extract($args);
        $title = isset ($instance['testimonial_title']) ? $instance['testimonial_title'] : '';

        $testimonial_color = '';
        $testimonial_bgcolor = '';
        $testimonial_arrow_hover_color = '';
        $testimonial_link_color = '';
        $testimonial_arrow_hover_bgcolor = '';
        if (isset ($instance['testimonial_color']) && !empty ($instance['testimonial_color'])) {
            $testimonial_color = 'color:' . $instance['testimonial_color'];
        }
        if (isset($instance['testimonial_bgcolor']) && !empty ($instance['testimonial_bgcolor'])) {
            $testimonial_bgcolor = 'background:' . $instance['testimonial_bgcolor'];
        }

        if (isset ($instance['testimonial_arrow_hover_color']) && !empty ($instance['testimonial_arrow_hover_color'])) {
            $testimonial_arrow_hover_color = 'color:' . $instance['testimonial_arrow_hover_color'] . ';';
        }

        if (isset($instance['testimonial_arrow_hover_bgcolor']) && !empty($instance['testimonial_arrow_hover_bgcolor'])) {
            $testimonial_arrow_hover_bgcolor = 'background:' . $instance['testimonial_arrow_hover_bgcolor'] . ';';
        }

        if (isset ($instance['testimonial_link_color']) && !empty ($instance['testimonial_link_color'])) {
            $testimonial_link_color = 'color:' . $instance['testimonial_link_color'] . ';';
        }


        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        /**
         * Widget
         *
         */
        $id = $this->id . '_widget';
        ?>

        <div id="<?php echo $id ?>" class="widget-testimonial">
            <div class="toggle-footer" style="">
                <div class="testimonial-desc">
                    <?php if (isset($instance['testimonial_desc']) && $instance['testimonial_desc'] != null) { ?>
                        <?php echo do_shortcode($instance['testimonial_desc']) ?>
                    <?php } ?>
                </div>
            </div>
        </div>

        <?php
        add_action('wp_footer', function () use ($id, $testimonial_link_color, $testimonial_color, $testimonial_arrow_hover_color, $testimonial_arrow_hover_bgcolor, $testimonial_bgcolor) {
            ?>
            <style type="text/css" scoped>
                <?php echo '#'.$id ?>.widget-testimonial .wow-testimonials .ch-user-info .testimonial-website a {
                <?php echo $testimonial_link_color ?>;
                }

                <?php echo '#'.$id ?>.widget-testimonial .testimonials-slider-container .testimonials-slider .wow-testimonials p,
                <?php echo '#'.$id ?>.widget-testimonial .testimonials-slider-container .testimonials-slider .ch-user-info li {
                <?php echo $testimonial_color ?>;
                }

                <?php echo '#'.$id ?>.widget-testimonial .testimonials-slider-container .testimonials-slider .wow-testimonials p,
                <?php echo '#'.$id ?>.widget-testimonial .testimonials-slider-container .testimonials-slider .ch-user-info li {
                <?php echo $testimonial_color ?>;
                }

                <?php echo '#'.$id ?>.widget-testimonial .testimonials-slider-container .testimonials-slider > .slick-next,
                <?php echo '#'.$id ?>.widget-testimonial .testimonials-slider-container .testimonials-slider > .slick-prev {
                <?php echo   $testimonial_arrow_hover_color.' '. $testimonial_arrow_hover_bgcolor?>;
                }

                <?php echo '#'.$id ?>.widget-testimonial .testimonials-slider-container .testimonials-slider {
                <?php echo $testimonial_bgcolor?>;
                }
            </style>
            <?php
        }, 20);

        echo $after_widget;
    }

    /* ---------------------------------------------------------------------------
     * Deals with the settings when they are saved by the admin.
     * --------------------------------------------------------------------------- */
    public function form($instance)
    {

        $testimonial_title = isset($instance['testimonial_title']) ? $instance['testimonial_title'] : esc_html__('Testimonial', 'chfw-lang');

        $testimonial_desc = isset($instance['testimonial_desc']) ? $instance['testimonial_desc'] : '';
        $testimonial_color = isset($instance['testimonial_color']) ? $instance['testimonial_color'] : '';
        $testimonial_bgcolor = isset($instance['testimonial_bgcolor']) ? $instance['testimonial_bgcolor'] : '';

        $testimonial_arrow_hover_bgcolor = isset($instance['testimonial_arrow_hover_bgcolor']) ? $instance['testimonial_arrow_hover_bgcolor'] : '';
        $testimonial_arrow_hover_color = isset($instance['testimonial_arrow_hover_color']) ? $instance['testimonial_arrow_hover_color'] : '';
        $testimonial_link_color = isset($instance['testimonial_link_color']) ? $instance['testimonial_link_color'] : '';

        ?>
        <div id="testminad<?php echo $this->id; ?>">
            <p>
                <b><label s for="<?php echo esc_attr($this->get_field_id('testimonial_title')); ?>">
                        <?php _e('Title', 'chfw-lang') ?></label></b><br>

                <input type="text" class="input-text"
                       value="<?php echo esc_attr($testimonial_title); ?>"
                       name="<?php echo esc_attr($this->get_field_name('testimonial_title')); ?>"
                       id="<?php echo esc_attr($this->get_field_id('testimonial_title')); ?>"/>
            </p>

            <p>
                <b><label s for="<?php echo esc_attr($this->get_field_id('testimonial_color')); ?>">
                        <?php _e('Color', 'chfw-lang') ?></label></b><br>
                <input data-default-color="#000000" type="text" class="input-text ch-color-picker"
                       value="<?php echo esc_attr($testimonial_color); ?>"
                       name="<?php echo esc_attr($this->get_field_name('testimonial_color')); ?>"
                       id="<?php echo esc_attr($this->get_field_id('testimonial_color')); ?>"/>
            </p>


            <p>
                <b><label s for="<?php echo esc_attr($this->get_field_id('testimonial_bgcolor')); ?>">
                        <?php _e('Background Color', 'chfw-lang') ?></label></b><br>
                <input data-default-color="#fff" type="text" class="input-text ch-color-picker"
                       value="<?php echo esc_attr($testimonial_bgcolor); ?>"
                       name="<?php echo esc_attr($this->get_field_name('testimonial_bgcolor')); ?>"
                       id="<?php echo esc_attr($this->get_field_id('testimonial_bgcolor')); ?>"/>
            </p>


            <p>
                <b><label s for="<?php echo esc_attr($this->get_field_id('testimonial_arrow_hover_bgcolor')); ?>">
                        <?php _e('Arrow Background Color', 'chfw-lang') ?></label></b><br>
                <input data-default-color="#000" type="text" class="input-text ch-color-picker"
                       value="<?php echo esc_attr($testimonial_arrow_hover_bgcolor); ?>"
                       name="<?php echo esc_attr($this->get_field_name('testimonial_arrow_hover_bgcolor')); ?>"
                       id="<?php echo esc_attr($this->get_field_id('testimonial_arrow_hover_bgcolor')); ?>"/>
            </p>

            <p>
                <b><label s for="<?php echo $this->get_field_id('testimonial_arrow_hover_color'); ?>">
                        <?php _e('Arrow Color', 'chfw-lang') ?></label></b><br>
                <input data-default-color="#fff" type="text" class="input-text ch-color-picker"
                       value="<?php echo esc_attr($testimonial_arrow_hover_color); ?>"
                       name="<?php echo esc_attr($this->get_field_name('testimonial_arrow_hover_color')); ?>"
                       id="<?php echo esc_attr($this->get_field_id('testimonial_arrow_hover_color')); ?>"/>
            </p>


            <p>
                <b><label s for="<?php echo esc_attr($this->get_field_id('testimonial_link_color')); ?>">
                        <?php _e('Link Color', 'chfw-lang') ?></label></b>
                <input data-default-color="#1e73be" type="text" class="input-text ch-color-picker"
                       value="<?php echo esc_attr($testimonial_link_color); ?>"
                       name="<?php echo esc_attr($this->get_field_name('testimonial_link_color')); ?>"
                       id="<?php echo esc_attr($this->get_field_id('testimonial_link_color')); ?>"/>
            </p>


            <p>
                <b><label for="<?php echo esc_attr($this->get_field_id('testimonial_desc')); ?>">
                        <?php _e('Description', 'chfw-lang') ?></label></b>
                <textarea name="<?php echo esc_attr($this->get_field_name('testimonial_desc')); ?>"
                          id="<?php echo esc_attr($this->get_field_id('testimonial_desc')); ?>"
                          style="float: left; clear: both; height: 100px; width: 100%; padding: 3px;"><?php echo esc_attr($testimonial_desc); ?></textarea>
            </p>


        </div>
        <?php
    }
}