<?php
/**
 * The template for displaying content in the single.php and page-zigzagOne , page-timeline.php ,page-zigzagTwo
 * AJAX pagination
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */
global  $wp_query;
if ($wp_query->max_num_pages <= 1)
	return;
?>
<div class="sc_fw-timeline-block load-more-block">
    <div id="blog_loadmore-container" class="ajax-loadmore">
        <div style="display: none" class="loadmore-link"><?php next_posts_link('&nbsp;'); ?></div>
        <div class="loadmore-controls timeline_load_more_controls">
            <div class="loadinger loadextra">
	            <div class="Pagination-windows8_style">
					<div class="wBall" id="wBall_1">
						<div class="wInnerBall"></div>
					</div>
					<div class="wBall" id="wBall_2">
						<div class="wInnerBall"></div>
					</div>
					<div class="wBall" id="wBall_3">
						<div class="wInnerBall"></div>
					</div>
					<div class="wBall" id="wBall_4">
						<div class="wInnerBall"></div>
					</div>
					<div class="wBall" id="wBall_5">
						<div class="wInnerBall"></div>
					</div>
				</div>
            </div>
            <span>
	            <a href="javascript:;" class="load-more loadmore-btn">
                    <i class="fa fa-angle-double-down"></i></a>
            </span>
        </div>
    </div> <!-- sc_fw-timeline-img -->
</div>