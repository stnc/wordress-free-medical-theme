'use strict';
/*! *wow theme product quick view
 * http://chromthemes.com
 * Copyright (c) 2017 Chrom Themes;
 *
 * */
/*slider variable*/
var $slick_slider_gallery_init_var = '.quickview-images-slider .woocommerce-product-gallery__wrapper';

/* ---------------------------------------------------------------------------
 *Quantitiy Button (+)
 * --------------------------------------------------------------------------- */
jQuery(document).on("click touchstart", ".qty-increase_ch", function (e) {
    var Sc_fwqty_ = parseInt(jQuery(this).prev().val());
    if (Sc_fwqty_ != 1) {
        jQuery(this).prev().val(Sc_fwqty_ + 1);
    }
});


/* ---------------------------------------------------------------------------
 *Quantitiy Button (-)
 * --------------------------------------------------------------------------- */
jQuery(document).on("click touchstart", ".qty-decrease_ch", function (e) {
    var Sc_fwqty_ = parseInt(jQuery(this).next().val());
    if (Sc_fwqty_ != 1) {
        jQuery(this).next().val(Sc_fwqty_ - 1);
    }
});

/* ---------------------------------------------------------------------------
 *varianton header (show hide)
 * --------------------------------------------------------------------------- */
function shopToggleVariationDetails() {
    var $variationDetails = jQuery('#ch-single-variation .single_add_to_cart_button');
    // Show variation details container (if it has content)
    if ($variationDetails.children().length) {
        $variationDetails.prop("disabled", false);
    } else {
        $variationDetails.prop("disabled", true);
    }
}

/* ---------------------------------------------------------------------------
 *Quickview Events
 * --------------------------------------------------------------------------- */
function quickview_events() {
    slick_slider_gallery_init($slick_slider_gallery_init_var, false);
    var productId = jQuery('#quickview-content-ajax #chr-variations-form').attr('data-product_id');

    var $quickContainer = jQuery('#quickview-content-ajax');
    var $currentContainer = $quickContainer.children('#product-' + productId);
    var $productForm = $currentContainer.find('form.cart');
    // console.log ($productForm);
    var $lastImage = jQuery('.woocommerce-product-gallery__wrapper').find('img').last();

    var ifHasSlider = true;

//buggy otherwise
    $lastImage.one('load', function () {
        // if Variable product

        if ($currentContainer.hasClass('product-variable')) {

            // Bind WooCommerce variation-form events
            // Source: "../plugins/woocommerce/assets/js/frontend/add-to-cart-variation.js" (line 37)
            $productForm.wc_variation_form().find('.variations select:eq(0)').change();

            // Variation details
            shopToggleVariationDetails(); // Show if not empty
            $productForm.on('found_variation', function () { // Bind: WooCommerce "found_variation" event
                shopToggleVariationDetails();
            });

            // WooCommerce event: Go to first slide when variation select changes
            $productForm.on('woocommerce_variation_select_change', function () {
                if (ifHasSlider) {
                    jQuery($slick_slider_gallery_init_var).slick('slickGoTo', 0, false); // (event, slideIndex, skipAnimation)
                }
            });


            /*   $productForm.submit(function () {
             $productForm.find(':submit').attr('disabled', 'disabled');
             });*/
        }
    });


    //wishlist a
    jQuery('.wow-product-share .yith-wcwl-wishlistexistsbrowse a').each(function () {
        var yith_wcwl_wishlistexistsbrowse = jQuery(this).text();
        jQuery(this).text('');
        jQuery(this).attr('data-title', yith_wcwl_wishlistexistsbrowse.trim());
        jQuery(this).append('<i class=\'fa fa-heart\'></i>');
        jQuery('.wow-product-share .yith-wcwl-wishlistexistsbrowse .feedback').hide();
    });

    //wishlist a adddes browse
    jQuery('.wow-product-share .yith-wcwl-wishlistaddedbrowse a').each(function () {
        var yith_wcwl_wishlistaddedbrowse = jQuery(this).text();
        jQuery(this).text('');
        jQuery(this).attr('data-title', yith_wcwl_wishlistaddedbrowse.trim());
        jQuery(this).append('<i class=\'fa fa-heart\'></i>');
        jQuery('.wow-product-share .yith-wcwl-wishlistaddedbrowse .feedback').hide();
    });

    //wishlist added
    jQuery('.wow-product-share .add_to_wishlist').each(function () {
        var yith_wcwl_wishlistaddedbrowse = jQuery(this).text();
        jQuery(this).text('');
        jQuery(this).attr('data-title', yith_wcwl_wishlistaddedbrowse.trim());
        jQuery(this).append('<i class=\'fa fa-heart-o\'></i>');
    });
    jQuery('.wow-product-share a').tipsy();
}


/* ---------------------------------------------------------------------------
 *Quickview  (Add to cart trigger)
 * --------------------------------------------------------------------------- */
jQuery(document).on("submit", "#quickview-content-ajax #chr-variations-form", function (e) {
    e.preventDefault();
    if (wow_wp_shop_vars.AjaxAddToCart == 1) {
        var id = jQuery("input[name*='add-to-cart']").val();
        var url__ = wow_wp_shop_vars.ajaxSiteUrl + '?chfw-ajax-add-to-cart=1';
        addTocartAjaxOpen(id, url__, jQuery(this).serialize());
    }
});
