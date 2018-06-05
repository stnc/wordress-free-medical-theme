<?php
/* --------------------------------------------------------------
     comments  Select (redux config)
-------------------------------------------------------------- */

function CHfw_commentsSelection($view_options)
{

    if ($view_options['comments']) {
        global $CHfw_rdx_options;

        if (isset ($_GET['comment_sys'])) {
            $comments_system = $_GET['comment_sys'];

            switch ($comments_system) {
                case 'wp' :
                    comments_template();
                    break;
                case 'disqus' :
                    CHfw_disqus_comment(get_the_ID(), get_the_title());
                    break;
                case 'facebook' :
                    CHfw_facebook_comments(get_permalink());
                    break;
                default :
                    comments_template();
                    break;
            }
        } else {

            if (isset($CHfw_rdx_options['enable_comments']) && $CHfw_rdx_options['enable_comments']) {
                // check comments system
                if (isset($CHfw_rdx_options['comments_system']) && $CHfw_rdx_options['comments_system'] != '') {
                    switch ($CHfw_rdx_options['comments_system']) {
                        case 'wp' :
                            comments_template();
                            break;
                        case 'disqus' :
                            CHfw_disqus_comment(get_the_ID(), get_the_title());
                            break;
                        case 'facebook' :
                            CHfw_facebook_comments(get_permalink());
                            break;
                    }
                } else {
                    comments_template();
                }
            }
        }
    }
}

/* --------------------------------------------------------------
    comments
    -------------------------------------------------------------- */
function CHfw_ListComments($comment, $args, $depth)
{
    $GLOBALS['comment'] = $comment;
    extract($args);
    if ($comment->comment_type == "pingback" || $comment->comment_type == "trackback") {
        ?>
        <li class="post pingback">
            <p><?php esc_html_e('Pingback:', 'chfw-lang'); ?><?php comment_author_link(); ?><?php edit_comment_link(esc_html__('Edit', 'chfw-lang'), ' '); ?></p>
        </li>
    <?php } else { ?>
        <li id="comment-<?php comment_ID(); ?>" class="comment <?php if ($depth > 1) { echo 'sub-comment';} ?>
               <?php echo implode(' ', get_comment_class('Depth')); ?>">
            <div id="comment-id-<?php comment_ID(); ?>" class="comment-body">

                <div class="comment-author vcard">
                    <?php echo get_avatar($comment->comment_author_email, 54); ?>
                    <cite class="fn">
                        <a href="<?php
                        if ($comment->user_id > 0) {
                            echo get_author_posts_url($comment->user_id);

                        } elseif (get_comment_author_url() != '') {
                            echo get_comment_author_url();
                        } else {
                            echo '#';
                        }
                        ?>"><?php echo $comment->comment_author; ?>
                        </a>
                    </cite>
                    <span class="says">  <?php echo __('says: ', 'chfw-lang') ?></span>
                </div>
                <div class="comment-meta commentmetadata">
                    <a rel="bookmark" title="<?php echo get_the_date() ?>" href="<?php echo comment_link() ?>">
                        <?php echo __('about ', 'chfw-lang') . human_time_diff(get_comment_date('U'), current_time('timestamp')) . ' ago'; ?></a>
                </div>
                <?php if ($comment->comment_approved == 0) : ?>
                    <?php echo __('Your comment is awaiting moderation', 'chfw-lang'); ?>
                <?php else : ?>
                    <?php echo wpautop($comment->comment_content); ?>
                <?php endif; ?>
                <div class="reply_ pull-right">
                    <?php
                    $myclass = 'btn btn-info btn-circle text-uppercase reply-button-comment';
                    echo preg_replace('/comment-reply-link/', 'comment-reply-link ' . $myclass,
                        get_comment_reply_link(array_merge($args, array(
                            'depth' => $depth,
                            'max_depth' => $args['max_depth']
                        ))), 1);


                    ?>
                </div>
            </div>

        <?php
    }
}


add_filter('get_avatar', 'CHfw_change_avatar_css');
function CHfw_change_avatar_css($class)
{
    $class = str_replace("class='avatar", "class='avatar img-circle", $class);

    return $class;
}

