<?php
global $CHfw_rdx_options,$CHfw_select_skin,$page_setting_class ;
$center_control_class=$page_setting_class->siteCenterControl();

if ( isset( $CHfw_rdx_options[ 'sidebar_view_model_' . $CHfw_select_skin ] ) ) {
    $sidebar_view_model = $CHfw_rdx_options[ 'sidebar_view_model_' . $CHfw_select_skin ];
} else {
    $sidebar_view_model = "unboxed";
}

?>

<aside class="sidebar container-sidebar <?php echo $sidebar_view_model.' '.$center_control_class?>">
    <?php
    /*https://paulund.co.uk/get-the-current-post-type-in-wordpress*/
    if (get_post_type()=='page' or get_post_type()=='post') {
        dynamic_sidebar('sidebar-1');
    } elseif (get_post_type()=='product') {
        dynamic_sidebar('shop-sidebar1');
    } else {
        if (get_post_meta(get_the_ID(), 'sidebars', true) != '') {
            dynamic_sidebar(get_post_meta(get_the_ID(), 'sidebars', true));
        } else {
            dynamic_sidebar('sidebar-1');
        }
    }
    ?>
</aside>