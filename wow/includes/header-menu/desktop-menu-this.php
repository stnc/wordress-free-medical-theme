<div class="this-desktop-menu" id="header-desktop-menu">
    <nav class="navbar yamm navbar-default ">
        <div class="container">
            <?php
            wp_nav_menu(array(
                'menu' => 'main-menu',
                'theme_location' => 'main-menu',
                'depth' => 3,
                'container' => 'div',
                'container_class' => 'collapse navbar-collapse',
                'container_id' => 'navbar-collaps',
                'menu_class' => 'nav navbar-nav',
                'fallback_cb' => 'CHfw_Wp_Bootstrap_Navwalker::fallback',
                'walker' => new CHfw_Wp_Bootstrap_Navwalker()
            ));
            ?>

            <div class="mega_menu_logo-container_mini pull-left">
                <a href="/" class="mega_menu_logo-mini" >
                    <?php
                    global $CHfw_rdx_options, $CHfw_select_skin;
                    if (isset($CHfw_rdx_options['logo2x_mini_' . $CHfw_select_skin]['url']) && !empty($CHfw_rdx_options['logo2x_mini_' . $CHfw_select_skin]['url'])) {
                        echo '<img src="' . $CHfw_rdx_options['logo2x_mini_' . $CHfw_select_skin]['url'] . '" alt="wow3 THEME">';
                    } else {
                        ?>
                        <img src="<?php echo esc_url(get_stylesheet_directory_uri()) ?>/assets/logo@2x_mini.png" alt="wow THEME">
                        <?php
                    }
                    ?>
                </a>
            </div>
            <div class="header-right">
                <?php
                if (isset($CHfw_rdx_options['mobil_menu_LayoutSelect']) && !empty($CHfw_rdx_options['mobil_menu_LayoutSelect'])) {
                    $is_mobil_menu_layout = $CHfw_rdx_options['mobil_menu_LayoutSelect'];
                } else {
                    $is_mobil_menu_layout = 'advanced';
                }
                if ($is_mobil_menu_layout == "simple"):?>
                    <button type="button" id="mobil-menu-open" class="menu-button navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <?php endif ?>

                <?php if ($is_mobil_menu_layout == "advanced"): ?>
                    <button type="button" id="mobil_menu_sidebar_open" class="menu-toggle  menu-button navbar-toggle">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                <?php endif ?>

                <div id="mobile_links">
                    <ul id="header_links">


                        <li class="option-title top">
                            <a href="https://twitter.com/<?php echo isset($CHfw_rdx_options['twitter']); ?>" title="<?php esc_html_e('Connect us on Twitter', 'chfw-lang') ?>"
                               target="_blank"> <i
                                        class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.facebook.com/<?php echo isset($CHfw_rdx_options['facebook']); ?>" title="<?php esc_html_e('Connect us on Facebook', 'chfw-lang') ?>"
                               target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.google.com/<?php echo isset($CHfw_rdx_options['googleplus']); ?>" title="<?php esc_html_e('Connect us on Google+', 'chfw-lang') ?>"
                               target="_blank"> <i
                                        class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.instagram.com/<?php echo isset($CHfw_rdx_options['instagram']); ?>" title="<?php esc_html_e('Connect us on instagram', 'chfw-lang') ?>"
                               target="_blank"> <i
                                        class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.pinterest.com/<?php echo isset($CHfw_rdx_options['pinterest']); ?>" title="<?php esc_html_e('Connect us on pinterest', 'chfw-lang') ?>"
                               target="_blank"> <i
                                        class="fa fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>
                    <form role="search" method="get" id="searchForm-desktop-this" action="<?php echo esc_url( home_url( '/' ) ); ?>">
                        <div class="input-group stylish-input-group-search">
                            <input name="s" class="form-control searchinput input-search advanced-search-input"  placeholder="<?php echo CHfw_searchParam()['placeholder']; ?>"  autocomplete="off" type="text">
                            <span class="input-group-addon">
                                   <button type="submit"><i class="fa fa-search" aria-hidden="true"></i></button>
                            </span>

                            <input type="hidden" class="post_zone_cls" name="ch_zone"
                                   value="<?php echo CHfw_searchParam()['post_zone']; ?>"/>
                            <input type="hidden" name="post_type" class="post_type_cls"
                                   value="<?php echo CHfw_searchParam()['post_type']; ?>">
                        </div>
                    </form>
                </div>

                <div class="mobil-cart-container-header-right">
                    <a class="mobil-cart-link" href="<?php echo site_url() ?>/make-an-appointment/">
                        <span class="mobil-cart-counter_"></span>
                        <i class="fa fa-calendar-check-o"></i>
                    </a>
                </div>   <!-- end  minicart-container -->

                <?php if (CHfw_woocommerce_activated()) : ?>
                    <?php if (isset($CHfw_rdx_options['shop_mini_cart_enable_disable_' . $CHfw_select_skin]) and $CHfw_rdx_options['shop_mini_cart_enable_disable_' . $CHfw_select_skin] == 1) : ?>
                        <div id="minicart-container_header-right">
                            <div class="cart-top">
                                <a class="cart_link" href="<?php echo WC()->cart->get_cart_url(); ?>">
										<span
                                                class="mylabel lable"><?php echo intval(WC()->cart->cart_contents_count); ?></span>
                                    <i class="fa fa-shopping-cart"></i>
                                </a>

                                <div class="mini-cart">
                                    <div style="display: none;" class="content cart1">
                                        <div class="cart-container">
                                            <?php woocommerce_mini_cart(); ?>
                                        </div>   <!-- end cart-container -->
                                    </div>   <!-- end content sepet1-->
                                </div>
                            </div>
                            <!-- end  cart -->
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div><!--header-right end -->
        </div>
    </nav>
    <div class="search-header-overlay">
        <div class="search-header-overlay-wrap">
            <form method="GET" id="search-header-overlay-form" class="searchform"
                  action="<?php echo esc_url(home_url('/')); ?>">
                <div role="search">
                    <input type="hidden" class="post_zone_cls" name="ch_zone"
                           value="<?php echo CHfw_searchParam()['post_zone']; ?>"/>
                    <input type="search" class="searchinput input-search" name="s" autocomplete="off"
                           placeholder="<?php echo CHfw_searchParam()['placeholder']; ?>">
                    <input type="submit" class="searchsubmit hidden" name="submit" value="Search">
                    <input type="hidden" name="post_type" class="post_type_cls"
                           value="<?php echo CHfw_searchParam()['post_type']; ?>">
                </div>
            </form>
            <button type="button" class="close">
                <span aria-hidden="true" class="fa fa-times"></span><span class="sr-only">Close</span>
            </button>
        </div>
    </div>
    <!--search-header-overlay end -->
</div>

