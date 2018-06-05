<?php global $CHfw_rdx_options; ?>

<nav id="this-top-nav-menu" class="nav top-nav hidden-xs hidden-sm">
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-12 col-xs-12 none-padding-left">
                <div class="navbar-header">
                    <div class="mega_menu_logo-container">
                        <a href="/" class="mega_menu_logo logo" id="mega_menu_logoid">
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
                </div>
            </div>
            <nav class="col-md-7 col-sm-12 col-xs-12">
                <div class="assemblerfl-container currency">
                    <div class="adress col-lg-4  col-md-4 col-sm-4 col-xs-12">
                        <div class="headerol first">
                            <div class="iconstyle">
                                <i class="fa fa-map-marker"></i>
                            </div>
                            <div class="icontext">
                                <a class="link-login" href="/contact" title="Login" rel="nofollow">
                                    <strong> <?php _e('Location', 'chfw-lang') ?></strong><br>
                                    <span>  <?php _e('2150 Falcon  USA', 'chfw-lang') ?> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="mail-info col-lg-4  col-md-4 col-sm-4 col-xs-12">
                        <div class="headerol">
                            <div class="iconstyle">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <div class="icontext">
                                <a class="link-wishlist wishlist_block"
                                   href="/contact/" title="mail">
                                    <strong> <?php _e('Mail', 'chfw-lang') ?></strong><br>
                                    <span><?php _e('info@examp.com', 'chfw-lang') ?></span>
                                </a>
                            </div>

                        </div>
                    </div>
                    <div class="contact-info col-lg-4  col-md-4 col-sm-4 col-xs-12">
                        <div class="headerol">
                            <div class="iconstyle">
                                <i class="fa fa-phone-square"></i>
                            </div>
                            <div class="icontext">
                                <a class="link-mycart" href="/contact/"
                                   title="contact">
                                    <strong> <?php _e('Phone', 'chfw-lang') ?></strong><br>
                                    <span>  <?php _e('1800-123-456', 'chfw-lang') ?> </span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
            <div class="col-md-2 col-sm-12 col-xs-12">
                <a href="<?php echo site_url() ?>/make-an-appointment/" class="btn btn-secondary booking"><?php _e("Make an appointment", 'chfw-lang') ?></a>
            </div>
        </div>
    </div>
</nav>