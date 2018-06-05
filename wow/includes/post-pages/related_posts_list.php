<?php
/**
 * The template for displaying content in the single.php
 * Related Posts ( list)
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

global $scFW_globals,$CHfw_rdx_options;
$view_options=$scFW_globals['single_view_options'];
if ($view_options['related_posts']==1) {
    if (isset($CHfw_rdx_options['enable_related_posts']) && $CHfw_rdx_options['enable_related_posts'] != 0) { ?>
        <!-- related posts -->
        <div class="related-posts-wrapper">
            <div class="related-title">
                <h4><?php _e('Related Posts', 'chfw-lang'); ?></h4>
            </div>
            <!-- switch related posts style -->
            <?php
            // post types
            $sim_type = isset($CHfw_rdx_options['related_posts_option']) ? $CHfw_rdx_options['related_posts_option'] : 'tags';
            $sim_posts_limit = isset($CHfw_rdx_options['related_posts_limit']) ? $CHfw_rdx_options['related_posts_limit'] : 4;
            $sim_args = '';
            // category
            if ($sim_type == '' || $sim_type == 'category') {
                /**
                 * [$getPostCat getting post categories]
                 * @var string
                 */
                $getPostCat = get_the_category();
                $postCat = '';
                if (!empty($getPostCat)) {
                    $postCats = '';
                    foreach ($getPostCat as $cat) {
                        $postCats .= $cat->term_id . ',';
                    }
                    $postCat = rtrim($postCats, ',');
                }
                if (!empty($getPostCat)) {
                    if ($postCats != '') {

                        $sim_args = array(
                            'posts_per_page' => $sim_posts_limit,
                            'post_type' => 'post',
                            'cat' => $postCats,
                            'post__not_in' => array(get_the_ID())
                        );
                    }
                }
            } else {
                // similar posts by tags
                $tags = get_the_tags();
                $post_tags = '';
                if (!empty($tags)) {
                    foreach ($tags as $tag) {
                        $post_tags .= $tag->name . ',';
                    }
                    $post_tags = rtrim($post_tags, ',');
                }
                if ($post_tags != '') {
                    $sim_args = array(
                        'posts_per_page' => $sim_posts_limit,
                        'post_type' => 'post',
                        'tag' => $post_tags,
                        'post__not_in' => array(get_the_ID())
                    );
                }
            }

            /**
             * [$getPostCat getting post categories]
             * @var string
             */
            $getPostCat = get_the_category();
            $postCat = '';
            if (!empty($getPostCat)) {
                $postCats = '';
                foreach ($getPostCat as $cat) {
                    $postCats .= $cat->term_id . ',';
                }
                $postCat = rtrim($postCats, ',');
            }
            /**
             * [$related_args related posts query]
             * this will query the latest posts from the same category
             * @var [type]
             */
            $related_args = $sim_args;
            $related_query = new WP_Query($related_args);
            ?>
            <!-- recent posts -->
            <?php
            if ($related_query->have_posts()) :
                ?>
                <div class="recent-posts-wrapper rel-arrow related">
                    <ul>
                        <?php
                        while ($related_query->have_posts()) : $related_query->the_post();
                            ?>
                            <li ><a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a></li>
                            <?php
                        endwhile;
                        ?>
                    </ul>
                </div><!-- end latest posts wrapper -->
                <?php
            endif;
            wp_reset_query();
            ?>
        </div> <!-- end related-posts-wrapper -->
        <div class="clearfix"></div>
    <?php } // end related posts check
}
?>