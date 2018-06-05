<?php
if (!defined('ABSPATH')) {
    exit;
} // Exit if accessed directly

/**
 * Widget Popular Post
 *
 * @package wow
 * @author Chrom Themes
 * @link http://chromthemes.com
 * @version 2.0
 */
class CHfw_Popular_Post extends WP_Widget
{
    /* ---------------------------------------------------------------------------
     * INIT
     * --------------------------------------------------------------------------- */
    function __construct()
    {
        $widget_ops = array(
            'classname' => 'CHfw_Popular_Post',
            'description' => esc_html__("CH Popular Posts", 'chfw-lang')
        );
        parent::__construct('CHfw_Popular_Post', esc_html__('CH Popular Posts', 'chfw-lang'), $widget_ops);
    }

    /* ---------------------------------------------------------------------------
    * Deals with the settings when they are saved by the admin.
    * --------------------------------------------------------------------------- */
    function update($new_instance, $old_instance)
    {
        $instance = $old_instance;
        $instance['title_popular_widget'] = strip_tags($new_instance['title_popular_widget']);
        $instance['limit_popular_widget'] = intval($new_instance['limit_popular_widget']);
        $instance['picture_show_popular_widget'] = strip_tags($new_instance['picture_show_popular_widget']);
        $instance['date_show_popular_widget'] = strip_tags($new_instance['date_show_popular_widget']);
        $instance['author_show_popular_widget'] = strip_tags($new_instance['author_show_popular_widget']);
        $instance['comments_show_popular_widget'] = strip_tags($new_instance['comments_show_popular_widget']);
        return $instance;
    }

    /* ---------------------------------------------------------------------------
     * Outputs the HTML for this widget.
     * --------------------------------------------------------------------------- */
    function widget($args, $instance)
    {
        extract($args);
        $title = isset($instance['title_popular_widget']) ? $instance['title_popular_widget'] : __('Popular Posts', 'chfw-lang');
        $limit = isset($instance['limit_popular_widget']) ? $instance['limit_popular_widget'] : 5;


        echo $before_widget;
        echo $before_title;
        echo $title;
        echo $after_title;

        /**
         * Widget Content
         */
        ?>

        <?php


        /*for populer post  yoruma göre
          $popular_post_args = array(
             'posts_per_page' => $limit + 1,
             'orderby' => 'comment_count',
             'order' => 'DESC',
             'ignore_sticky_posts' => 1
         );  $popular_post_args_query = new WP_Query($popular_post_args);
         */

        $popular_post_args = array(
            'posts_per_page' => $limit,
            'meta_key' => 'CHfw-PostViewsCount',
            'orderby' => 'meta_value_num',
            'order' => 'DESC',
            'post_type' => 'post',

        );
        $popular_post_args_query = new WP_Query($popular_post_args);


        if (!isset($instance['picture_show_popular_widget'])) {
            $instance['picture_show_popular_widget'] = 0;
        }


        if (!isset($instance['date_show_popular_widget'])) {
            $instance['date_show_popular_widget'] = 0;
        }

        if (!isset($instance['author_show_popular_widget'])) {
            $instance['author_show_popular_widget'] = 0;
        }

        if (!isset($instance['comments_show_popular_widget'])) {
            $instance['comments_show_popular_widget'] = 0;
        }

        /**
         * Check if zilla likes plugin exists
         */
        if ($popular_post_args_query->have_posts()) : ?>
            <!-- post posts -->
            <ul class="sc_fw-theme-last_post_list">
                <?php while ($popular_post_args_query->have_posts()) :
                    $popular_post_args_query->the_post();
                    ?>
                    <?php if (get_the_content() != '') : ?>
                    <li class="lastposts">
                        <?php if ($instance['picture_show_popular_widget'] != null) : ?>
                            <div class="thumbs">
                                <?php
                                if (get_post_format() != 'quote') {
                                    echo get_the_post_thumbnail(get_the_ID(), 'thumbnail', array('class' => ''));
                                }
                                ?>
                            </div>
                        <?php endif; ?>
                        <div class="lastposts-container">
                            <h4>
                                <a href="<?php echo get_permalink(); ?>" class="nav-button" rel="bookmark"
                                   title="<?php echo get_the_title(); ?>"><?php echo get_the_title(); ?>
                                </a>
                            </h4>
                            <div class="last_post_enrty">
                                <?php if ($instance['date_show_popular_widget'] != null) : ?>
                                    <div class="post-date">
                                        <?php echo get_the_date('d M , Y'); ?>
                                    </div>
                                <?php endif; ?>
                                <?php if ($instance['author_show_popular_widget'] != null) : ?>
                                    <span class="post-author"> by
                                        <?php echo get_the_author_link(); ?>
                                    </span>
                                <?php endif; ?>
                                <?php if ($instance['comments_show_popular_widget'] != null) : ?>
                                    <div class="comments">
                                        <?php comments_popup_link(esc_html__('Comments (0)', 'chfw-lang'), esc_html__('Comments (1)', 'chfw-lang'), esc_html__('Comments (%)', 'chfw-lang')); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div><!-- end postposts-container -->
                    </li>
                <?php endif; ?>
                <?php endwhile; ?>
            </ul>
        <?php endif; ?>
        <?php wp_reset_query(); ?>
        <!-- end post -->
        <?php

        echo $after_widget;
    }

