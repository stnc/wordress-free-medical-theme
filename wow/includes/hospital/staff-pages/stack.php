<?php
$image_docktor = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'wow-AllSidebarOpen' );
$image_docktor = $image_docktor[0];
if ($image_docktor==""){
	$image_docktor =get_template_directory_uri().'/assets/images/placeholder/dockr2.png';
}
?>
<div id="post-<?php the_ID(); ?>" class="col-md-6 col-sm-6 col-xs-12 col-ms-12 post stack">
   <div class="doc-list-info-box border-radius3 position-two">
      <div class="doctor_info">
         <figure class="doc-img">
            <a href="<?php the_permalink() ?>">
	            <img class="img-responsive" src="<?php echo $image_docktor ?>" alt="<?php echo get_the_title() ?>">
            </a>
         </figure>
      </div>
      <div class="doc-container">
         <div class="doc-head">
               <a href="<?php the_permalink() ?>">
	              <span class="doctorTitle">
                    <?php echo esc_attr( CHfw_get_meta( get_the_ID(), 'CHfw-staffSetting_title', $CHfw_meta_key_staff ) ) ?>
                  </span>
               </a>
               <a href="<?php the_permalink() ?>"><h2><?php echo get_the_title() ?></h2> </a>
            <span class="expertice">
            <?php echo esc_attr( CHfw_get_meta( get_the_ID(), 'CHfw-staffSetting_expertise', $CHfw_meta_key_staff ) ); ?>
            </span>
         </div>
         <div class="doc-text">
            <p><?php echo get_the_excerpt() ?></p>
         </div>
         <div class="doc-button-box">
            <a href="<?php the_permalink() ?>#hrefappoi"
               class="btn btn-secondary booking"> <?php echo __( "Request an Appointment", 'chfw-lang' ) ?></a>
	           <a href="<?php the_permalink() ?>" class="btn btn-secondary booking"> <?php echo __( "More Information", 'chfw-lang' ) ?></a>
         </div>
      </div>
   </div>
</div>