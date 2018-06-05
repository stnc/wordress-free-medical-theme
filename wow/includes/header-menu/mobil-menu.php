<?php
global $CHfw_rdx_options, $CHfw_select_skin;
if (isset($CHfw_rdx_options['mobil_menu_LayoutSelect']) && !empty($CHfw_rdx_options['mobil_menu_LayoutSelect'])) {
    $is_mobil_menu_layout = $CHfw_rdx_options['mobil_menu_LayoutSelect'];
} else {
    $is_mobil_menu_layout = 'advanced';
}
?>
<?php
if ($is_mobil_menu_layout == "simple"): ?>
    <nav id="mobil-menu-container" class="">
        <div class="responsive-menu">
            <div class="menu-header">
                <div id="search-mobile">
                    <form method="GET" class="searchform" id="search-mobile-form" action="<?php echo esc_url(home_url('/')); ?>">
                        <div role="search">
                            <input type="hidden" class="post_zone_cls" name="ch_zone" value="<?php echo CHfw_searchParam()['post_zone']; ?>"/>
                            <input type="text" name="s" value="" placeholder="<?php echo CHfw_searchParam()['placeholder']; ?>" class="input-search">
                            <span class="button-search"><i class="fa fa-search"></i></span>
                            <input type="hidden" name="post_type" class="post_type_cls" value="<?php echo CHfw_searchParam()['post_type']; ?>">
                        </div>
                    </form>
                </div>
                <?php
                wp_nav_menu(array(
                    'menu' => 'mobil-menu',
                    'theme_location' => 'mobil-menu',
                    'container' => true,
                    'container_id' => 'menu-mobile-menu-simple',
                    'menu_class' => 'menu',
                    'fallback_cb' => false,
                ));
                ?>
            </div>
        </div>
    </nav>
<?php endif; ?>


<?php
if ($is_mobil_menu_layout == "advanced"): ?>
    <nav id="mobil-menu-sidebar" style="display: none;" class="sidebar boxed-content scrollbar-outer-Cancel">
        <div class=" menu-wrap">
            <div class="menu-overlay menu-close"></div>
            <nav class="menu ">

                <div class="menu-toggle _menu-toggleN on">
                    <div class="menu-toggle-hamburger menu-close">
                        <span></span>
                    </div>
                </div>
                <div class="logo-area">
                    <div class="header-logo" >
                        <div class="logo">
                            <a href="/" class="site-logo">
                                <?php
                                if (isset($CHfw_rdx_options['logo2x_mini_' . $CHfw_select_skin]['url']) && !empty($CHfw_rdx_options['logo2x_mini_' . $CHfw_select_skin]['url'])) {
                                    echo '<img  src="' . $CHfw_rdx_options['logo2x_mini_' . $CHfw_select_skin]['url'] . '" alt="mobile-logo">';
                                } else {
                                    ?>
                                    <img src="<?php echo esc_url(get_stylesheet_directory_uri()) ?>/assets/logo@2x_mini.png" alt="mobile-logo">
                                    <?php
                                }
                                ?>
                            </a>
                        </div>
                    </div>
                    <div class="mobile-menu-icon"><i class="fa fa-times-thin" aria-hidden="true"></i></div>
                </div>
                <div class="responsive-menu">
                    <div class="menu-header">
                        <?php
                        wp_nav_menu(array(
                            'menu' => 'mobil-menu',
                            'theme_location' => 'mobil-menu',
                            'container' => false,
                            'container_id' => 'menu-mobile-menu-advanced',
                            'menu_class' => 'menu',
                            'fallback_cb' => false,
                        ));
                        ?>
                    </div>
                </div><!--menu-header end-->
                <div class="mobil-menu-sidebar-search">
                    <span class="title"><?php echo esc_html__('Search', 'chfw-lang'); ?></span>

                    <form role="search" method="get" id="search-form_mb" action="<?php echo esc_url(home_url('/')); ?>">
                        <input type="hidden" class="post_zone_cls" name="ch_zone" value="<?php echo CHfw_searchParam()['post_zone']; ?>"/>
                        <input type="hidden" class="post_type_cls" name="post_type" value="<?php echo CHfw_searchParam()['post_type']; ?>"/>
                        <input type="text" class="shop-search-input input-search" autocomplete="off" value="" name="s"
                               placeholder="<?php echo CHfw_searchParam()['placeholder']; ?>">
                        <input type="submit" class="button-search">
                    </form>

                </div><!-- mobil-menu-sidebar-search end -->
                <div class="mobil-menu-socialBar">
                    <span class="title"><?php echo esc_html__('Social', 'chfw-lang'); ?></span>
                    <div class="bottom">
                        <a href="https://www.facebook.com/<?php echo isset($CHfw_rdx_options['facebook']); ?>" title="<?php esc_html_e('Connect us on Facebook', 'chfw-lang') ?>"
                           class=" btn sc_fw-facebook  btn-twitter btn-md" target="_blank">
                            <i class="fa fa-facebook"></i></a>

                        <a href="https://twitter.com/<?php echo isset($CHfw_rdx_options['twitter']); ?>" title="<?php esc_html_e('Connect us on Twitter', 'chfw-lang') ?>"
                           class=" sc_fw-twitter btn  btn-twitter btn-md" target="_blank">
                            <i class="fa fa-twitter"></i> </a>

                        <a href="https://www.instagram.com/<?php echo isset($CHfw_rdx_options['instagram']); ?>" title="<?php esc_html_e('Connect us on instagram', 'chfw-lang') ?>"
                           class=" btn sc_fw-instagram  btn-twitter btn-md" target="_blank"><i
                                    class="fa fa-instagram"></i>
                        </a>

                        <a href="https://www.pinterest.com/<?php echo isset($CHfw_rdx_options['pinterest']); ?>" title="<?php esc_html_e('Connect us on pinterest', 'chfw-lang') ?>" class=" btn sc_fw-pinterest  btn-twitter btn-md " target="_blank">
                            <i class="fa fa-pinterest"></i>
                        </a>

                        <a href="https://www.flickr.com/wow" title="Flickr"
                           class=" btn sc_fw-flickr btn-twitter btn-md" target="_blank"><i
                                    class="fa fa-flickr"></i>
                        </a>
                    </div>
                </div><!-- mobil-menu-socialBar end -->
                <ul class="main-menu tag-menu">
                    <li class="menu-tags"></li>
                </ul>
            </nav>
        </div>
    </nav>
<?php endif; ?>

