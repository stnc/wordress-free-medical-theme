'use strict';
/*! *wow theme woocomemrce javascript
 * http://chromthemes.com
 * Copyright (c) 2017 Chrom Themes;
 *
 * */
jQuery(function () {
        wishlistChanges();
        lazzyLoadImages();

        /* ---------------------------------------------------------------------------
         * woocomerce toogle categories
         * --------------------------------------------------------------------------- */
        jQuery(document).on("click touchstart", ".mtree .toogle", function (e) {
            if (jQuery(this).hasClass("closed")) {
                jQuery(this).removeClass("closed");
                jQuery(this).addClass("opened");
            } else {
                jQuery(this).removeClass("opened");
                jQuery(this).addClass("closed");
            }

            jQuery(this).next().toggle();
            e.preventDefault();
            e.stopPropagation();
        });


        /* ---------------------------------------------------------------------------
         * Related porducts slider
         * --------------------------------------------------------------------------- */
        jQuery('#related_product-id .ul-products,#woocommerce_upsell_display-id .ul-products').slick({
            slidesToShow: 5,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 2000,
            responsive: [
                {
                    breakpoint: 1024,
                    settings: {
                        slidesToShow: 4,
                        slidesToScroll: 4,
                        infinite: true,
                        dots: false
                    }
                },
                {
                    breakpoint: 768,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2
                    }
                },

                {
                    breakpoint: 600,
                    settings: {
                        slidesToShow: 3,
                        slidesToScroll: 2
                    }
                },
                {
                    breakpoint: 480,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                },
                {
                    breakpoint: 375,
                    settings: {
                        slidesToShow: 2,
                        slidesToScroll: 1
                    }
                }

                /* // You can unslick at a given breakpoint now by adding:
                 // settings: "unslick"
                 // instead of a settings object*/
            ]
        });

        /* ---------------------------------------------------------------------------
         * related products and upsell products lazzy images trigger
         * --------------------------------------------------------------------------- */
        jQuery('#related_product-id .ul-products,#woocommerce_upsell_display-id .ul-products').on('beforeChange', function (event, slick, direction) {
            lazzyLoadImages();
        });

        /* ---------------------------------------------------------------------------
         * Product page and quick view quantity (+)
         * --------------------------------------------------------------------------- */
        jQuery(".qty-increase_ch").on("click", function () {
            var Sc_fwqty_ = parseInt(jQuery(this).prev().val());
            jQuery(this).prev().val(Sc_fwqty_ + 1);
        });

        /* ---------------------------------------------------------------------------
         * Product page and quick view quantity (-)
         * --------------------------------------------------------------------------- */
        jQuery(".qty-decrease_ch").on("click", function () {
            var Sc_fwqty_ = parseInt(jQuery(this).next().val());
            if (Sc_fwqty_ != 1) {
                jQuery(this).next().val(Sc_fwqty_ - 1);
            }
        });


        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- shipping
         * --------------------------------------------------------------------------- */
        jQuery("#ship-different-address-checkbox").on("click", function () {
            var control = jQuery(this).is(':checked');
            var shipping_return = jQuery("#ship-to-different-address-checkbox");
            if (control) {
                jQuery(".order_review_tap_open").show();
                jQuery(".shipping_tap_open").hide();

                var control2 = shipping_return.is(':checked');
                if (control2) {
                    /*  // is checked*/
                    shipping_return.click();
                    shipping_return.prop("checked", false);
                    jQuery('.woocommerce-shipping-fields .shipping_address').hide();
                }

            } else {
                var control2 = shipping_return.is(':checked');
                /* //is not checked*/
                if (!control2) {
                    shipping_return.click();
                    shipping_return.prop("checked", true);
                    jQuery('.woocommerce-shipping-fields .shipping_address').show();
                }
                jQuery(".order_review_tap_open").hide();
                jQuery(".shipping_tap_open").show();
            }
        });

        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- login
         * --------------------------------------------------------------------------- */
        jQuery(".login_tap_open").on("click", function () {
            jQuery("#login_acc").click();
        });


        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- reviews
         * --------------------------------------------------------------------------- */
        jQuery(".order_review_tap_open").on("click", function () {
            jQuery("#order_review_acc").click();
        });


        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- ship
         * --------------------------------------------------------------------------- */
        jQuery(".shipping_tap_open").on("click", function () {
            jQuery("#shipping_adress_acc").click();
        });


        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- payment
         * --------------------------------------------------------------------------- */
        jQuery(".payment_tap_open").on("click", function () {
            jQuery("#payment_method_acc").click();
        });


        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- order
         * --------------------------------------------------------------------------- */
        jQuery(".order_notes_tap_open").on("click", function () {
            jQuery("#order_notes_acc").click();
        });


        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- billing
         * --------------------------------------------------------------------------- */
        jQuery(".billing_adress_tap_open").on("click", function () {
            jQuery("#billing_address_acc").click();
        });


        /* ---------------------------------------------------------------------------
         * CheckOutPAge | Tab controls -- place
         * --------------------------------------------------------------------------- */
        jQuery('#woo-checkout-page #place_order').click(function () {
            // jQuery.blockUI();
        });


        /* ---------------------------------------------------------------------------
         *Quickview  live ajax click trigger
         * --------------------------------------------------------------------------- */
        jQuery(document).on("click touchstart", ".qucikview-ajax-popup", function (e) {

            e.preventDefault();
            var url__ = jQuery(this).attr('href');

            var url__ = url__.replace(/\/?(\?|#|$)/, '/$1');//for 301 redirect
            jQuery.ajax({
                url: url__,
                method: 'post',
                dataType: "html",
                //  beforeSend: function() { jQuery('#waitSc_fw').show(); },
                success: function (returning) {
                    jQuery("#small-dialog").removeClass('small-dialog-class');
                    jQuery("#small-dialog").addClass('quickview-dialog-class');
                    jQuery("#small-dialog").html(returning);
                    magnifiy_inline_popup();
                    quickview_events();
                },
                complete: function (returning) {
                    // jQuery('#waitSc_fw').hide();
                },
                error: function (errorThrown) {
                    console.log(errorThrown);
                }
            });
        });


        /* ---------------------------------------------------------------------------
         *Mini Cart Open
         * --------------------------------------------------------------------------- */
        jQuery('#minicart-container .cart-top').hover(function () {
            jQuery('#minicart-container .cart-top .cart1').css({
                'display': 'block'
            });
        }, function () {
            jQuery('#minicart-container .cart-top .cart1').css({
                'display': 'none'
            });
        });


        /* ---------------------------------------------------------------------------
         *Mini Cart Open (sticky header layout)
         * --------------------------------------------------------------------------- */
        jQuery('#minicart-container_header-right .cart-top').hover(function () {
            jQuery('#minicart-container_header-right .cart-top .cart1').css({
                'display': 'block'
            });
        }, function () {
            jQuery('#minicart-container_header-right .cart-top .cart1').css({
                'display': 'none'
            });
        });


        /* ---------------------------------------------------------------------------
         *Checkout-page | BlockUI
         * --------------------------------------------------------------------------- */
        jQuery('#woo-checkout-page .place_order_btn').click(function () {
            jQuery('#woo-checkout-page').block({
                css: {
                    border: 'none',
                    padding: '15px',
                    backgroundColor: '#000',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    opacity: .5,
                    color: '#fff'
                },
                message: '<h1 class="wait">' + wow_wp_shop_vars.please_wait_translate + '</h1>'
            });
        });


        /* ---------------------------------------------------------------------------
         *Checkout-page | BlockUI (placeholder button hack)
         * --------------------------------------------------------------------------- */
        jQuery('#woo-checkout-page .place-order-button_checkout_bottom .place_order_btn').click(function () {
            jQuery('#woo-checkout-page .place-order-button_checkout_top .place_order_btn').click();
        });

    }
);

/* ---------------------------------------------------------------------------
 *Subcategory masonry layout
 * --------------------------------------------------------------------------- */
jQuery(window).on('load', function () {
    jQuery(".slick-arrow").text('');
    if (jQuery('.ul-products li').hasClass('masonry-post')) {
        jQuery('.products').masonry({
            itemSelector: '.masonry-post',
            isAnimated: true,
            transitionDuration: '0.8s',
            animationOptions: {
                duration: 750,
                easing: 'linear',
                queue: false
            }
        });
    }
});


/* ---------------------------------------------------------------------------
 *Lazzy load images  trigger
 * --------------------------------------------------------------------------- */
function lazzyLoadImages() {
    if (wow_wp_shop_vars.lazyyload == 1) {
        setTimeout(function () {
            jQuery(".product-image-area .product-image .lazz_load_img").unveil(200);
        }, 300);
    }
}






/* ---------------------------------------------------------------------------
 *Wishlist changes events
 * --------------------------------------------------------------------------- */
function wishlistChanges() {
    if (wow_wp_shop_vars.WishlistOpen) {
        /* //@use category page*/
        jQuery('.ul-products .yith-wcwl-wishlistexistsbrowse a').each(function () {
            var yith_wcwl_wishlistexistsbrowse = jQuery(this).text();
            jQuery(this).text('');
            jQuery(this).attr ("data-title", yith_wcwl_wishlistexistsbrowse.trim());
            jQuery(this).append('<i class=\'fa fa-heart\'></i>');
            jQuery('.yith-wcwl-wishlistexistsbrowse .feedback').hide();
        });

        /* //@uses product page*/
        jQuery('.wishlit-product .yith-wcwl-wishlistaddedbrowse span').remove();

        /* //@use category page*/
        jQuery('.ul-products .yith-wcwl-wishlistaddedbrowse a').each(function () {
            var yith_wcwl_wishlistaddedbrowse = jQuery(this).text();
            jQuery(this).text('');
            jQuery(this).attr ("data-title", yith_wcwl_wishlistaddedbrowse.trim());
            jQuery(this).append('<i class=\'fa fa-heart\'></i>');
            jQuery('.yith-wcwl-wishlistaddedbrowse .feedback').hide();
        });

        /*//@use category page*/
        jQuery('.ul-products .add_to_wishlist').each(function () {
            var yith_wcwl_wishlistaddedbrowse = jQuery(this).text();
            jQuery(this).text('');
            jQuery(this).attr ("data-title", yith_wcwl_wishlistaddedbrowse.trim());
            jQuery(this).append('<i class=\'fa fa-heart-o\'></i>');
        });

        jQuery('.ul-products .yith-wcwl-add-button img').each(function () {
            jQuery(this).attr ("src", wow_wp_shop_vars.siteThemeUrl + '/assets/images/wpspin_light_wishlist.gif');
        });

        jQuery('.ul-products .product-hover-box-list-wrap a').tipsy();

    }
}


/* ---------------------------------------------------------------------------
 *Add to cart link (all events
 * is ajax or not ajax control
 * --------------------------------------------------------------------------- */
jQuery(document).on("click touchstart", ".ul-products .product-image-area .addtocart-link", function (e) {
    e.preventDefault();
    var id, sku, type, sold;
    id = jQuery(this).data('product_id');

    sku = jQuery(this).data('product_sku');
    type = jQuery(this).data('type');
    sold = jQuery(this).data('sold');

    if (type != "simple" || sold == 'error') {
        //var goto_link = jQuery('#add_to_cart_link_' + id).attr('href');
        var goto_link = jQuery(this).attr('href');
        window.location.href = goto_link;
        return;
    }
    var url_ = wow_wp_shop_vars.ajaxSiteUrl + '?chfw-ajax-add-to-cart=1';
    var data = {'quantity': "1", 'add-to-cart': id, 'product_sku': sku};
    //  var data = {'quantity': "1", 'add-to-cart': id, 'product_sku': sku, 'ajax-add-to-cart': "1"};

    addTocartAjaxOpen(id, url_, data);

});

/* ---------------------------------------------------------------------------
 *Single Product (Add to cart trigger)
 * --------------------------------------------------------------------------- */
jQuery(document).on("submit", "#woo-single-product #chr-variations-form", function (e) {
    e.preventDefault();
    if (wow_wp_shop_vars.AjaxAddToCart == 1) {
        var id = jQuery("input[name*='add-to-cart']").val();
        var url__ = wow_wp_shop_vars.ajaxSiteUrl + '?chfw-ajax-add-to-cart=1';
        addTocartAjaxOpen(id, url__, jQuery(this).serialize());
    }
});


/*---------------------------------------------------------------------------
 *Add to cart --ajax event
 *is ajax or not ajax control
 * --------------------------------------------------------------------------- */
/**
 * @use jQuery('.summary  form.cart').submit(function (e) {
 *@use addTocartAjax(id, sku, type, sold)
 * **/
function addTocartAjaxOpen(id, url__, data) {

    var url__ = url__.replace(/\/?(\?|#|$)/, '/$1');//for 301 redirect


    jQuery.ajax({
        url: url__,
        data: data,
        method: 'post',
        dataType: "html",

        /* //  beforeSend: function() { jQuery('#waitSc_fw').show(); },*/
        success: function (returns) {
            var returning = jQuery(returns).filter("#shop-notices-wrap").html();
            var cart_count = jQuery(returns).filter("#cart-total-cont").html();
            var datas = jQuery(returns).filter("#cart-container").html();
            if (typeof returning != "undefined") {
                var n = returning.search('class="woocommerce-error"');
            } else {
                var n = '';
            }
            if (n != -1) {
                /*     //   alert("find error");*/
                if (typeof returning != "undefined") {
                    jQuery("#small-dialog").html(returning);
                    magnifiy_inline_popup();
                }
            }
            else {

                if (wow_wp_shop_vars.PopupNotification == 1) {
                    var variation_id = jQuery("input[name*='variation_id']").val();
                    if (typeof variation_id != "undefined") {
                        var variation_url = '&variation_id=' + variation_id
                    } else {
                        var variation_url = '';
                    }
                    var magnifi_url = wow_wp_shop_vars.ajaxSiteUrl + '?wc-ajax=CHfw_quickviewAjaxInfoNotifyReq&product_id=' + id + variation_url;
                    magnifi_url = magnifi_url.replace(/\/?(\?|#|$)/, '/$1');//for 301 redirect
                    jQuery.magnificPopup.close();
                    jQuery.magnificPopup.open({
                        type: 'ajax',
                        items: {
                            src: magnifi_url
                        },
                        callbacks: {
                            close: function () {
                                /*hover image and add to cart elemnts -- Stay in the air problem fix  */
                                jQuery( '.products .product.post-'+id+' .product-hover-box-list-wrap').toggle();
                                setTimeout(function () {
                                    jQuery('.products .product.post-'+id+' .product-hover-box-list-wrap').removeAttr('style');
                                }, 500);

                            }
                        }
                    });

                }
                setTimeout(function () {
                    jQuery(".mini-cart .cart-container").empty();
                    jQuery(".mini-cart .cart-container").html(datas);
                    jQuery(".cart-top .cart_link span").html(cart_count);
                    jQuery(".mobil-cart-link .mobil-cart-counter").html(cart_count);

                    if (wow_wp_shop_vars.PopupNotification == 0) {
                        jQuery('#minicart-container .cart-top .cart1').css({
                            'display': 'block'
                        });
                    }
                }, 400);

                if (wow_wp_shop_vars.PopupNotificationAutoClose == 1) {
                    setTimeout(function () {
                        jQuery.magnificPopup.close();
                    }, wow_wp_shop_vars.PopupNotificationOffTime);
                }
            }
        },
        /*//done ??
         complete: function(returns) {
         jQuery('#waitSc_fw').hide();
         },*/
        error: function (errorThrown) {
            console.log(errorThrown);
        }
    });
}

/* ---------------------------------------------------------------------------
 *Mini mobil cart popup
 * --------------------------------------------------------------------------- */
jQuery(document).on("click touchstart", ".mobil-cart-link", function (e) {
    jQuery("#small-dialog").empty();
    if (jQuery('#minicart-container_header-right .mini-cart #cart-container .mini-cart-list li').hasClass('mini_cart_item')) {
        var data = jQuery("#cart-container").html();
    } else {
        jQuery('#minicart-container_header-right .mini-cart .cart-container span').show();
        var data = jQuery('#minicart-container_header-right .mini-cart .cart-container').html();
    }


    jQuery("#small-dialog").html(data);
    jQuery("#small-dialog .mini-cart-total-container-id").css("height", '65px');
    jQuery("#small-dialog").css('padding', '20px 0px');
    jQuery("#small-dialog ").append('<button title="Close (Esc)" type="button" class="mfp-close">×</button>');
    /*magnifiy_inline_popup_inline(); depreted*/
    magnifiy_inline_popup();

});


/* ---------------------------------------------------------------------------
 * Mini cart (ajax remove)
 * --------------------------------------------------------------------------- */
jQuery(document).on("click", ".remove-product", function (e) {
    var cartItemKey = jQuery(this).attr('data-cart_item_key');
    var product_id = jQuery(this).attr('data-product_id');
    jQuery.ajax({
        type: 'GET',
        url: wow_wp_shop_vars.ajaxurl,
        data: {
            action: 'chfw_mini_cart_remove_product',
            cart_item_key: cartItemKey,
        },
        dataType: 'json',
        cache: false,
        headers: {'cache-control': 'no-cache'},
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(' AJAX error - Panel Remove Cart Product() - ' + errorThrown);
        },
        complete: function (response) {
            var json = response.responseJSON;
            if (json.status === '1') {
                jQuery('li#mini_cart_id_' + product_id).remove();
                // Update cart numbers count
                jQuery('.cart_link span').html(json.cart_count);
                jQuery(".mobil-cart-link .mobil-cart-counter").html(json.cart_count);
                // Is the cart empty?
                if (jQuery('#mini-cart-list').children().length == 0) {
                    jQuery('#mini-cart-list').remove();
                    jQuery('.mini-carts-no-products').show(); // Show "cart empty" content
                    jQuery('.mini-cart .cart-container .mini-cart-total-container-id').css('display', 'none');
                    jQuery('.mfp-content .mini-cart-total-container-id').remove();
                } else {
                    // Update cart subtotal
                    jQuery('.mini-cart-total-container #mini_cart-totalPrice').html(json.cart_subtotal);
                }
            } else {
                console.log("Couldn't remove product from cart");
            }
        }
    });
});


/* ---------------------------------------------------------------------------
 * SHOP ajax paginaton
 * --------------------------------------------------------------------------- */
jQuery(document).on("click", "#shop_loadmore-container .loadmore-btn", function (e) {
    var url = jQuery('#shop_loadmore-container .loadmore-link a').attr("href");
    url = url.replace(/\/?(\?|#|$)/, '/$1');//for 301 redirect
    if (url) {
        jQuery('#shop_loadmore-container .loadmore-controls .loadinger').show();
        jQuery('#shop_loadmore-container .loadmore-btn').hide();
        jQuery.ajax({
            type: 'GET',
            data: {
                shop_loading: 'products',
            },
            datatype: 'html',
            url: url,
            /*beforeSend: function () {
             jQuery('.loadmore-btn').text('').addClass('nm-loader');
             },*/
            success: function (data) {
                var response = jQuery('<div>' + data + '</div>');
                var nextPageUrl = response.find('.loadmore-link').children('a').attr('href');
                // newElements = response.children('.wow-products').children('li');
                var newElements = response.find('.ul-products').children('li');

                jQuery('#bodyheader .products').append(newElements);
                if (nextPageUrl) {
                    jQuery('.loadmore-link a').attr("href", nextPageUrl);

                } else {
                    //   alert("not found");
                    jQuery('#shop_loadmore-container .loadmore-link a').removeAttr("href");
                    jQuery('#shop_loadmore-container .loadmore-controls .loadmore-btn').addClass('importantRule');
                    jQuery('#shop_loadmore-container .loadmore-all-loaded').show();
                }
                wishlistChanges();
                lazzyLoadImages();


            },
            error: function (e) {
                console.log(e);
            },
            complete: function () {
                jQuery('#shop_loadmore-container .loadmore-controls .loadinger').hide();
                jQuery('#shop_loadmore-container .loadmore-btn').show();
            },

        });
        return false;
    }
});


/* ---------------------------------------------------------------------------
 * Sidebar  (top,left,right sidebar) widget ajax  event
 * --------------------------------------------------------------------------- */
jQuery(document).on("click", ".sidebar .widget_ch_woo_color_filter ul li a," +
    ".sidebar .widget_wc_collabsing_categories ul li a," +
    ".sidebar .ch_product_sorting_widget ul li a," +
    ".sidebar .ch_widget_price_filter ul li a ," +
    "#woo-archiveproduct-page .yith-wcan-reset-navigation", function (e) {
    e.preventDefault();
    widget_sidebar_ajax(this);
});




/* ---------------------------------------------------------------------------
 * Top widget ajax  event
 * --------------------------------------------------------------------------- */
jQuery(document).on("click", "#widgets-top-shop-ul .widget_ch_woo_color_filter ul li a ," +
    "#widgets-top-shop-ul .ch_product_sorting_widget ul li a," +
    "#widgets-top-shop-ul .ch_widget_price_filter ul li a ," +
    "#widgets-top-shop-ul .widget_wc_collabsing_categories ul li a," +
    ".reset-navigation_btn .yith-wcan-reset-navigation", function (e) {
    e.preventDefault();
    widget_top_ajax(this, false);
});

/* ---------------------------------------------------------------------------
 * Top widget click events
 * --------------------------------------------------------------------------- */
function widget_top_ajax($self, isBackButton) {
    if (isBackButton) {
        var pageUrl = $self;
    } else {
        var pageUrl = jQuery($self).attr('href');
        StoreState(pageUrl);
    }

    pageUrl = pageUrl.replace(/\/?(\?|#|$)/, '/$1');

    jQuery(document).ajaxStop(jQuery.unblockUI);
    var block_ui_tag = "#woo-archiveproduct-page";
    ajax_shop_loading_block_ui(block_ui_tag);


    jQuery.ajax({
        url: pageUrl,
        data: {
            shop_loading: 'full',
            request_page: wow_pageinfo.page_name
        },
        dataType: 'html',
        cache: false,
        headers: {'cache-control': 'no-cache'},
        method: 'POST', /*// Note: Using "POST" method for the Ajax request to avoid "shop_load" query-string in pagination links*/
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(' AJAX error  ' + errorThrown);
            /*  // Hide 'loader' overlay (after scroll animation)
             //  self.shopHideLoader();*/
        },
        success: function (response) {
            jQuery('#bodyheader .ajax-page-content').empty();
            jQuery('#bodyheader .ajax-page-content').html(response);
            jQuery('#breadcrumb-container-title').remove();
            jQuery(".lazz_load_img").unveil(200);
            wishlistChanges();
            jQuery(block_ui_tag).unblock();
            mobile_resize('#woo-archiveproduct-page .breadcrumb-container', 2);

        }
    });
}

/* ---------------------------------------------------------------------------
 * Sidebar widget click events
 * --------------------------------------------------------------------------- */
function widget_sidebar_ajax($self) {

    var pageUrl = jQuery($self).attr('href');
    var block_ui_tag = "#woo-archiveproduct-page";
    ajax_shop_loading_block_ui(block_ui_tag);

    /* // Make sure the URL has a trailing-slash before query args (301 redirect fix)*/
    var pageUrl = pageUrl.replace(/\/?(\?|#|$)/, '/$1');

    // Set browser history "pushState" (if not back button "popstate" event)
    if (!isBackButton) {
        //  setPushState(pageUrl);
        StoreState(pageUrl);
    }

    jQuery.ajax({
        url: pageUrl,
        data: {
            shop_loading: 'full',
            request_page: wow_pageinfo.page_name
        },
        dataType: 'html',
        cache: false,
        headers: {'cache-control': 'no-cache'},
        method: 'POST', /*// Note: Using "POST" method for the Ajax request to avoid "shop_load" query-string in pagination links*/
        error: function (XMLHttpRequest, textStatus, errorThrown) {
            console.log(' AJAX error  ' + errorThrown);
        },
        success: function (response) {

            jQuery('#bodyheader .ajax-page-content').hide();


            /*****SIDEBAR parse*****/
            jQuery('#tempdom').html(
                jQuery('<div />').html(response).find('#woo-archiveproduct-page #widgets-top-shop-bar #widgets-top-shop-ul').html()
            );

            var $temp_sidebar = jQuery('#tempdom').html();
            jQuery('.sidebar').empty();
            jQuery('.sidebar').html($temp_sidebar);

            /*****breadcrumb parse*****/
            jQuery('#tempdom').html(
                jQuery('<div />').html(response).find('#breadcrumbContainer').html()
            );

            var $breadcrumb = jQuery('#tempdom').html();
            jQuery('#bodyheader .ajax-page-content .breadcrumb-container').empty();
            jQuery('#bodyheader .ajax-page-content .breadcrumb-container').html($breadcrumb);

            /*****Content parse*****/
            jQuery('#tempdom').html(
                jQuery('<div />').html(response).find('#ajax-content-products').html()
            );

            var $container = jQuery('#tempdom').html();
            jQuery('#bodyheader .ajax-page-content').html($breadcrumb + $container);


            setTimeout(function () {
                jQuery(block_ui_tag).unblock();
                jQuery('#bodyheader .ajax-page-content').show();
                jQuery(".lazz_load_img").unveil(200);
                jQuery('#tempdom').empty();
                jQuery('.pagination-centered').remove();
            }, 400);

            wishlistChanges();
        }
    });
}

//is back button control trigger
var isBackButton = false;
var hasPushState;

/* ---------------------------------------------------------------------------
 * Window history (top and sidebar widget trigger)
 * --------------------------------------------------------------------------- */
jQuery(document).ready(function () {
    if (jQuery('html').hasClass('history')) {
        hasPushState = true;
        window.history.replaceState({chShop: true}, '', window.location.href);
    } else {
        hasPushState = false;
    }
});

/* ---------------------------------------------------------------------------
 * Window history | back/forward hit  (top and sidebar widget trigger)
 * --------------------------------------------------------------------------- */
window.addEventListener("popstate", function (e) {
//state contolr =https://css-tricks.com/examples/State/app.js
    var state = e.state;
    if (state != null) {
        widget_top_ajax(document.location.href, true);
    }
});


/* ---------------------------------------------------------------------------
 * Window history | push/replace state  (top and sidebar widget trigger)
 * --------------------------------------------------------------------------- */
function StoreState(url) {
    if (hasPushState) {
        // push new state
        history.pushState({chShop: true}, '', url);
    }
}


/* ---------------------------------------------------------------------------
 * *variant form trigger
 * uses --->  variant products for  zoom image
 * --------------------------
 * ------------------------------------------------- */
function find_regex_images(str) {
    /*https://regex101.com/r/jO8bC4/5*/
    var re = /([a-z]+\:\/+)([^\/\s]*)([a-z0-9\-@\^=%&;\/~\+]*)[\?]?([^ \#]*)#?([^ \#]*)/ig;
    /*  var str = 'Bob: Hey there, have you checked https://www.facebook.com ?\n(ignore) https://github.com/justsml?tab=activity#top (ignore this too)';*/
    var m;

    while ((m = re.exec(str)) !== null) {
        if (m.index === re.lastIndex) {
            re.lastIndex++;
        }
        return m[0];
        /* console.log(m);*/
    }
}
