<?php
/**
 * The template for displaying content in the single.php
 * Social Share
 * @package wow
 * @author Chrom Themes
 * @link http://www.chromthemes.com
 */

global $CHfw_rdx_options;
if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['mail'] ==1) { ?>
    <li><a href="mailto:?Subject=<?php echo get_permalink(); ?>" title="Email"
           class="sc_fw-email sc_fw-social-btn hidden-xs hidden-sm" target="_blank"><i
                class="fa fa-envelope-o"></i> </a>
    </li>
<?php } ?>
<?php if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['linkedin'] ==1) { ?>
    <li>
        <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php echo get_permalink(); ?>"
           title="linkedin" class="sc_fw-linkedin sc_fw-social-btn hidden-xs hidden-sm" target="_blank"><i
                class="fa fa-linkedin"></i> </a></li>
<?php } ?>
<?php if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['flick'] ==1) { ?>
    <li><a href="https://www.flickr.com/flicker" title="Flickr"
           class="sc_fw-flickr sc_fw-social-btn hidden-xs hidden-sm"
           target="_blank"><i class="fa fa-flickr"></i> </a></li>

<?php } ?>
<?php if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['pinterest'] ==1) { ?>
    <li><a href="//www.pinterest.com/pin/create/button/?url=<?php echo get_permalink(); ?>"
           title="Pinterest" class="sc_fw-pinterest sc_fw-social-btn hidden-xs hidden-sm" target="_blank"><i
                class="fa fa-pinterest"></i>
        </a></li>
<?php } ?>
<?php if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['gplus'] ==1) { ?>
    <li><a href="https://plus.google.com/share?url=<?php echo get_permalink(); ?>"
           title="Google Plus"
           class="sc_fw-google-plus sc_fw-social-btn hidden-xs hidden-sm" target="_blank"><i
                class="fa fa-google-plus"></i> </a></li>
<?php } ?>
<?php if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['intagram'] ==1) { ?>
    <li><a href="https://instagram.com/Instagram" title="Instagram"
           class="sc_fw-instagram sc_fw-social-btn " target="_blank"><i
                class="fa fa-instagram"></i>
        </a></li>
<?php } ?>
<?php if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['twitter'] ==1) { ?>
    <li><a href="http://twitter.com/share?url=<?php echo get_permalink(); ?>"
           title="Twitter"
           class="sc_fw-twitter sc_fw-social-btn" target="_blank"><i
                class="fa fa-twitter"></i> </a>
    </li>
<?php } ?>
<?php if (isset($CHfw_rdx_options['blog_social_share_icons_enable_disable']) && $CHfw_rdx_options['blog_social_share_icons_enable_disable']['facebook'] ==1) { ?>
    <li><a href="http://www.facebook.com/sharer.php?u=<?php echo get_permalink(); ?>"
           title="Facebook" class="sc_fw-facebook sc_fw-social-btn " target="_blank"><i
            class="fa fa-facebook"></i> </a></li><?php } ?>