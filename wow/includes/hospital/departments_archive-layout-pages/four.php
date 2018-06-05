<?php
global $scFW_globals;
$args = $scFW_globals['archive-mp-event-arg'];
$wp_query = new WP_Query($args);
$count = $wp_query->post_count;
$countHalf = $count / 2;
$dump1 = '';
$dump2 = '';
$i = 0;
if ($wp_query->have_posts()) {
    while ($wp_query->have_posts()) {
        $i++;
        $wp_query->the_post();
        $format_typeCH = get_post_format();
        unset($previousday);
        $title = get_the_title();
        $link = get_the_permalink();

        if ($i < $countHalf or $i == $countHalf):
            $dump1 .= '<li><a href="' . $link . '">' . $title . '</a></li>';
        endif;
        if ($i > $countHalf):
            $dump2 .= '<li><a href="' . $link . '">' . $title . '</a></li>';
        endif;


    }
    wp_reset_postdata();
} else {
    get_template_part('content', 'none');
}
?>
<div class="container2">
    <div class="row2">
        <div id="search-mobile">
            <div role="search">
                <div class="query-box">
                    <input name="query-input-field" id="myInput" onkeyup="JSquickSearch('myInput','column-links')" class="places-search-box" type="text"
                           placeholder="Search by town or postcode" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Search by town or postcode'">
                    <button type="button" class="search-cta">
                        <i class="fa fa-search" aria-hidden="true"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="column-links">
    <div class="col-md-4">
        <ul class="column-links">
            <?php echo $dump1 ?>
        </ul>
    </div>

    <div class="col-md-4">
        <ul class="column-links">
            <?php echo $dump2 ?>
        </ul>
    </div>
    <div class="col-md-4">
        <ul class="column-links">
            <li>
                <h4><?php echo __("Hospital List", 'chfw-lang') ?></h4>
            </li>
        </ul>
    </div>
</div>
