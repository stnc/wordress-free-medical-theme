<?php
if (!defined('ABSPATH')) {
    exit(); // Exit if accessed directly
}

$_GET['s']=urldecode($_GET['s']);
// If "shop_load" is set, make sure request is via AJAX
if (isset($_REQUEST['shop_loading'])) {
    if ($_REQUEST['shop_loading'] == 'ajax_search') {
        // AJAX search:
        if ($_REQUEST['post_type'] == 'post') {
            get_template_part( "search","ajax");
        }


    }
} else {

    get_template_part( "search","standart");
}

