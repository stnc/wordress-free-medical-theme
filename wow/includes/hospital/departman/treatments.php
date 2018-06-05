<div class="programAndServices-bar  col-lg-9 col-md-9  col-xs-12 ">
    <h1 class="deparmansPageH1"> <?php echo __("Treatments","chfw-lang"); ?> </h1>
	<?php
	foreach ($CHfw_EventInfo->treatments(true) as $treatments) :?>
        <div class="article-group">
            <article class="articleContent">
                <div class="article-text">
                    <h3>
                        <a class="article-title"
                           href="<?php echo $treatments['link'] ?>"><?php echo $treatments['title'] ?></a>
                    </h3>
                    <div class="excerpt">
                        <p><?php echo $treatments['excerpt'] ?></p>
                    </div>
                </div>
            </article>
        </div>
	<?php endforeach; ?>
</div>