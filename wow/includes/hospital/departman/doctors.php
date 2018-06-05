<?php
/**
 * eq departmans/airway-lungs/ page uses
 * Created by wow team
 * Date: 14.11.2017
 * Time: 19:19
 */ ?>
<?php if (!empty($CHfw_EventInfo->staffs())) {
    ?>
    <div class="doctor-list-bar  col-lg-9 col-md-9  col-xs-12 ">
        <div class="row">
            <h1 class="deparmansPageH1"><?php echo get_the_title() . ' ' . __("Doctors", "chfw-lang") ?></h1>
            <?php foreach ($CHfw_EventInfo->staffs(true) as $staff) : ?>
                <div class="doctorsLoad col-md-6">
                    <div class="row">
                        <div class="col-md-4 no-padding">
                            <figure>
                                <a href="<?php echo $staff['link'] ?>">
                                    <img class="img-thumbnail" src="<?php echo $staff['img'] ?>" alt="<?php echo $staff['title'] ?>">
                                </a>
                            </figure>
                        </div>
                        <div class="col-md-8">
                            <div class="doctorsLoadInfo">
                                <a href="<?php echo $staff['link'] ?>"><h2>
                                        <span><?php echo $staff['staff_title'] ?> </span>
                                        <span><?php echo $staff['title'] ?></span>
                                    </h2></a>
                                <span class="extraInstruction"><?php echo $staff['departman'] ?></span>
                                <div class="doctorsLoadDetails">
                                    <strong><?php echo __("Specialties : ", 'chfw-lang') ?></strong>
                                    <p> <?php echo $staff['programAndServices'] ?> </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            endforeach; ?>
        </div>
    </div>
    <?php
}