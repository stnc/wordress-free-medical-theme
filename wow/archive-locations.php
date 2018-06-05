<?php

//slug = localtons/bla-bla
global $CHfw_rdx_options, $scFW_globals;
global $page_setting_class;
global $taxonomy;
$page_type_ = 'location-page';

$scFW_globals['page_type_'] = $page_type_;

$pid = get_the_ID();
$page_setting_class->is_archive_page_ref = $scFW_globals['is_archive_page_ref'];
$page_setting_class->is_search_page_ref = $scFW_globals['is_search_page_ref'];
$page_setting_class->user_defined_page_type = $page_type_;
$page_setting_class->blog_list_view_layout = 'big-layout';//new
$page_setting_class->image_effect_type_for_post_page = 'overlay';
$page_setting_class->readmore_control = true;
$blog_args = $page_setting_class->blog_args();
$image_overlay_type = $page_setting_class->image_overlay_type();
$view_options = $page_setting_class->view_options('full');
$header_setting = $page_setting_class->header_type_selected($pid, $page_type_);
$post_border_class = $page_setting_class->PostBorderControl();
$header_setting = $page_setting_class->header_type_selected($pid, 'page');
$doctor_main_info_container = "margin-size";
get_header($header_setting['header_type']);
$page_setting_class->EmbedScript($page_type_);
add_filter('the_title', 'some_callback');
function some_callback($data)
{
    global $post;
    // where $data would be string(#) "current title"
    // Example:
    // (you would want to change $post->ID to however you are getting the book order #,
    // but you can see how it works this way with global $post;)
    return 'Book Order #' . $post->ID;
}

