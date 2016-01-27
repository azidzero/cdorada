<div id="map_area" class="row">
    <h4><?php echo $wlang->getString("moreinfo", "str-map"); ?></h4>
    <div id="locate_map"></div>
    <script>
        var cluster = [
<?php
$mq = mysqli_query($CNN, "SELECT * from cms_property WHERE lat!='0'");
while ($mr = mysqli_fetch_array($mq)) {
    if ($mr["lat"] != "") {
        echo " {\n";
        echo "latLng:[{$mr["lat"]},{$mr["longi"]}],\n";
        echo "data:{\n";
        $tipo = getData("cms_property_type", "id", $mr["tipo"], "name");
        echo "propiedad: \"{$mr["title"]}\",\n";
        echo "tipo: \"$tipo\",\n";
        $locale = getData("cms_property_locale", 'id', $mr["localidad"], "name");
        echo "locate: \"$locale\",\n";
        echo "room: \"{$mr["dorm"]}\",\n";
        echo "bathroom: \"{$mr["bano"]}\",\n";
        echo "capacity: \"{$mr["capacity"]}\",\n";
        echo "id: \"{$mr["id"]}\"\n";

        echo "}\n";
        echo "},\n";
    }
}
?>
        ];
        $(document).ready(function () {
            $('#locate_map').gmap3({
                map: {
                    options: {
                        center: [41.07483923, 1.180649795],
                        zoom: 10,
                        scrollwheel: false
                    }
                },
                marker: {
                    values: cluster,
                    cluster: {
                        radius: 100,
                        // This style will be used for clusters with more than 0 markers
                        5: {
                            content: "<div class = 'cluster cluster-1'><b>CLUSTER_COUNT</b></div>",
                            width: 53,
                            height: 52
                        },
                        10: {
                            content: "<div class = 'cluster cluster-2'><b>CLUSTER_COUNT</b></div>",
                            width: 56,
                            height: 55
                        },
                        // This style will be used for clusters with more than 20 markers
                        25: {
                            content: "<div class = 'cluster cluster-3'><b>CLUSTER_COUNT</b></div>",
                            width: 66,
                            height: 65
                        },
                        // This style will be used for clusters with more than 50 markers
                        50: {
                            content: "<div class = 'cluster cluster-4'><b>CLUSTER_COUNT</b></div>",
                            width: 78,
                            height: 77
                        },
                        75: {
                            content: "<div class = 'cluster cluster-5'><b>CLUSTER_COUNT</b></div>",
                            width: 90,
                            height: 89
                        }
                    },
                    options: {
                        icon: new google.maps.MarkerImage("images/map_pin.png")
                    },
                    events: {
                        mouseover: function (marker, event, context) {
                            $(this).gmap3(
                                    {clear: "overlay"},
                            {
                                overlay: {
                                    latLng: marker.getPosition(),
                                    options: {
                                        content: "<div class='map-pro " + (context.data.tipo) + "'>" +
                                                "<div class='bg'></div>" +
                                                "<div class='text'>" +
                                                "<b>" + context.data.propiedad + "</b><br/>" +
                                                "<span style=\"color:#E74C3C\">" + context.data.tipo + "</span> en " + context.data.locate + "</div>" +
                                                //"<table class=\"table table-condensed\">" +
                                                //"<tr>" +
                                                //"<td>"
                                                "</div>" +
                                                "<div class='arrow'></div>",
                                        offset: {
                                            x: -100,
                                            y: -84
                                        }
                                    }
                                }
                            });
                        },
                        mouseout: function () {
                            $(this).gmap3({clear: "overlay"});
                        },
                        click: function (marker, event, context) {
                            showMore(context.data.id);
                        }
                    }
                }
            });
        });
        function showMap() {
            var a = $('#map_area').css('display');
            if (a == "none") {
                $('#map_area').css('display', 'block');
            } else {
                $('#map_area').css('display', 'none');
            }
        }
    </script>
</div>