/* --------------------------------------------------------------
     Check comments
    -------------------------------------------------------------- */
/** @noinspection PhpInconsistentReturnPointsInspection */
function CHfw_check_comments($id)
{

    $count = 0;
    $pagination = get_option('comments_per_page');
    if (is_numeric($id) && $pagination) {
        $get_comments = get_comments(array(
            'post_id' => $id

        ));

        foreach ($get_comments as $comment) {
            if ($comment->comment_parent == 0) {
                $count = $count + 1;
            }
        }
    }
    if ($count >= $pagination) {

        return 'true';
    }
}

/* --------------------------------------------------------------
    Disqus comments
    -------------------------------------------------------------- */
function CHfw_disqus_comment($id, $title)
{
    global $CHfw_rdx_options;
    // check if disqus shortname is set in theme options
    if (isset($CHfw_rdx_options['disqus_shortname']) && $CHfw_rdx_options['disqus_shortname'] != '') {
        // prepare disqus url
        $name = trim($CHfw_rdx_options['disqus_shortname']);
        $url = 'http://' . $name . '.disqus.com/embed.js';


        // print script
        $return = '<div id="disqus_thread"></div>';
        $return .= '<script type="text/javascript">';
        if ($id != '' && $title != '') {
            // developer mode
            $remote_add = array('127.0.0.1', '::1');
            if (in_array($_SERVER['REMOTE_ADDR'], $remote_add)) {
                $return .= '	var disqus_developer = 1;	';
            }

            // setup
            $return .= 'var disqus_shortname = "' . $name . '";';
            $return .= 'var disqus_title = "' . $title . '";';
            $return .= 'var disqus_url = "' . get_permalink($id) . '"; ';
            $return .= 'var disqus_identifier = "' . $name . '-' . $id . '"; ';
        }
        $return .= '</script>';
        ?>
        <div class="inlineComment">
            <h4><?php _e('Leave a Comment', 'chfw-lang'); ?></h4>
            <!-- disqus comments posts -->

            <?php echo $return; ?>


        </div>
        <!-- end disqus comments -->
        <?php
    } else {
        echo '<script type="text/javascript">console.log("Please enter your disqus shortname in theme options if you wish to use disqus comments .");</script>';
    }
}


/* --------------------------------------------------------------
     Facebook Comments
-------------------------------------------------------------- */
function CHfw_facebook_comments($url)
{
    global $CHfw_rdx_options;
    $count = (isset($CHfw_rdx_options['facebook_comments_count'])) ? $CHfw_rdx_options['facebook_comments_count'] : '5';
    $theme = (isset($CHfw_rdx_options['facebook_comments_theme'])) ? $CHfw_rdx_options['facebook_comments_theme'] : 'light';
    $width = (isset($CHfw_rdx_options['facebook_comments_width'])) ? $CHfw_rdx_options['facebook_comments_width'] : '650px';
    $app_id = (isset($CHfw_rdx_options['facebook_app_id'])) ? trim($CHfw_rdx_options['facebook_app_id']) : '';
    if ($app_id != '') {
        $return = '	<div id="fb-root"></div>
						<script>(function(d, s, id) {
						  var js, fjs = d.getElementsByTagName(s)[0];
						  if (d.getElementById(id)) return;
						  js = d.createElement(s); js.id = id;
						  js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=' . $app_id . '";
						  fjs.parentNode.insertBefore(js, fjs);
						}(document, "script", "facebook-jssdk"));</script>';

        $return .= '<div class="fb-comments" data-href="' . $url . '" data-numposts="' . $count . '"  data-width="' . $width . '"  data-colorscheme="' . $theme . '"></div>';

        ?>

        <!-- facebook comments posts -->
        <div class="inlineComment">
            <h4><?php _e('Leave a Comment', 'chfw-lang'); ?></h4>
            <?php echo $return; ?>
        </div>
        <?php
    } else {
        echo '<script type="text/javascript">console.log("Facebook Comments : APP ID Is Empty .");</script>';
    }
}