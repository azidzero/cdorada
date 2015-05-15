<div class="row">
    <a href="javascript:void(0)" onclick="showMap()" class="btn btn-warning"><i class="fa fa-times"></i></a>
    <div id="property-map" class="strip_roll" style="height:360px;width:100%;"></div>
</div>
<script>
    var places = [
<?php for ($i = 0; $i < 10; $i++) { ?>
            {
                lat: 49.00408,
                lng: 2.457275,
                data: {
                    drive: false,
                    zip: 93290,
                    city: "TREMBLAY-EN-FRANCE"
                }
            },
<?php } ?>
    ];
    $(document).ready(function () {
        $('#property-map').gmap3({
            map: {
                options: {
                    center: [46.578498, 2.457275],
                    zoom: 5,
                    mapTypeId: google.maps.MapTypeId.TERRAIN
                }
            },
            marker: {
                values: places,
                cluster: {
                    radius: 100,
                    // This style will be used for clusters with more than 0 markers
                    0: {
                        content: "<div class='cluster cluster-1'>CLUSTER_COUNT</div>",
                        width: 53,
                        height: 52
                    },
                    // This style will be used for clusters with more than 20 markers
                    20: {
                        content: "<div class='cluster cluster-2'>CLUSTER_COUNT</div>",
                        width: 56,
                        height: 55
                    },
                    // This style will be used for clusters with more than 50 markers
                    50: {
                        content: "<div class='cluster cluster-3'>CLUSTER_COUNT</div>",
                        width: 66,
                        height: 65
                    }
                },
                options: {
                    icon: new google.maps.MarkerImage("http://maps.gstatic.com/mapfiles/icon_green.png")
                },
                events: {
                    mouseover: function (marker, event, context) {
                        $(this).gmap3(
                                {clear: "overlay"},
                        {
                            overlay: {
                                latLng: marker.getPosition(),
                                options: {
                                    content: "<div class='infobulle" + (context.data.drive ? " drive" : "") + "'>" +
                                            "<div class='bg'></div>" +
                                            "<div class='text'>" + context.data.city + " (" + context.data.zip + ")</div>" +
                                            "</div>" +
                                            "<div class='arrow'></div>",
                                    offset: {
                                        x: -46,
                                        y: -73
                                    }
                                }
                            }
                        });
                    },
                    mouseout: function () {
                        $(this).gmap3({clear: "overlay"});
                    }
                }
            }
        });
    });

</script>