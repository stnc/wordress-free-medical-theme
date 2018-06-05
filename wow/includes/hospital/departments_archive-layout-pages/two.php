<?php
global $scFW_globals;
$args = $scFW_globals['archive-mp-event-arg'];
$wp_query = new WP_Query($args);
if ($wp_query->have_posts()) {
	while ($wp_query->have_posts()) {
		$wp_query->the_post();
		$format_typeCH = get_post_format();
		unset($previousday);
		$imagewow = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'wow-masonry-BlogListSmall-Large');
		$imagewow = $imagewow[0];
		if ($imagewow == "") {
			$imagewow = get_template_directory_uri() . '/assets/images/alldepartmens.png';
		}
		?>
		<div class="col-md-3 col-sm-4 col-xs-6 col-ms-12 post">
			<div class="staff-basic">
				<div class="staff-item">
					<div class="staff-item-image">
						<a href="<?php the_permalink() ?>">
                            <img src="<?php echo $imagewow ?>" alt="<?php the_title(); ?>">
                        </a>
					</div>
					<div class="staff-item-descr">
						<h3>
                            <a style="color:#fff;" href="<?php the_permalink() ?>"> <?php the_title(); ?></a>
                        </h3>
					</div>
				</div>
			</div>
		</div>
		<?php
	}
	wp_reset_postdata();
} else {
	get_template_part('content', 'none');
}
?>