    /* ---------------------------------------------------------------------------
     * Deals with the settings when they are saved by the admin.
     * --------------------------------------------------------------------------- */
    function form($instance)
    {

        $title_popular_widget = isset($instance['title_popular_widget']) ? $instance['title_popular_widget'] : esc_html__('Popular Posts', 'chfw-lang');
        $picture_show_popular_widget = isset($instance['picture_show_popular_widget']) ? $instance['picture_show_popular_widget'] : 'on';
        $comments_show_popular_widget = isset($instance['comments_show_popular_widget']) ? $instance['comments_show_popular_widget'] : 'on';
        $author_show_popular_widget = isset($instance['author_show_popular_widget']) ? $instance['author_show_popular_widget'] : 'on';
        $date_show_popular_widget = isset($instance['date_show_popular_widget']) ? $instance['date_show_popular_widget'] : 'on';
        $limit_popular_widget = isset($instance['limit_popular_widget']) ? $instance['limit_popular_widget'] : 5;

        ?>
        <b><label for="<?php echo $this->get_field_id('title_popular_widget'); ?>">
                <?php _e('Title', 'chfw-lang') ?></label></b>
        <br/>
        <input type="text" class="input-text"
               value="<?php echo esc_attr($title_popular_widget); ?>"
               name="<?php echo esc_attr($this->get_field_name('title_popular_widget')); ?>"
               id="<?php echo esc_attr($this->get_field_id('title_popular_widget')); ?>"/>
        <br/>
        <b><label for="<?php echo esc_attr($this->get_field_id('limit_popular_widget')); ?>">
                <?php _e('Limit Posts Number', 'chfw-lang') ?></label></b>
        <br/>

        <input type="text" class="input-text"
               value="<?php echo intval($limit_popular_widget); ?>"
               name="<?php echo esc_attr($this->get_field_name('limit_popular_widget')); ?>"
               id="<?php echo esc_attr($this->get_field_id('limit_popular_widget')); ?>"/>


        <p><input id="<?php echo esc_attr($this->get_field_id('date_show_popular_widget')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('date_show_popular_widget')); ?>" type="checkbox"
                  value="1" <?php checked(esc_attr($date_show_popular_widget, 'on')); ?>/>
            <label
                    for="<?php echo esc_attr($this->get_field_id('date_show_popular_widget')); ?>">
                <?php _e('Display item date?', 'chfw-lang'); ?></label>
        </p>

        <p><input id="<?php echo esc_attr($this->get_field_id('author_show_popular_widget')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('author_show_popular_widget')); ?>" type="checkbox"
                  value="1" <?php checked(esc_attr($author_show_popular_widget, 'on')); ?>/>
            <label
                    for="<?php echo esc_attr($this->get_field_id('author_show_popular_widget')); ?>">
                <?php _e('Display item author?', 'chfw-lang'); ?></label>
        </p>

        <p><input id="<?php echo esc_attr($this->get_field_id('comments_show_popular_widget')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('comments_show_popular_widget')); ?>" type="checkbox"
                  value="1" <?php checked(esc_attr($comments_show_popular_widget, 'on')); ?>/>
            <label
                    for="<?php echo esc_attr($this->get_field_id('comments_show_popular_widget')); ?>">
                <?php _e('Display item comments?', 'chfw-lang'); ?></label>
        </p>

        <p><input id="<?php echo esc_attr($this->get_field_id('picture_show_popular_widget')); ?>"
                  name="<?php echo esc_attr($this->get_field_name('picture_show_popular_widget')); ?>" type="checkbox"
                  value="1" <?php checked(esc_attr($picture_show_popular_widget, 'on')); ?>/>
            <label
                    for="<?php echo esc_attr($this->get_field_id('picture_show_popular_widget')); ?>">
                <?php _e('Display item picture?', 'chfw-lang'); ?></label>
        </p>

        <?php
    }
}