?>
    <main id="main-container" class="doctor-detailpage">
        <!--breadcrumb-container start-->
        <div class="breadcrumb-container h150">
            <div class="row">
                <div class="container">
                    <nav class="breadCrumb">
                        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
                            <li>
                                <a itemprop="item" href="/">
                                    <span style="color: #005bd3" itemprop="name"> <?php echo __("Homepage", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="1">
                            </li>
                            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                                <a itemprop="item" href="#">
                                    <span style="color: #000" itemprop="name">  <?php echo __("Locations", 'chfw-lang') ?></span>
                                </a>
                                <meta itemprop="position" content="2">
                            </li>
                        </ol>
                    </nav>
                    <div class="breadcrumb-topInfo row">
                        <div id="breadcrumb-Info_archive" class="col-sm-7">
                            <div class="breadcrumb-Sum">
                                <h1 class="find_h1"><i class="fa fa-map-marker" aria-hidden="true"></i>

                                    <?php echo __("Locations", 'chfw-lang') ?>
                                </h1>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--breadcrumb-container end-->
        <div class="container">
            <div class="row">
                <div id="Conditions" class="<?php echo $doctor_main_info_container ?>">
                    <div class="page-bloglist" id="">
                        <div class="ajax-page-content boxed-content clearfix bloglist-page-top contentbar ">
                            <section id="doctor-detail-page"
                                     class="doctor-detail-page event-detail-page  <?php echo $post_border_class ?>">
                                <div id="location-page" class="doctor-profil-detail padding-none col-lg-12 col-md-12 col-xs-12">
                                    <div class="article entry-content the-content">
                                        <div class="loc-adrees padding-none col-lg-3 col-md-3 col-xs-12">
                                            <?php /**
                                             * Location and Hospital list
                                             * @return array
                                             * */
                                            function CHfw_hospitalList()
                                            {
                                                $i = 0;
                                                $hospitalList = array();
                                                $args = array(
                                                    'post_type' => 'locations',
                                                    'parent' => 0,
                                                    'hide_empty' => 0,
                                                    'posts_per_page' => -1,
                                                    "post_status" => "publish",
                                                );
                                                $hospitalListJson2 = "";
                                                $wp_query_prog_services = new WP_Query($args);
                                                if ($wp_query_prog_services->have_posts()) {
                                                    while ($wp_query_prog_services->have_posts()) {
                                                        $i++;
                                                        $wp_query_prog_services->the_post();
                                                        unset($previousday);
                                                        $id = $wp_query_prog_services->post->ID;
                                                        $title = $wp_query_prog_services->post->post_title;
                                                        $link = get_permalink();
                                                        $FirstLetter = substr($wp_query_prog_services->post->post_title, 0, 1);
                                                        $adress = CHfw_get_meta($id, 'CHfw-staffLocation-adress', 'CHfw-StaffLocation-Setting');
                                                        $zipCode = CHfw_get_meta($id, 'CHfw-staffLocation-zipCode', 'CHfw-StaffLocation-Setting');
                                                        $email = CHfw_get_meta($id, 'CHfw-staffLocation-email', 'CHfw-StaffLocation-Setting');
                                                        $phone = CHfw_get_meta($id, 'CHfw-staffLocation-phone', 'CHfw-StaffLocation-Setting');
                                                        $latitude = CHfw_get_meta($id, 'CHfw-staffLocation-latitude', 'CHfw-StaffLocation-Setting');

                                                        $hospitalList[$i]["id"] = $id;
                                                        $hospitalList[$i]["title"] = $title;
                                                        $hospitalList[$i]["link"] = $link;
                                                        $hospitalList[$i]["FirstLetter"] = $FirstLetter;
                                                        $hospitalList[$i]["adress"] = $adress;
                                                        $hospitalList[$i]["zipCode"] = $zipCode;
                                                        $hospitalList[$i]["phone"] = $phone;
                                                        $hospitalList[$i]["mail"] = $email;
                                                        $hospitalList[$i]["latlong"] = $latitude;
                                                        if (!empty($latitude)) {
                                                            $latitudeExplode = explode(",", $latitude);
                                                            $hospitalList[$i]["Latitude"] = $latitudeExplode[0];
                                                            $hospitalList[$i]["Longitude"] = $latitudeExplode[1];
                                                            $hospitalListJson2 .= "{" .
                                                                "address:'" . $adress . " " . $zipCode . "'," .
                                                                "title:'" . $title . "'," .
                                                                "Latitude:'" . $latitudeExplode[0] . "'," .
                                                                "Longitude:'" . $latitudeExplode[1] . "'," .
                                                                "tel:'" . $phone . "'," .
                                                                "mail:'" . $email . "'" .
                                                                "},";
                                                        } else {
                                                            $hospitalList[$i]["Latitude"] = "";
                                                            $hospitalList[$i]["Longitude"] = "";
                                                            $hospitalListJson2 .= "{" .
                                                                "address:'" . $adress . " " . $zipCode . "'," .
                                                                "title:'" . $title . "'," .
                                                                "tel:'" . $phone . "'," .
                                                                "mail:'" . $email . "'" .
                                                                "},";
                                                        }
                                                    }
                                                    wp_reset_postdata();
                                                    $return = array('ArrayHospitalList' => $hospitalList, 'StringHospitalList' => $hospitalListJson2);
                                                    return $return;
                                                }
                                            }

                                            $list = CHfw_hospitalList();
                                            //   print_r($list);
                                            //   die;
                                            ?>
                                            <script>
                                                var addresses_localStorage = [<?php echo $list['StringHospitalList']?>];
                                                var markers = [];
                                                var lastinfowindow;
                                                // ====== Create map objects =====
                                                //Credit: MDN
                                                if (!Array.prototype.forEach) {
                                                    Array.prototype.forEach = function (fn, scope) {
                                                        for (var i = 0, len = this.length; i < len; ++i) {
                                                            fn.call(scope, this[i], i, this);
                                                        }
                                                    }
                                                }

                                                function initialize() {
                                                    var latlng = new google.maps.LatLng(<?php echo $list['ArrayHospitalList'][1]['Latitude'] . ',' . $list['ArrayHospitalList'][1]['Longitude']   ?>);
                                                    var myOptions = {
                                                        zoom: 14,
                                                        center: latlng,
                                                        mapTypeId: google.maps.MapTypeId.ROADMAP
                                                    };
                                                    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
                                                    geocoder = new google.maps.Geocoder();
                                                    var bounds = new google.maps.LatLngBounds();
                                                    var image = {
                                                        url: wow_wp_shop_vars.siteThemeUrl + '/assets/images/gmap/map-pin-746123_640_50.png',
                                                        size: new google.maps.Size(50, 50),
                                                        origin: new google.maps.Point(0, 0),
                                                        anchor: new google.maps.Point(0, 15)
                                                    };

                                                    addresses_localStorage.forEach(function (mapData, idx) {
                                                        var latlng = {lat: parseFloat(mapData.Latitude), lng: parseFloat(mapData.Longitude)};
                                                        geocoder.geocode({'location': latlng}, function (results, status) {
                                                            if (status == google.maps.GeocoderStatus.OK) {
                                                                var marker = new google.maps.Marker({
                                                                    map: map,
                                                                    position: new google.maps.LatLng(mapData.Latitude, mapData.Longitude),
                                                                    title: mapData.title,
                                                                    icon: image,
                                                                    zIndex: Math.round(latlng.lat * -100000) << 5
                                                                });
                                                                var contentHtml = '<table class="table GmapsTable" style="margin-top:1px;">' +
                                                                    '<tbody><tr>' +
                                                                    '<td colspan="2" class="label-sto"><strong> ' + mapData.title + '</strong></td>' +
                                                                    '</tr> ' +
                                                                    '<tr><tr>' +
                                                                    '<td class="label-sto">Adress:</td>' +
                                                                    '<td> ' + mapData.address + '</td> ' +
                                                                    '</tr> ' +
                                                                    '<tr>' +
                                                                    '<td class="label-sto">Phone:</td>' +
                                                                    '<td>' + mapData.tel + '</td>' +
                                                                    '</tr>' +
                                                                    '<tr>' +
                                                                    '<td class="label-sto">Email:</td>' +
                                                                    '<td>' + mapData.mail + '</td>' +
                                                                    '</tr>' +
                                                                    '</tbody></table>';
                                                                var infowindow = new google.maps.InfoWindow({
                                                                    content: contentHtml
                                                                });
                                                                google.maps.event.addListener(marker, 'click', function () {
                                                                    infowindow.setContent(contentHtml);
                                                                    infowindow.open(map, marker);
                                                                });
                                                                marker.locid = idx + 1;
                                                                marker.infowindow = infowindow;
                                                                markers[markers.length] = marker;
                                                                bounds.extend(marker.position);
                                                            } else {
                                                                console.log("Geocode was not successful for the following reason: " + status);
                                                            }
                                                        });

                                                    });

                                                    $(document).on("click", ".hospital-marker-logo", function () {
                                                        var thisloc = $(this).data("locid");
                                                        for (var i = 0; i < markers.length; i++) {
                                                            if (markers[i].locid == thisloc) {
                                                                if (lastinfowindow instanceof google.maps.InfoWindow) lastinfowindow.close();
                                                                map.panTo(markers[i].getPosition());
                                                                markers[i].infowindow.open(map, markers[i]);
                                                                lastinfowindow = markers[i].infowindow;
                                                            }
                                                        }
                                                    });

                                                }

                                                $(window).load(function () {
                                                    initialize()
                                                });

                                            </script>


                                            <div class="locationsALL">
                                                <div class="form-group">

                                                    <div class="query-box">
                                                        <input name="query-input-field" class="places-search-box"
                                                               type="text" placeholder="<?php echo __("Search by town or postcode", "chfw-lang") ?>"
                                                               onfocus="this.placeholder = ''"
                                                               onblur="this.placeholder = '<?php echo __("Search by town or postcode", "chfw-lang") ?>'">
                                                        <button type="button" class="search-cta">
                                                            <i class="fa fa-search" aria-hidden="true"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                                <ul class="hospitals-item-UL">
                                                    <?php

                                                    if (!empty($list['ArrayHospitalList'])):
                                                        foreach ($list['ArrayHospitalList'] as $key => $ArrayHospitalListRow):

                                                            ?>
                                                            <li class="hospitals-item col-md-12 col-sm-6 col-xs-6 col-ms-12">
                                                                <div data-locid="<?php echo $key ?>"
                                                                     class="hospital-marker-logo"><span
                                                                            class="alpha"><?php echo $ArrayHospitalListRow['FirstLetter'] ?></span>
                                                                </div>
                                                                <div class="hospital-info">
                                                                    <h3>
                                                                        <a class="hospital-info-A"
                                                                           href="<?php echo $ArrayHospitalListRow['link'] ?>">
                                                                            <?php echo $ArrayHospitalListRow['title'] ?></a>
                                                                    </h3>
                                                                    <p class="description">
                                                                        <?php echo $ArrayHospitalListRow['adress'] . ' ' . $ArrayHospitalListRow['zipCode'] ?>
                                                                    </p>
                                                                    <a href="tel:<?php echo $ArrayHospitalListRow['phone'] ?>"
                                                                       id="mobile-number">
                                                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                                                        <?php echo $ArrayHospitalListRow['phone'] ?>
                                                                    </a>
                                                                    <div class="get-directionsDIV">
                                                                        <a class="get-directions" target="_blank"
                                                                           href="https://www.google.com/maps/place/<?php echo $ArrayHospitalListRow['adress'] ?>">
                                                                            <i class="fa fa-map-marker"
                                                                               aria-hidden="true"></i><?php echo __('Directions', 'chfw-lang') ?></a>
                                                                    </div>
                                                                </div>
                                                            </li>
                                                        <?php endforeach ?>
                                                    <?php endif ?>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="loc-map padding-right-none col-lg-9 col-md-9  col-xs-12">
                                            <div id="map_canvas"></div>
                                        </div>
                                    </div>
                                </div>
                            </section>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- main end  -->
<?php
$footer_setting = $page_setting_class->footer_type_selected($pid, $page_type_);
get_footer($footer_setting['footer_type']);