<div class="programAndServices-bar  col-lg-9 col-md-9  col-xs-12 ">
    <h1 class="deparmansPageH1"> <?php echo __("Resource Family","chfw-lang"); ?> </h1>
	<?php
	foreach ($CHfw_EventInfo->resource_family(true) as $resource_family) :?>
        <div class="article-group">
            <article class="articleContent">
                <div class="article-text">
                    <h3>
                        <a class="article-title"
                           href="<?php echo $resource_family['link'] ?>"><?php echo $resource_family['title'] ?></a>
                    </h3>
                    <div class="excerpt">
                        <p><?php echo $resource_family['excerpt'] ?></p>
                    </div>
                </div>
            </article>
        </div>
	<?php endforeach; ?>
</div>