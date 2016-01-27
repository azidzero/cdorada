<section id="contact" style="background-image:url('cms/content/upload/item_000000.jpg')">
    <div class="container-fluid">
        <div class="row-fluid">
            <h3>Contacto!</h3>
            <div id="contact_data" class="col-sm-6">
                <div class="container-fluid">
                    <div class="row-fluid">
                        <h4 class="panel-title" style="padding:4px;">Ponte en contacto con nosotros!</h4>
                        <div class="row-fluid">
                            <div class="input-group">
                                <span class="input-group-addon">Nombre:</span>
                                <input type="text" id="frm_name" name="frm_name" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Correo Electronico:</span>
                                <input type="text" id="frm_email" name="frm_email" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Ref.Alojamiento:</span>
                                <input type="text" id="frm_ref" name="frm_ref" class="form-control" />
                            </div>
                            <div class="input-group">
                                <span class="input-group-addon">Mensaje:</span>
                                <textarea id="frm_message" name="frm_message" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row-fluid">
                            <button class="btn btn-default btn-block" onclick="sendContact()">Enviar Mensaje</button>
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-sm-6">
                            <h4><i class="fa fa-clock-o"></i> Horario de Atenci&oacute;n</h4>
                            <strong>Lunes - Viernes</strong>: 08.30h - 13.00h y 15.30h - 19.00h. <strong>S&aacute;bados</strong>: 10.00h - 14.00h
                        </div>
                        <div class="col-sm-6">
                            <h4><i class="fa fa-map-marker"></i> Direcci&oacute;n</h4>
                            Rambla de catalunya no.24, 43480 Vila-seca, Tarragona, Espa&ntilde;a.
                        </div>
                    </div>
                    <div class="row-fluid">
                        <div class="col-sm-6">
                            <h4><i class="fa fa-phone-square"></i> Tel&eacute;fono(s)</h4>
                            +34 977 39 5854
                        </div>
                        <div class="col-sm-6">
                            <h4><i class="fa fa-envelope"></i> Correo Electr&oacute;nico</h4>
                            info@planetgoldholidays.com
                        </div>
                    </div>                                                                                                
                </div>
            </div>        
            <div id="contact_map" class="col-sm-6"></div>
        </div>
    </div>
</section>
<script>
    $(document).ready(function () {
        $('#contact_map').height($(window).height());
        $('#contact_map').gmap3({
            map: {
                //address: "Rambla Catalunya no.24 43480 Vila-seca (Tarragona) España",
                latLng: [41.109106, 1.148606],
                options: {
                    zoom: 16,
                    center: [41.109106, 1.148606],
                    scrollwheel: false
                }
            },
            styledmaptype: {
                id: "style1",
                options: {
                    name: "DARK"
                },
                styles: [
                    {"featureType": "all", "elementType": "labels.text.fill", "stylers": [{"saturation": 36}, {"color": "#000000"}, {"lightness": 40}]},
                    {"featureType": "all", "elementType": "labels.text.stroke", "stylers": [{"visibility": "on"}, {"color": "#000000"}, {"lightness": 16}]},
                    {"featureType": "all", "elementType": "labels.icon", "stylers": [{"visibility": "off"}]},
                    {"featureType": "administrative", "elementType": "geometry.fill", "stylers": [{"color": "#000000"}, {"lightness": 20}]},
                    {"featureType": "administrative", "elementType": "geometry.stroke", "stylers": [{"color": "#000000"}, {"lightness": 17}, {"weight": 1.2}]},
                    {"featureType": "landscape", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 20}]},
                    {"featureType": "poi", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 21}]},
                    {"featureType": "road.highway", "elementType": "geometry.fill", "stylers": [{"color": "#000000"}, {"lightness": 17}]},
                    {"featureType": "road.highway", "elementType": "geometry.stroke", "stylers": [{"color": "#000000"}, {"lightness": 29}, {"weight": 0.2}]},
                    {"featureType": "road.arterial", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 18}]},
                    {"featureType": "road.local", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 16}]},
                    {"featureType": "transit", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 19}]},
                    {"featureType": "water", "elementType": "geometry", "stylers": [{"color": "#000000"}, {"lightness": 17}]}]
            },
            marker: {
                //address: "Rambla Catalunya no.24 43480 Vila-seca (Tarragona) España"
                values: [
                    {latLng: [41.109106, 1.148606], data: 'Oficinas Centrales'}
                ]
            },
        });
    });

</script>