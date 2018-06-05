<div class="programAndServices-bar  col-lg-9 col-md-9  col-xs-12 ">
    <h1 class="deparmansPageH1"> <?php echo __("Programs and Services","chfw-lang"); ?> </h1>
	<?php
	foreach ($CHfw_EventInfo->SubDepartmansList_ProgramsandServices as $ProgramsandServices) :?>
        <div class="article-group">
            <article class="articleContent">
                <div class="article-text">
                    <h3>
                        <a class="article-title" href="<?php echo $ProgramsandServices['link'] ?>"><?php echo $ProgramsandServices['title'] ?></a>
                    </h3>
                    <div class="excerpt">
                        <p><?php echo $ProgramsandServices['excerpt'] ?></p>
                    </div>
                </div>
            </article>
        </div>
	<?php endforeach;	?>
</div>