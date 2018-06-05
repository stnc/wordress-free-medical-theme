<?php
/**
 * eq departmans/airway-lungs/ page uses
 * Created by wow team
 * Date: 14.11.2017
 * Time: 19:19
 */ ?>
<?php if (!empty($CHfw_EventInfo->locations())) {
	?>

        <div class="doctor-list-bar  col-lg-9 col-md-9  col-xs-12">

            <h1 class="deparmansPageH1"><?php echo get_the_title() . __(" Locations","chfw-lang") ?></h1>

		<?php foreach ($CHfw_EventInfo->locations(true) as $location) : ?>
            <div class="doctorsLoad col-md-6">
                <div class="row">
                    <div class="col-md-4 no-padding">
                        <figure>
                            <a href="<?php echo $location['link'] ?>">
                                <img class="img-thumbnail"  src="<?php echo $location['img'] ?>" alt="<?php echo $location['title'] ?>">
                            </a>
                        </figure>
                    </div>
                    <div class="col-md-8">
                        <div class="doctorsLoadInfo">
                            <a href="<?php echo $location['link'] ?>"><h2>
                                    <span><?php echo $location['title'] ?></span>
                                </h2></a>
                            <span class="extraInstruction">
                            <strong> <?php echo $location['adress'] ?></strong>
                            <div class="doctorsLoadDetails">
                                      <a class="get-directions" target="_blank"
                                         href="https://www.google.com/maps/place/<?php echo $location['adress'] ?>">
                                   <i class="fa fa-map-marker"
                                      aria-hidden="true"></i><?php echo __('Directions', 'chfw-lang') ?></a></span><br>
                                <strong> <i class="fa fa-phone" aria-hidden="true"></i> <?php echo $location['phone'] ?></strong>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
			<?php
		endforeach; ?>
    </div>

	<?php
}