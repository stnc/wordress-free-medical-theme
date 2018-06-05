<?php
$image_docktor = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'CHfw-staffPostSize');
$image_docktor = $image_docktor[0];
if ($image_docktor == "") {
	$image_docktor = get_template_directory_uri() . '/assets/images/placeholder/dockr2.png';
}

?>
<div id="post-<?php the_ID(); ?>"  class="doctorsLoad staff-mini-list col-md-6 col-sm-6 col-xs-6 col-ms-12 post mini-list">
    <div class="row">
        <div class="col-md-6 no-padding">
            <figure>
                <a href="<?php the_permalink() ?>">
                    <img class="img-thumbnail" src="<?php echo $image_docktor ?>" alt="<?php echo get_the_title() ?>">
                </a>
            </figure>
        </div>
        <div class="col-md-6 padding-right-none">
            <div class="doctorsLoadInfo">
                <a href="<?php the_permalink() ?>"><h2>
                        <span><?php echo esc_attr(get_post_meta(get_the_ID(), 'CHfw-staffSetting_title', true)); ?></span>
                        <span><?php echo get_the_title() ?></span>
                    </h2></a>
                <span class="extraInstruction"><?php echo  esc_attr(get_post_meta(get_the_ID(), 'CHfw-staffSetting_expertise', true)); ?></span>
                <div class="doctorsLoadDetails">
                    <strong><?php echo __("Specialties : ", 'chfw-lang') ?></strong>
                    <p> <?php echo chfw_StaffProgramAndServices_(get_the_ID()) ?> </p>
                </div>
            </div>
        </div>
    </div>
</div>