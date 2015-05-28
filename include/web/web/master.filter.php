<div id="master_filter" style="background: #FFF;">
    <div id="busqueda"><div id="formLayer" style="position: absolute; width: 940px; height: 90px; margin-top: 0px; margin-left: 0px; display: none;"></div>
        <p class="titulo">Busca tu apartamento en la Costa Dorada</p>
        <form class="form-buscador form-caracteristicas" method="post" action="http://www.litoral.es/es/apartamentos-costa-dorada.php" id="frmSS1">
            <!-- Select Basic -->
            <div class="botones">
                <label class="control-label" for="input_location">Localización</label>
                <div class="controls">
                    <select id="input_location" name="localidad" class="input-localizacion">
                        <option value="">Localización</option>
                        <option value="98">Ametlla de Mar</option>
                        <option value="73">Cambrils</option>
                        <option value="284">Hospitalet de L´Infant</option>
                        <option value="2">La Pineda</option>
                        <option value="188">Miami Playa</option>
                        <option value="204">Salou</option>
                    </select>
                </div>
            </div>

            <!-- Text input-->
            <div class="botones">
                <label class="control-label" for="input_from">Entrada</label>
                <div class="controls">

                    <input id="input_from" name="desde" type="text" placeholder="Entrada " class="input-entrada  fecha desde  hasDatepicker" value="">


                </div>
            </div>

            <!-- Text input-->
            <div class="botones">
                <label class="control-label" for="input_to">Salida</label>
                <div class="controls">
                    <input id="input_to" name="hasta" type="text" placeholder="Salida" class="input-salida fecha hasta hasDatepicker" value="">


                </div>
            </div>

            <!-- Select Basic -->
            <div class="botones">
                <label class="control-label" for="select_adults">Adultos</label>
                <div class="controls">
                    <select id="select_adults" name="personas" class="input-adultos">
                        <option value="">Adultos</option>
                        <option value="1">1 adulto</option>
                        <option value="2">2 adultos</option>
                        <option value="3">3 adultos</option>
                        <option value="4">4 adultos</option>
                        <option value="5">5 adultos</option>
                        <option value="6">6 adultos</option>
                        <option value="7">7 adultos</option>
                        <option value="8">8 adultos</option>
                        <option value="9">9 adultos</option>
                        <option value="10">10 adultos</option>
                        <option value="11">11 adultos</option>
                        <option value="12">12 adultos</option>
                        <option value="13">13 adultos</option>
                        <option value="14">14 adultos</option>
                        <option value="15">15 adultos</option>
                    </select>
                </div>
            </div>

            <!-- Select Basic -->
            <div class="botones">
                <label class="control-label" for="select_children">Niños</label>
                <div class="controls">
                    <select id="select_children" name="ninos" class="input-ninos">
                        <option value="">Niños</option>
                        <option value="1">1 niño</option>
                        <option value="2">2 niños</option>
                        <option value="3">3 niños</option>
                        <option value="4">4 niños</option>
                        <option value="5">5 niños</option>
                        <option value="6">6 niños</option>
                        <option value="7">7 niños</option>
                        <option value="8">8 niños</option>
                        <option value="9">9 niños</option>
                        <option value="10">10 niños</option>
                        <option value="11">11 niños</option>
                        <option value="12">12 niños</option>
                        <option value="13">13 niños</option>
                        <option value="14">14 niños</option>
                        <option value="15">15 niños</option>
                    </select>
                </div>
            </div>

            <!-- Button -->
            <div class="botones">
                <div class="controls">
                    <button name="characteristics" class="btn-caracteristicas">Caracteristicas<span class="icon-mas"></span></button>

                </div>
            </div>

            <!-- Button -->
            <div class="botones">
                <div class="controls">
                    <button name="search" class="btn-buscar" type="submit"><span class="icon-lupa"></span> BUSCAR</button>

                </div>
            </div>
            <div class="caracteristicas">
                <div class="cerrar"><a href="#" class="btn btn-lg"><span class="fa fa-times"></span></a></div>
                <ul class="titulo_caracteristicas">
                    <li>Caracter&iacute;sticas</li>
                </ul>
                <div class="resultado-busqueda ancho1">
                    <div class="titulo">
                        <ul class="checkbox-tipo-1">
                            <li><input type="checkbox" class="css-checkbox" id="checkbox-tipo-1" name="tipo[]" value="1"><label class="css-label1" for="checkbox-tipo-1">Apartamento</label></li>
                        </ul>
                        <ul class="checkbox-tipo-19">
                            <li><input type="checkbox" class="css-checkbox" id="checkbox-tipo-19" name="tipo[]" value="19"><label class="css-label1" for="checkbox-tipo-19">Casa</label></li>
                        </ul>
                        <ul class="checkbox-tipo-2">
                            <li><input type="checkbox" class="css-checkbox" id="checkbox-tipo-2" name="tipo[]" value="2"><label class="css-label1" for="checkbox-tipo-2">Villa</label></li>
                        </ul>
                    </div>

                    <div class="titulo1 mas">
                        <div class="caracteristicas-grupo_botones">
                            <label class="control-label" for="caracteristicas">Nº Dormitorios</label>
                            <div class="controls">
                                <select name="habitaciones" class="input-dormitorios ancho">
                                    <option value="" class="opciones">Nº Dormitorios</option>
                                    <option value="1">
                                        1            </option>
                                    <option value="2">
                                        2            </option>
                                    <option value="3">
                                        3            </option>
                                    <option value="4">
                                        4            </option>
                                    <option value="5">
                                        5            </option>
                                    <option value="6">
                                        6            </option>
                                    <option value="7">
                                        7            </option>
                                    <option value="8">
                                        8            </option>
                                    <option value="9">
                                        9            </option>
                                    <option value="10">
                                        10            </option>
                                    <option value="11">
                                        11            </option>
                                    <option value="12">
                                        12            </option>
                                    <option value="13">
                                        13            </option>
                                    <option value="14">
                                        14            </option>
                                    <option value="15">
                                        15            </option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="titulo1">
                        <div class="caracteristicas-grupo_botones">
                            <div class="botones">
                                <label class="control-label" for="caracteristicas">Código / Nombre</label>
                                <div class="controls">
                                    <input id="texto" name="AccommodationName" type="text" placeholder="Código / Nombre" value="" class="input-codigo ancho">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="sep-buscador"></div>
                <div class="caracteristicas-grupo">
                    <label class="control-label" for="primero"></label>
                    <div class="controls">
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="SwimmingPool" id="primero-0" value="1">
                            <label class="css-label" for="primero-0">Piscina </label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="Garage" id="primero-1" value="1">
                            <label class="css-label" for="primero-1"> Garaje cerrado</label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="Satellite" id="primero-2" value="1">
                            <label class="css-label" for="primero-2"> Satélite</label>
                        </div>
                    </div>
                </div>
                <div class="caracteristicas-grupo">
                    <label class="control-label" for="segundo"></label>
                    <div class="controls">
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="Dishwasher" id="primero-3" value="1">
                            <label class="css-label" for="primero-3">Lavavajillas</label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="AirConditioned" id="primero-4" value="1">
                            <label class="css-label" for="primero-4">Aire acondicionado</label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="PetsAllowed" id="segundo-0" value="1">
                            <label class="css-label" for="segundo-0">Admite animales </label>
                        </div>


                    </div>
                </div>
                <div class="caracteristicas-grupo">
                    <label class="control-label" for="tercero"></label>
                    <div class="controls">
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="Heating" id="segundo-1" value="1">
                            <label class="css-label" for="segundo-1"> Calefacción central</label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="TV" id="segundo-2" value="1">
                            <label class="css-label" for="segundo-2"> Televisión</label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="Microwave" id="segundo-3" value="1">
                            <label class="css-label" for="segundo-3">Microondas</label>
                        </div>
                    </div>
                </div>
                <div class="caracteristicas-grupo">
                    <label class="control-label" for="tercero"></label>
                    <div class="controls">
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="Parking" id="segundo-4" value="1">
                            <label class="css-label" for="segundo-4">Parking</label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="WashingMachine" id="tercero-0" value="1">
                            <label class="css-label" for="tercero-0">Lavadora </label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="firstBeachLine" id="tercero-1" value="1">
                            <label class="css-label" for="tercero-1"> Primera línea de mar</label>
                        </div>



                    </div>
                </div>
                <div class="caracteristicas-grupo">
                    <label class="control-label" for="tercero"></label>
                    <div class="controls">
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="barbacue" id="tercero-2" value="1">
                            <label class="css-label" for="tercero-2"> BBQ</label>
                        </div>
                        <div class="check">
                            <input type="checkbox" class="css-checkbox" name="viewToBeach" id="tercero-3" value="1">
                            <label class="css-label" for="tercero-3">Vista al mar</label>
                        </div>
                    </div>
                </div>
            </div>
            <!--/caracteristicas-->
        </form>  































    </div>
</div>