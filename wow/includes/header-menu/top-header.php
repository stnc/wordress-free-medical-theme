<?php global $CHfw_rdx_options;?>
<nav class="nav top-nav hidden-xs hidden-sm">
    <div class="container">
            <nav>
                <div id="mobile_links">
                    <ul id="header_links">


                        <li>
                            <a class="link-wishlist wishlist_block"
                               href="/contact/" title="mail"> <i
			                            class="fa fa-envelope"></i> <span><?php _e( 'info@chromthemes.com', 'chfw-lang' ) ?></span>
                            </a>
                        </li>
                        <li>
                            <a class="link-mycart" href="/contact/"
                               title="contact"> <i class="fa fa-phone-square"></i>
                                <span>  <?php _e( '1800-123-456', 'chfw-lang' ) ?> </span>
                            </a>
                        </li>


                        <li class="option-title top">
                            <a href="https://twitter.com/<?php echo isset($CHfw_rdx_options['twitter']); ?>" title="<?php esc_html_e( 'Connect us on Twitter','chfw-lang' ) ?>" target="_blank"> <i
			                            class="fa fa-twitter"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.facebook.com/<?php echo isset($CHfw_rdx_options['facebook']); ?>" title="<?php esc_html_e( 'Connect us on Facebook','chfw-lang' ) ?>" target="_blank">
                                <i class="fa fa-facebook"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.google.com/<?php echo isset($CHfw_rdx_options['googleplus']); ?>" title="<?php esc_html_e( 'Connect us on Google+','chfw-lang' ) ?>" target="_blank"> <i
			                            class="fa fa-google-plus"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.instagram.com/<?php echo isset($CHfw_rdx_options['instagram']); ?>" title="<?php esc_html_e( 'Connect us on instagram','chfw-lang' ) ?>" target="_blank"> <i
                                    class="fa fa-instagram"></i>
                            </a>
                        </li>
                        <li class="option-title top">
                            <a href="https://www.pinterest.com/<?php echo isset($CHfw_rdx_options['pinterest']); ?>" title="<?php esc_html_e( 'Connect us on pinterest','chfw-lang' ) ?>" target="_blank"> <i
                                    class="fa fa-pinterest"></i>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="assemblerfl-container currency">
                    <div class="pull-left">
                            <div class="btn-group">
	                              <a class="link-login" href="/contact" title="Login" rel="nofollow">
                                    <i class="fa fa-map-marker"></i> <span>  <?php _e( '2150 Falcon Street San Diego CA 94416-1680 USA', 'chfw-lang' ) ?> </span>
                                </a>
                            </div>
                    </div>
                </div>
            </nav>
    </div>
</nav>