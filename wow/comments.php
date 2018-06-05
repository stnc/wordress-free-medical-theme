<?php
global $CHfw_rdx_options;

if ($CHfw_rdx_options['enable_comments'] != 0) {
    $form_message = isset($CHfw_rdx_options['commentformmessage']) ?
        $CHfw_rdx_options['commentformmessage'] : wp_kses('Please be polite. We appreciate that.<br /> Your email address will not be published and required fields are marked', 'chfw-lang');
}

if ($form_message == '') {
    $form_message = wp_kses('Please be polite. We appreciate that.<br /> Your email address will not be published and required fields are marked', 'chfw-lang');
}

/*
 * If the current post is protected by a password and the visitor has not yet
 * entered the password we will return early without loading the comments.
 */
if (post_password_required()) {
    return;
}
?>
<div class="comments-container">

    <div id="comments_number2">
        <h2 class="comments-heading">
            <?php
            wp_kses(
                printf(
                    wp_kses('One reply to &ldquo;%2$s&rdquo;', '%1$s replies to &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'chfw-lang'),
                    number_format_i18n(get_comments_number()), '<span>' . get_the_title() . '</span>'
                ),
                array('span' => array()));
            ?>
        </h2>
    </div>
    <header class="comments-tab-container">
        <ul class="nav  nav-tabs">
            <li data-container=".comments-container" data-tab="comments" id="comments_commentsTab" class="active">
                <a data-toggle="tab" href="javascript:void(0)" class="comments-tab-container_a"><i
                            class="fa fa-comments"></i> <?php _e('Comments', 'chfw-lang'); ?> </a></li>
            <li data-container=".comments-container" id="respond_commentsTab" data-tab="respond_comments">
                <a data-toggle="tab" class="comments-tab-container_a" href="javascript:void(0)"><i
                            class="fa fa-pencil"></i> <?php _e('Leave a Comment', 'chfw-lang'); ?></a>
            </li>
        </ul>
        <div class="tab-content">
            <div id="comments" class="tab-pane active">
                <!-- COMMENTS  -->
                <div id="comment-list-id">
			                        <span class="comments_alert">
                                        <?php
                                        $comments_n = esc_html__('Do you want to be the first to comment?', 'chfw-lang');
                                        $comments_o = esc_html__('1 Comment', 'chfw-lang');
                                        $comments_r = esc_html__('% Comments', 'chfw-lang');
                                        comments_number($comments_n, $comments_o, $comments_r); ?>
                                    </span>
                    <a data-toggle="tab" class="btn btn-info btn-circle btn-comment" href="#respond_comments"
                       aria-expanded="true">
                        <i class="fa fa-pencil"></i>
                        <?php esc_html__('Leave a Comment', 'chfw-lang'); ?>
                    </a>

                        <ul class="commentlist">
                            <?php
                            // list the comments
                            if (have_comments()) :
                                wp_list_comments(array( /*'type'        => 'comment',*/
                                    'short_ping' => true,
                                    'avatar_size' => 56,
                                    'callback' => 'CHfw_ListComments'
                                ));
                                // get comments count and check if pagination required
                                if (CHfw_check_comments(get_the_ID()) === 'true') :
                                    ?>
                                    <span class="prev"> <?php previous_comments_link('Older Comments'); ?></span>
                                    <span class="next"> <?php next_comments_link('Newer Comments'); ?></span>
                                <?php endif; ?>
                            <?php endif; ?>
                        </ul>

                    <!-- COMMENTS end -->
                </div>
            </div>
            <div id="respond_comments" class="tab-pane">
                <!-- COMMENT FORM  -->
                <div class="comment-form-wrapper">

                    <div class="comment-form-inner">

                        <div class="comment-respond">
                            <?php if (post_password_required()) : ?>
                            <h3><?php echo esc_html__('Post Protected', 'chfw-lang'); ?></h3>
                        </div>
                        <!-- end comments -->
                        <?php else : ?>
                            <?php if (comments_open()) : ?>
                                <h4 id="reply-title_comments"
                                    class="comment-reply-title"><?php _e('Leave a Comment', 'chfw-lang'); ?>
                                </h4>
                                <?php if (get_option('comment_registration') == 1 && !is_user_logged_in()) : ?>
                                    <p><?php echo esc_html__('Only registerd members can post a comment , ', 'chfw-lang'); ?>
                                        <a href="<?php echo wp_login_url(get_permalink()); ?>"><?php echo esc_html__('Login / Register', 'chfw-lang'); ?></a>
                                    </p>
                                <?php else : ?>
                                    <?php
                                    /**
                                     * [$comment_form_args custom comment form fields]
                                     * @var array
                                     */
                                    $reqs = '';
                                    if ($req) {
                                        $reqs = '(' . esc_html__('required', 'chfw-lang') . ')';
                                    } else {
                                        $reqs = '';
                                    }
                                    $commenter = wp_get_current_commenter();

                                    $comment_form_args = array(
                                        'id_form' => 'commentform',
                                        'comment_notes_before' => '<p class="light-font">' . $form_message
                                            . '</p>',
                                        'comment_notes_after' => '',
                                        'id_submit' => 'submit-comment',
                                        'class_submit' => 'submit-comment reply-button-comment btn btn-info btn-circle ',
                                        'title_reply' => '',
                                        'title_reply_to' => esc_html__('Leave a Reply to %s or', 'chfw-lang'),
                                        'cancel_reply_link' => esc_html__('Cancel Reply', 'chfw-lang'),
                                        'label_submit' => esc_html__('Post Comment', 'chfw-lang'),
                                        'comment_field' => '<p><textarea name="comment" id="comment-text" placeholder="' . esc_html__('Write Message', 'chfw-lang') . '" class="form-control"></textarea>',
                                        'fields' => apply_filters('comment_form_default_fields', array(

                                            'author' => '<p><input type="text" value="' . esc_attr($commenter['comment_author']) . '" name="author" class="form-control"  id="comment-name" placeholder="' . esc_html__('Your Name *', 'chfw-lang') . '" />',


                                            'email' => '<p><input type="text" value="' . esc_attr($commenter['comment_author_email']) . '" name="email" class="form-control"  id="comment-email" placeholder="' . esc_html__('Your Email *', 'chfw-lang') . '" />',

                                            'website' => '<p><input type="text" value="' . esc_attr($commenter['comment_author_url']) . '" name="url" class="form-control"  id="comment-website" placeholder="' . esc_html__('Your Website ', 'chfw-lang') . '" />'

                                        ))
                                    );
                                    comment_form($comment_form_args); ?>
                                <?php endif; ?>
                            <?php else : ?>
                                <h5><?php echo esc_html__('Comments Closed', 'chfw-lang'); ?></h5>
                            <?php endif; ?>

                        <?php endif; ?>
                    </div>
                </div><!-- #respond -->
            </div><!-- .comment-form-inner (end) -->
        </div><!-- .comment-form-wrapper (end) -->
        <!-- COMMENT FORM end -->
</div>
</header>

</div>
<!-- tab-content end -->
