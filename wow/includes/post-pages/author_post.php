<?php
/**
 * The template for displaying content in the single.php
 * AUTHOR INFO
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

global $scFW_globals,$CHfw_rdx_options;
$view_options=$scFW_globals['single_view_options'];
if ($view_options['author_show']==1){
if(isset($CHfw_rdx_options['enable_author_section']) && $CHfw_rdx_options['enable_author_section'] != 0) { ?>
    <div class="author-post-info-container">
            <div class="row">
                <div class="col-sm-2 col-xs-3 author-info_col1">
                    <figure><?php echo get_avatar(get_the_author_meta('ID') , '54'); ?></figure>
                </div>
                <div class="col-sm-10 col-xs-9 author-info_col2">
                    <div class="single-author-caption author vcard">
                        <div class="author-name">
                            <div class="post-written-by">
                                <span class="author-title"> <?php esc_html_e( 'Posted by', 'chfw-lang' ); ?></span>
                                <a href="<?php echo get_author_posts_url(get_the_author_meta( 'ID' )); ?>"> <?php echo get_the_author_meta('display_name'); ?></a>
                            </div>
                        </div>
                    </div>

                    <div class="single-author-content author-description">
                        <?php echo get_the_author_meta('description'); ?>
                    </div>
                </div>
            </div>
        </div>

    <div class="clearfix"></div>
<?php }} ?>