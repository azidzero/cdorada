<h2>Alojamiento</h2>
<?php
$mes = array("", "Ene", "Feb", "Mar", "Abr", "May", "Jun", "Jul", "Ago", "Sep", "Oct", "Nov", "Dic");
$semana = array(
    "Domingo",
    "Lunes",
    "Martes",
    "Miercoles",
    "Jueves",
    "Viernes",
    "S&aacute;bado");
$activ_autosave = 0;
$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$language = array();
while ($lr = mysqli_fetch_array($lq)) {
    $language[] = $lr['iso_639_1'];
}
?>
<div class="modal fade bs-example-modal-sm" id="clonehou" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
    <div class="modal-dialog modal-sm">
        <div class="modal-content" id="content_clon">
        </div>
    </div>
</div>
<?php
switch ($o) {
    case 0:
        ?>
        <small> <h4>Agregar</h4></small>
        <form action="./?m=property&s=housing&o=1" method="post" class="form" name="formhousing" id="formhousing" >
            <div role="tabpanel">
                <ul class="nav nav-tabs" role="tablist">
                    <li role="presentation" class="active"><a href="#descripcion" aria-controls="Descripcion" role="tab" data-toggle="tab">DESCRIPCION</a></li>
                    <li role="presentation" class=""><a href="#ubicacion" aria-controls="Ubicacion" role="tab" data-toggle="tab">UBICACION</a></li>
                    <li role="presentation" class=""><a href="#servicios" aria-controls="Servicios" role="tab" data-toggle="tab">SERVICIOS</a></li>
                    <li role="presentation" class=""><a href="#tarifas" aria-controls="Tarifas" role="tab" data-toggle="tab">TARIFAS</a></li>
                </ul>
            </div>
            <!-- Tab panes -->
            <div class="tab-content">
                <div role="tabpanel" class="tab-pane active" id="descripcion" style="padding: 1%;">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Nombre:</b></div>
                                    <input type="text" id="rent-name" name="rent-name" data-save="0" data-pid="0" class="form-control " onblur="savhou(this.name, this.value);" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Titulo:</b></div>
                                    <input type="text"  id="rent-title"  name="rent-title"  class="form-control " onblur="savhou(this.name, this.value);" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Modo:</b></div>
                                    <select id="rent-modo" name="rent-modo" class="form-control  " onblur="savhou(this.name, this.value);">
                                        <option value="0">Alquiler</option>
                                        <option value="1">Gestion</option>
                                        <option value="2">Venta</option>
                                        <option value="3">Traspaso</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-5">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Link:</b></div>
                                    <input type="text" id="rent-link" name="rent-link" class="form-control " onblur="savhou(this.name, this.value);" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>HUTT:</b></div>
                                    <input type="text"  id="rent-hutt" name="rent-hutt" class="form-control " onblur="savhou(this.name, this.value);" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Tipo:</b></div>
                                    <select id="rent-tipo" name="rent-tipo" class="form-control " onblur="savhou(this.name, this.value);">
                                        <option disabled selected>Selecciona...</option>
                                        <?php
                                        $doq = mysqli_query($CNN, "select * from cms_property_type");
                                        while ($t = mysqli_fetch_array($doq)) {
                                            ?>
                                            <option value="<?php echo $t['id']; ?>"><?php echo $t['name']; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon"><b>Superficie(m2):</b></div>
                                    <input type="number" min="0"  id="rent-metros" name="rent-metros" class="form-control " onblur="savhou(this.name, this.value);" />
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="row">
                                <div class="col-lg-12">
                                    <div>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <?php
                                            foreach ($language as $L) {
                                                ?>
                                                <li role="presentation" class="<?php
                                                if ($L == "es") {
                                                    echo "active";
                                                }
                                                ?>">
                                                    <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab" class="text-capitalize">
                                                        <?php echo $L; ?>
                                                        <?php if ($L == "es") { ?>
                                                            <span class="label label-danger">Requerido</span>
                                                            <?php
                                                        }
                                                        ?>
                                                    </a>
                                                </li>
                                                <?php
                                            }
                                            ?>
                                        </ul>
                                        <div class="tab-content">
                                            <?php
                                            foreach ($language as $L) {
                                                ?>
                                                <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                                                if ($L == "es") {
                                                    echo "active";
                                                }
                                                ?> " id="tab_<?php echo $L; ?>">
                                                    <br>
                                                    <div class="row ">
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">Descripci&oacute;n Corta<small><?php echo "(" . $L . ")"; ?></small></div>
                                                                    <input type="text" data-save="0" id="rent-short_<?php echo $L; ?>" name="rent-short_<?php echo $L; ?>" size="200" class="form-control " onblur="saveshort(this.name, this.value);"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-12">
                                                            <div class="form-group">
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">Descripci&oacute;n Larga<small><?php echo "(" . $L . ")"; ?></small></div>
                                                                </div>
                                                            </div>
                                                            <textarea type="text" id="rent-large_<?php echo $L; ?>" name="rent-large_<?php echo $L; ?>" data-save="0"  rows="6" cols="100%" class="form-control" onblur="saveshort(this.name, this.value);" /></textarea>
                                                            <input id="data-rent-large_<?php echo $L; ?>" name="data-rent-large_<?php echo $L; ?>" class="hidden" type="text">
                                                        </div>
                                                    </div>
                                                </div>
                                                <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <script>
                        /*       sumernote_b();*/
                    </script>
                </div>
                <div role="tabpanel" class="tab-pane" id="ubicacion" style="padding: 1%;">
                    <div class="row">
                        <div class="col-lg-6">
                            <table class="table-responsive table-hover"  width="100%">
                                <tr>
                                    <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                        <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                            <big> <b>Direcci&oacute;n:</b></big>
                                        </div>
                                    </td>
                                    <td style="padding-top:2%;padding-bottom: 2%;">
                                        <input type="text" id="rent-address" name="rent-address" class="form-control" onblur="savhou(this.name, this.value);mapadire();"/>
                                        <input type="text" id="dirho_num" value="0" class="hidden">
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                        <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                            <big> <b>Provincia:</b></big>
                                        </div>
                                    </td>
                                    <td style="padding-top: 2%; padding-bottom: 2%;">
                                        <select id="rent-provincia" name="rent-provincia" class="form-control"  onblur="savhou(this.name, this.value);mapadire();">
                                            <option disabled selected>Selecciona..</option>
                                            <?php
                                            $aqry = "select * from cms_property_locale where tipo=1 ";
                                            $L = mysqli_query($CNN, $aqry)or $err = mysqli_error($CNN);
                                            while ($pr = mysqli_fetch_array($L)) {
                                                ?><option value="<?php echo $pr['id']; ?>"><?php echo strtoupper($pr['name']); ?></option><?php
                                            }
                                            ?>
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                        <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                            <big> <b>Localidad:</b></big>
                                        </div>
                                    </td>
                                    <td style="padding-top: 2%; padding-bottom: 2%;">
                                        <select  id="rent-localidad" name="rent-localidad" class="form-control " onblur="savhou(this.name, this.value);mapadire();">
                                        </select>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                        <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                            <big> <b>Zona:</b></big>
                                        </div>
                                    </td>
                                    <td style="padding-top: 2%; padding-bottom: 2%;">
                                        <select id="rent-zona" name="rent-zona"class="form-control " onblur="savhou(this.name, this.value);mapadire();">
                                        </select>
                                    </td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-lg-6">
                            <div id="test" class="gmap3"></div>
                            <input type="text" id="lat" value="0" class="hidden"><!--latitud-->
                            <input type="text" id="long" value="0"class="hidden" ><!---Longitud-->
                        </div>
                    </div>
                    <script>
                        $(document).ready(function () {
                            // Parametros para el combo
                            $("#rent-provincia").change(function () {
                                $("#rent-provincia option:selected").each(function () {
                                    elegido = $(this).val();
                                    $.post("./include/modules/property/locale.action.php", {elegido: elegido}, function (data) {
                                        $("#rent-localidad").html(data);
                                    });
                                });
                            });
                            $("#rent-localidad").change(function () {
                                $("#rent-localidad option:selected").each(function () {
                                    elegido = $(this).val();
                                    $.post("./include/modules/property/locale.action.php", {elegido: elegido}, function (data) {
                                        $("#rent-zona").html(data);
                                    });
                                });
                            });
                        });
                    </script>
                    <div class="row">
                        <div class="col-lg-4" style="border-bottom: 2px solid; ">
                            <b>DISTANCIAS</b>
                        </div>
                    </div>
                    <br>
                    <?php
                    ?>
                    <table width="100%" cellspacing='0' >
                        <?php
                        $adondist = mysqli_query($CNN, "SELECT  a.*, (SELECT b.caption FROM cms_addon_translate b WHERE b.aid=a.id AND lang='es') AS caption  FROM cms_addons a  WHERE a.cid=1") or $err = mysqli_error($CNN);
                        while ($r = mysqli_fetch_array($adondist)) {
                            if ($r['agregador'] < 1) {
                                if ($r['tipo'] == 0) {
                                    $class = "onclick='savchbox(1,{$r['id']},this.checked)' data-save='0'";
                                } else {
                                    $class = "onblur='sav_pit(1,{$r['id']},this.value,0)' data-save='0'";
                                }
                                if ($r['destino'] == 1) {
                                    $class2 = "onblur='sav_pit(1,{$r['id']},this.value,1)' data-save='0'";
                                }
                            } else {
                                $class = "";
                                $class2 = "";
                            }
                            ?>
                            <tr id="row_<?php echo $r['id'] ?>" data-save="0" style="border-bottom: 1px solid rgba(0,19,37,0.2);">
                                <td width="10%" style="vertical-align: top;">
                                    <div class="col-sm-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%; ">
                                        <b><?php echo $r['caption']; ?></b>
                                    </div>
                                </td>
                                <td>
                                    <table class="table-striped"  id='table_<?php echo $r['id']; ?>' width='90%' >
                                        <thead>
                                            <tr>
                                                <td width='20%'  id="in_<?php echo $r['id']; ?>">
                                                    <div class="form-group" >
                                                        <div class="input-group">
                                                            <?php
                                                            switch ($r['tipo']) {
                                                                case 0:
                                                                    ?><input type="checkbox" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?> value="1"><?php
                                                                    break;
                                                                case 1:
                                                                    ?>
                                                                    <input type="number" id='ova_<?php echo $r['id']; ?>_0'name="ova_<?php echo $r['id']; ?>_0"  class="form-control" <?php echo $class; ?> value="0" min="0">
                                                                    <?php
                                                                    break;
                                                                case 2:
                                                                    ?>
                                                                    <input type="text" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?> placeholder="texto" >
                                                                    <?php
                                                                    break;
                                                                case 3:
                                                                    ?><?php
                                                                    break;
                                                            }
                                                            ?>
                                                            <div class="input-group-addon text-uppercase">
                                                                <?php
                                                                echo $r['unidad'];
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td width='50%' style="vertical-align: top; " id="te_<?php echo $r['id']; ?>">
                                                    <?php
                                                    if ($r['destino'] == 1) {
                                                        ?>
                                                        <div class="form-group" >
                                                            <div class="col-sm-12">
                                                                <input type="text" id="textextra_<?php echo $r['id'] ?>_0" name="textextra_<?php echo $r['id'] ?>_0" <?php echo $class2; ?> class="form-control " placeholder="texto">
                                                            </div>
                                                        </div>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                                <td id="ba_<?php echo $r['id']; ?>" style="vertical-align: top; ">
                                                    <?php
                                                    if ($r['agregador'] >= 1) {
                                                        ?>
                                                        <a href="javascript:void(0)" onclick="clon_addon('<?php echo $r['id']; ?>', 1);" class="btn btn-default "><i class="fa fa-plus-circle "></i></a>
                                                        <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                            <?php
                        }
                        ?>
                    </table>
                </div>
                <div role="tabpanel" class="tab-pane" id="servicios" style="padding: 2%;">
                    <div class="row">
                        <div class="col-lg-4 text-uppercase" style="border-bottom: 2px solid; ">
                            <b>DETALLES DE ALOJAMIENTO</b>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-2 text-info">
                            <small><h3> Capacidad:</h3></small>
                        </div>
                        <small>
                            <h3>
                                <b>
                                    <div class="col-xs-1" id="capacity">
                                        0
                                    </div>
                                </b>
                                <input type="number" value="0" id="capacity_n" class="hidden">
                            </h3>
                        </small>
                    </div>
                    <table>
                        <tr>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big><b>Dormitorios:</b></big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-dorm"  name="rent-dorm" min="0" value="0"   class="form-control" onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big><b>Cama matrimonial:</b></big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-cmat"  name="sum[]" min="0" value="0"  class="form-control" data-val="2" onblur="savhou(this.id, this.value);capacity(this.id, this.value, 2);" />
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big><b>Cama individual:</b></big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-cindiv"  name="sum[]" min="0" value="0"  class="form-control" data-val="1" onblur="savhou(this.id, this.value);capacity(this.id, this.value, 1);" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big><b>Sofa cama Doble:</b></big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-sofcdoble"  name="sum[]" min="0" value="0"  class="form-control" data-val="2" onblur="savhou(this.id, this.value);capacity(this.id, this.value, 2);" />
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;"><big>
                                                <b>Sof&aacute; Cama individual:</b></big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-sofcind"  name="sum[]" min="0" value="0"  class="form-control" data-val="1" onblur="savhou(this.id, this.value);capacity(this.id, this.value, 1);" />
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"style="text-align: left;">
                                            <big>
                                                <b>Litera(s):</b>
                                            </big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-litera"  name="sum[]" min="0" value="0" class="form-control" data-val="2" onblur="savhou(this.id, this.value);capacity(this.id, this.value, 2);" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big>
                                                <b>Plegatin(es):</b>
                                            </big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-plegatines"  name="sum[]" min="0" value="0" class="form-control" data-val="1" onblur="savhou(this.id, this.value);capacity(this.id, this.value, 1);" />
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big>
                                                <b>Ba&ntilde;os:</b>
                                            </big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-bano" min="0" value="0" name="rent-bano"  class="form-control" onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big>
                                                <b>Con ba&ntilde;era:</b>
                                            </big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-cbanera" min="0" value="0"  name="rent-cbanera"  class="form-control" onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big>
                                                <b>Con ducha:</b>
                                            </big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-cducha"  name="rent-cducha" min="0" value="0"  class="form-control" onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </td>
                            <td width="15%">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon" style="text-align: left;">
                                            <big>
                                                <b>Aseos:</b>
                                            </big>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td>
                                <div class="form-group">
                                    <div class="input-group">
                                        <input type="number"  id="rent-aseos" min="0" value="0" name="rent-aseos"  class="form-control" onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <?php
                    $qry = "select * from cms_catalog where required=0 ";
                    $gc = mysqli_query($CNN, $qry)or $err = mysqli_error($CNN);

                    while ($log = mysqli_fetch_array($gc)) {
                        ?>
                        <div class="row">
                            <div class="col-lg-4 text-uppercase" style="border-bottom: 2px solid; ">
                                <b><?php echo $log['common']; ?></b>
                            </div>
                        </div>
                        <br>
                        <table width="100%"  class="table-responsive " cellspacing='0' >
                            <?php
                            $adondist = mysqli_query($CNN, "SELECT  a.*, (SELECT b.caption FROM cms_addon_translate b WHERE b.aid=a.id AND lang='es') AS caption  FROM cms_addons a  WHERE a.cid={$log['id']}") or $err = mysqli_error($CNN);
                            while ($r = mysqli_fetch_array($adondist)) {
                                if ($r['agregador'] < 1) {
                                    if ($r['tipo'] == 0) {
                                        $class = "onclick='savchbox({$log['id']},{$r['id']},this.checked)' data-save='0'";
                                    } else {
                                        $class = "onblur='sav_pit({$log['id']},{$r['id']},this.value,0)' data-save='0'";
                                    }
                                } else {
                                    $class = "";
                                    $class2 = "";
                                }
                                ?>
                                <tr id="row_<?php echo $r['id'] ?>" data-save="0">
                                    <td width="15%" style="vertical-align: top;">
                                        <?php if ($r['tipo'] > 0) { ?>
                                            <div class="col-sm-12 input-group-addon" style="text-align: left; min-width: 100%; ">
                                                <big><b>&nbsp;&nbsp;<?php echo strtoupper($r['caption']); ?></b></big>
                                            </div>
                                            <?php
                                        } else {
                                            ?>
                                            <table style="vertical-align: top;" width="100%">
                                                <tr style="vertical-align: top;">
                                                    <td width="1" align="left">
                                                        <div class="form-group" style="text-align: left;">
                                                            <div class="input-group" style="text-align: left;">
                                                                <div class="input-group-addon" style="text-align: left;">
                                                                    <big>  <input type="checkbox" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?>>&nbsp;</big>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group" >
                                                            <div class="input-group">
                                                                <div class="input-group-addon" style="text-align: left;">
                                                                    <big> <b><?php echo strtoupper($r['caption']); ?></b></big>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <table class="table-striped"  id='table_<?php echo $r['id']; ?>' width='90%' >
                                            <thead>
                                                <tr>
                                                    <td width='20%'  id="in_<?php echo $r['id']; ?>">
                                                        <div class="form-group" >
                                                            <div class="input-group">
                                                                <?php
                                                                switch ($r['tipo']) {
                                                                    case 1:
                                                                        ?>
                                                                        <input type="number" id='ova_<?php echo $r['id']; ?>_0'name="ova_<?php echo $r['id']; ?>_0"  class="form-control" <?php echo $class; ?> value="0" min="0">
                                                                        <?php
                                                                        break;
                                                                    case 2:
                                                                        ?>
                                                                        <input type="text" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?> placeholder="texto" >
                                                                        <?php
                                                                        break;
                                                                    case 3:
                                                                        ?><?php
                                                                        break;
                                                                }
                                                                if ($r['unidad'] != null) {
                                                                    ?>
                                                                    <div class="input-group-addon text-uppercase">
                                                                        <?php
                                                                        echo $r['unidad'];
                                                                        ?>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td width='50%' style="vertical-align: top; " id="te_<?php echo $r['id']; ?>">
                                                        <?php
                                                        if ($r['destino'] == 1) {
                                                            ?>
                                                            <div class="form-group" >
                                                                <div class="col-sm-12">
                                                                    <input type="text" id="textextra_<?php echo $r['id'] ?>_0" name="textextra_<?php echo $r['id'] ?>_0" <?php echo $class2; ?> class="form-control " placeholder="texto">
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td id="ba_<?php echo $r['id']; ?>" style="vertical-align: top; ">
                                                        <?php
                                                        if ($r['agregador'] >= 1) {
                                                            ?>
                                                            <a href="javascript:void(0)" onclick="clon_addon('<?php echo $r['id']; ?>', 1);" class="btn btn-default "><i class="fa fa-plus-circle "></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                        <?php
                    }
                    ?>
                </div>
                <div role="tabpanel" class="tab-pane" id="tarifas" style="padding: 1%;">
                    <div class="row">
                        <div class="col-lg-3">
                            <div class="form-group">
                                <div class="input-group">
                                    <div class="input-group-addon">
                                        <big><b>Fianza:$</b></big>
                                    </div>
                                    <input type="number" id="rent-fianza" name="rent-fianza" data-save="0" min="0" value="0"class="form-control " onblur="savhou(this.name, this.value);" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        <?php
        break;
    case 2:
        ?>
        (<small>Administrar</small>)
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td width="1">ID</td>
                    <td>Nombre</td>
                    <td>Titulo</td>
                    <td>HUTT</td>
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/property/property.table.php');
            });
        </script>
        <div class="modal fade" id="respuesta" name="respuesta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Respuesta</h4>
                    </div>
                    <div class="modal-body" id="content_e" name="content_e">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='from_del_hous' name='from_del_hous' method='POST' >
                            <input type="text" name="op" id="op" value="70" class="hidden"/>
                            <input type="text" name="house_id" id="house_id" class="hidden"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar?:</label>
                                <div id="texto" name="texto"></div>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" onclick="delhouse();">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="clonehouse" name="clonehouse" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Clonar</h4>
                    </div>
                    <div class="modal-body" id="clon_h" name="clon_h">
                        <form id='clonhouse' name='clonhouse' method='POST' >
                            <input type="text" name="op" id="op" value="76" class="hidden"/>
                            <input type="text" name="clonid" id="clonid" value="" class="hidden"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea clonar esta propiedad?:</label>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-warning" onclick="actionclon();">Clonar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 3:
        ?><small>Editar</small><?php
        $id = $_REQUEST["id"];
        $mpid = $id;
        $getinfo = "select * from cms_property where id=$id";
        $gf = mysqli_query($CNN, $getinfo) or $e = "ERROR #0: Error al traer los datos de la casa<br>consulte a su administrador<br>" . mysqli_error($CNN);
        $exis = mysqli_num_rows($gf);
        if ($exis > 0) {
            if (!isset($e)) {
                $ar = array();
                while ($ai = mysqli_fetch_array($gf)) {
                    $arr = $ai;
                }
                ?>
                <div role="tabpanel">
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" class="active"><a href="#descripcion" aria-controls="Descripcion" role="tab" data-toggle="tab">DESCRIPCION</a></li>
                        <li role="presentation" class=""><a href="#ubicacion" aria-controls="Ubicacion" role="tab" onclick="mapadire();" data-toggle="tab">UBICACION</a></li>
                        <li role="presentation" class=""><a href="#servicios" aria-controls="Servicios" role="tab" data-toggle="tab">SERVICIOS</a></li>
                        <li role="presentation" class=""><a href="#tarifas" aria-controls="Tarifas" role="tab" data-toggle="tab">TARIFAS</a></li>
                        <li role="presentation" class=""><a href="#ofertas" aria-controls="Ofertas" role="tab" data-toggle="tab">OFERTAS</a></li>
                    </ul>
                </div>
                <!-- Tab panes -->
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane active" id="descripcion" style="padding: 1%;">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>Nombre:</b></div>
                                        <input type="text" id="rent-name" value="<?php echo $arr['name']; ?>" name="rent-name" data-save="1" data-pid="<?php echo $id ?>" class="form-control " onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>Titulo:</b></div>
                                        <input type="text"  id="rent-title"  name="rent-title" value="<?php echo $arr['title']; ?>" class="form-control " onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>Modo:</b></div>
                                        <select id="rent-modo" name="rent-modo" class="form-control  " onblur="savhou(this.name, this.value);">
                                            <option value="0" <?php
                                            if ($arr['modo'] == 0) {
                                                echo "selected";
                                            }
                                            ?>>Alquiler</option>
                                            <option value="1" <?php
                                            if ($arr['modo'] == 1) {
                                                echo "selected";
                                            }
                                            ?>>Gestion</option>
                                            <option value="2" <?php
                                            if ($arr['modo'] == 2) {
                                                echo "selected";
                                            }
                                            ?>>Venta</option>
                                            <option value="3" <?php
                                            if ($arr['modo'] == 3) {
                                                echo "selected";
                                            }
                                            ?>>Traspaso</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>Link:</b></div>
                                        <input type="text" id="rent-link" value="<?php echo $arr['link']; ?>" name="rent-link" class="form-control " onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>HUTT:</b></div>
                                        <input type="text"  id="rent-hutt" value="<?php echo $arr['hutt']; ?>" name="rent-hutt" class="form-control " onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>Tipo:</b></div>
                                        <select id="rent-tipo" name="rent-tipo" class="form-control " onblur="savhou(this.name, this.value);">
                                            <option disabled selected>Selecciona...</option>
                                            <?php
                                            $doq = mysqli_query($CNN, "select * from cms_property_type");
                                            while ($t = mysqli_fetch_array($doq)) {
                                                ?>
                                                <option value="<?php echo $t['id']; ?>" <?php
                                                if ($arr['tipo'] == $t['id']) {
                                                    echo "selected";
                                                }
                                                ?>><?php echo $t['name']; ?></option>
                                                        <?php
                                                    }
                                                    ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon"><b>Superficie(m2):</b></div>
                                        <input type="number" min="0" value="<?php echo $arr['metros']; ?>"  id="rent-metros" name="rent-metros" class="form-control " onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div>
                                            <ul class="nav nav-tabs" role="tablist">
                                                <?php
                                                foreach ($language as $L) {
                                                    ?>
                                                    <li role="presentation" class="<?php
                                                    if ($L == "es") {
                                                        echo "active";
                                                    }
                                                    ?>">
                                                        <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab" class="text-capitalize">
                                                            <?php echo $L; ?>
                                                            <?php if ($L == "es") { ?>
                                                                <span class="label label-danger">Requerido</span>
                                                                <?php
                                                            }
                                                            ?>
                                                        </a>
                                                    </li>
                                                    <?php
                                                }
                                                ?>
                                            </ul>
                                            <div class="tab-content">
                                                <?php
                                                foreach ($language as $L) {
                                                    ?>
                                                    <div role="tabpanel"style="padding:0%;" class="tab-pane  <?php
                                                    if ($L == "es") {
                                                        echo "active";
                                                    }
                                                    ?> " id="tab_<?php echo $L; ?>">
                                                        <br>
                                                        <div class="row ">
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">Descripci&oacute;n Corta<small><?php echo "(" . $L . ")"; ?></small></div>
                                                                        <input type="text"  value="<?php
                                                                        $vs = getData3("cms_property_translate", 'pid', $id, 'cname', 'rent-short', 'lang', $L, 'caption');
                                                                        echo $vs;
                                                                        $sid = getData3("cms_property_translate", 'pid', $id, 'cname', 'rent-short', 'lang', $L, 'id');
                                                                        ?>" data-save="<?php
                                                                               if ($sid != null) {
                                                                                   echo $sid;
                                                                               } else {
                                                                                   echo '0';
                                                                               }
                                                                               ?>" id="rent-short_<?php echo $L; ?>" name="rent-short_<?php echo $L; ?>" size="200" class="form-control " onblur="saveshort(this.name, this.value);"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12">
                                                                <div class="form-group">
                                                                    <div class="input-group">
                                                                        <div class="input-group-addon">Descripci&oacute;n Larga<small><?php echo "(" . $L . ")"; ?></small></div>
                                                                    </div>
                                                                </div>
                                                                <?php
                                                                $vl = getData3("cms_property_translate", 'pid', $id, 'cname', 'rent-large', 'lang', $L, 'caption');
                                                                $lid = getData3("cms_property_translate", 'pid', $id, 'cname', 'rent-large', 'lang', $L, 'id');
                                                                ?>
                                                                <textarea type="text" id="rent-large_<?php echo $L; ?>" name="rent-large_<?php echo $L; ?>" data-save="<?php
                                                                if ($lid > 0) {
                                                                    echo $lid;
                                                                } else {
                                                                    echo '0';
                                                                }
                                                                ?>" rows="6" cols="100%" class="form-control" onblur="saveshort(this.name, this.value);" /><?php echo $vl; ?></textarea>
                                                                <input id="data-rent-large_<?php echo $L; ?>" name="data-rent-large_<?php echo $L; ?>" class="hidden" type="text">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!----UBICACION---->
                    <div role="tabpanel" class="tab-pane" id="ubicacion" style="padding: 1%;">
                        <div class="row">
                            <div class="col-lg-6">
                                <table class="table-responsive table-hover"  width="100%">
                                    <tr>
                                        <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                            <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                                <big> <b>Direcci&oacute;n:</b></big>
                                            </div>
                                        </td>
                                        <td style="padding-top:2%;padding-bottom: 2%;">
                                            <input type="text" id="rent-address" value="<?php echo $arr['address']; ?>" name="rent-address" class="form-control" onblur="savhou(this.name, this.value);mapadire();"/>
                                            <input type="text" id="dirho_num" value="0" class="hidden">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                            <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                                <big> <b>Provincia:</b></big>
                                            </div>
                                        </td>
                                        <td style="padding-top: 2%; padding-bottom: 2%;">
                                            <select id="rent-provincia" name="rent-provincia" class="form-control"  onblur="savhou(this.name, this.value);mapadire();">
                                                <option disabled selected>Selecciona..</option>
                                                <?php
                                                $aqry = "select * from cms_property_locale where tipo=1 ";
                                                $L = mysqli_query($CNN, $aqry)or $err = mysqli_error($CNN);
                                                while ($pr = mysqli_fetch_array($L)) {
                                                    ?><option value="<?php echo $pr['id']; ?>"<?php
                                                    if ($arr['provincia'] == $pr['id']) {
                                                        echo "selected";
                                                    }
                                                    ?> ><?php echo strtoupper($pr['name']); ?></option><?php
                                                        }
                                                        ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                            <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                                <big> <b>Localidad:</b></big>
                                            </div>
                                        </td>
                                        <td style="padding-top: 2%; padding-bottom: 2%;">
                                            <select  id="rent-localidad" name="rent-localidad" class="form-control " onblur="savhou(this.name, this.value);mapadire();">
                                                <option disabled selected>Selecciona..</option>
                                                <?php
                                                $aqry = "select * from cms_property_locale where tipo=2 ";
                                                $L = mysqli_query($CNN, $aqry)or $err = mysqli_error($CNN);
                                                while ($pr = mysqli_fetch_array($L)) {
                                                    ?><option value="<?php echo $pr['id']; ?>"<?php
                                                    if ($arr['localidad'] == $pr['id']) {
                                                        echo "selected";
                                                    }
                                                    ?> ><?php echo strtoupper($pr['name']); ?></option><?php
                                                        }
                                                        ?>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td width="30%" style="padding-top: 2%; padding-bottom: 2%;">
                                            <div class="col-lg-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%">
                                                <big> <b>Zona:</b></big>
                                            </div>
                                        </td>
                                        <td style="padding-top: 2%; padding-bottom: 2%;">
                                            <select id="rent-zona" name="rent-zona"class="form-control " onblur="savhou(this.name, this.value);mapadire();">
                                                <option disabled selected>Selecciona..</option>
                                                <?php
                                                $aqry = "select * from cms_property_locale where tipo=3 ";
                                                $L = mysqli_query($CNN, $aqry)or $err = mysqli_error($CNN);
                                                while ($pr = mysqli_fetch_array($L)) {
                                                    ?><option value="<?php echo $pr['id']; ?>"<?php
                                                    if ($arr['zona'] == $pr['id']) {
                                                        echo "selected";
                                                    }
                                                    ?> ><?php echo strtoupper($pr['name']); ?></option><?php
                                                        }
                                                        ?>
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-lg-6">
                                <div id="test" class="gmap3"></div>
                                <input type="text" id="lat"  value="<?php echo $arr['lat']; ?>" class="hidden"><!--latitud-->
                                <input type="text" id="long"  value="<?php echo $arr['longi']; ?>" class="hidden" ><!---Longitud-->
                            </div>
                        </div>
                        <script>
                            $(document).ready(function () {
                                // Parametros para el combo
                                $("#rent-provincia").change(function () {
                                    $("#rent-provincia option:selected").each(function () {
                                        elegido = $(this).val();
                                        $.post("./include/modules/property/locale.action.php", {elegido: elegido}, function (data) {
                                            $("#rent-localidad").html(data);
                                        });
                                    });
                                });
                                $("#rent-localidad").change(function () {
                                    $("#rent-localidad option:selected").each(function () {
                                        elegido = $(this).val();
                                        $.post("./include/modules/property/locale.action.php", {elegido: elegido}, function (data) {
                                            $("#rent-zona").html(data);
                                        });
                                    });
                                });
                            });
                        </script>
                        <div class="row">
                            <div class="col-lg-4" style="border-bottom: 2px solid; ">
                                <b>DISTANCIAS</b>
                            </div>
                        </div>
                        <br>
                        <table width="100%" cellspacing='0' >
                            <?php
                            $adondist = mysqli_query($CNN, "SELECT  a.*, (SELECT b.caption FROM cms_addon_translate b WHERE b.aid=a.id AND lang='es') AS caption  FROM cms_addons a  WHERE a.cid=1") or $err = mysqli_error($CNN);
                            while ($r = mysqli_fetch_array($adondist)) {
                                if ($r['agregador'] < 1) {
                                    if ($r['tipo'] == 0) {
                                        $class = "onclick='savchbox(1,{$r['id']},this.checked)' data-save='0'";
                                    } else {
                                        $class = "onblur='sav_pit(1,{$r['id']},this.value,0)' data-save='0'";
                                    }
                                    if ($r['destino'] == 1) {
                                        $class2 = "onblur='sav_pit(1,{$r['id']},this.value,1)' data-save='0'";
                                    }
                                } else {
                                    $class = "";
                                    $class2 = "";
                                }
                                $val = getData3("cms_property_addons", "pid", $id, "cid", 1, 'aid', $r['id'], 'ovalue');
                                $textra = getData3("cms_property_addons", "pid", $id, "cid", 1, 'aid', $r['id'], 'dest');
                                $myid = getData3("cms_property_addons", "pid", $id, "cid", 1, 'aid', $r['id'], 'id');
                                $saved = 0;
                                if ($val != null) {
                                    $saved = $myid;
                                }
                                else
                                {
                                    $val=null;
                                }
                                $ppos = strpos($textra, '|');
                                if (($ppos < 1) && ($r['agregador'] < 1)) {
                                    $vlu = $val;
                                    $txtr = $textra;
                                } else {
                                    $vlu = "";
                                    $txtr = "";
                                }
                                ?>
                                <tr id="row_<?php echo $r['id'] ?>" data-save="<?php echo $saved; ?>" style="border-bottom: 1px solid rgba(0,19,37,0.2);">
                                    <td width="10%" style="vertical-align: top;">
                                        <div class="col-sm-12 input-group-addon text-uppercase" style="text-align: left; min-width: 100%; ">
                                            <b><?php echo $r['caption']; ?></b>
                                        </div>
                                    </td>
                                    <td>
                                        <table class="table-striped"  id='table_<?php echo $r['id']; ?>' width='90%' >
                                            <thead>
                                                <tr>
                                                    <td width='20%'  id="in_<?php echo $r['id']; ?>">
                                                        <div class="form-group" >
                                                            <div class="input-group">
                                                                <?php
                                                                switch ($r['tipo']) {
                                                                    case 0:
                                                                        ?><input type="checkbox" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?> value="1"
                                                                        <?php
                                                                        if ($vlu != null) {
                                                                            echo "selected";
                                                                        }
                                                                        ?>><?php
                                                                               break;
                                                                           case 1:
                                                                               ?>
                                                                        <input type="number" value="<?php echo $vlu; ?>" id='ova_<?php echo $r['id']; ?>_0'name="ova_<?php echo $r['id']; ?>_0"  class="form-control" <?php echo $class; ?> min="0">
                                                                        <?php
                                                                        break;
                                                                    case 2:
                                                                        ?>
                                                                        <input type="text" value="<?php echo $vlu; ?>" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?> placeholder="texto" >
                                                                        <?php
                                                                        break;
                                                                    case 3:
                                                                        ?><?php
                                                                        break;
                                                                }
                                                                ?>
                                                                <div class="input-group-addon text-uppercase">
                                                                    <?php
                                                                    echo $r['unidad'];
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td width='50%' style="vertical-align: top; " id="te_<?php echo $r['id']; ?>">
                                                        <?php
                                                        if ($r['destino'] == 1) {
                                                            ?>
                                                            <div class="form-group" >
                                                                <div class="col-sm-12">
                                                                    <input type="text" value="<?php echo $txtr; ?>" id="textextra_<?php echo $r['id'] ?>_0" name="textextra_<?php echo $r['id'] ?>_0" <?php echo $class2; ?> class="form-control " placeholder="texto">
                                                                </div>
                                                            </div>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                    <td id="ba_<?php echo $r['id']; ?>" style="vertical-align: top; ">
                                                        <?php
                                                        if ($r['agregador'] >= 1) {
                                                            ?>
                                                            <a href="javascript:void(0)" onclick="clon_addon('<?php echo $r['id']; ?>', 1);" class="btn btn-default "><i class="fa fa-plus-circle "></i></a>
                                                            <?php
                                                        }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if ($vlu == "" && $txtr == "") {
                                                    if($val!=null && $textra!=null)
                                                    {
                                                    $varr = explode("|", $val);
                                                    $txarr = explode("|", $textra);
                                                        for ($k = 0; $k < count($varr); $k++) {
                                                            ?>
                                                            <tr id="hij_<?php echo $r['id'] . '_' . ($k + 1); ?>">
                                                                <td style="padding-top:0%;">
                                                                    <div class="form-group" >
                                                                        <div class="input-group">
                                                                            <?php
                                                                            switch ($r['tipo']) {
                                                                                case 0:
                                                                                    ?><input type="checkbox" data-inpt="<?php echo $r['id']; ?>" id='ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>' name="ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>" class="form-control" <?php echo $class; ?> value="1"
                                                                                    <?php
                                                                                    if ($varr[$k] != null) {
                                                                                        echo "selected";
                                                                                    }
                                                                                    ?>><?php
                                                                                           break;
                                                                                       case 1:
                                                                                           ?>
                                                                                    <input type="number" onblur="bluradon(<?php echo $r["id"]; ?>)" data-inpt="<?php echo $r['id']; ?>" value="<?php echo $varr[$k]; ?>" id='ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>'name="ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>"  class="form-control" <?php echo $class; ?> min="0">
                                                                                    <?php
                                                                                    break;
                                                                                case 2:
                                                                                    ?>
                                                                                    <input type="text" onblur="bluradon(<?php echo $r["id"]; ?>)" data-inpt="<?php echo $r['id']; ?>" value="<?php echo strtoupper($varr[$k]); ?>" id='ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?> ' name="ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?> " class="form-control" <?php echo $class; ?> placeholder="texto" >
                                                                                    <?php
                                                                                    break;
                                                                                case 3:
                                                                                    ?><?php
                                                                                    break;
                                                                            }
                                                                            ?>
                                                                            <div class="input-group-addon text-uppercase">
                                                                                <?php
                                                                                echo $r['unidad'];
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($r['destino'] == 1) {
                                                                        ?>
                                                                        <div class="form-group" >
                                                                            <div class="col-sm-12">
                                                                                <input type="text" onblur="bluradon(<?php echo $r["id"]; ?>)" value="<?php echo strtoupper($txarr[$k]); ?>" data-txt="<?php echo $r['id']; ?>" id="textextra_<?php echo $r['id'] ?>_<?php echo $k + 1; ?>" name="textextra_<?php echo $r['id'] ?>_<?php echo $k + 1; ?>" <?php echo $class2; ?> class="form-control " placeholder="texto">
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-warning " onclick="delrowclon(<?php echo $r['id'] . "," . ($k + 1); ?>);" href="javascript:void(0)">
                                                                        <i class="fa fa-remove "></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>
                        </table>
                    </div>
                    <!-----SERVICIOS----->
                    <div role="tabpanel" class="tab-pane" id="servicios" style="padding: 2%;">
                        <div class="row">
                            <div class="col-lg-4 text-uppercase" style="border-bottom: 2px solid; ">
                                <b>DETALLES DE ALOJAMIENTO</b>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-xs-2 text-info">
                                <small><h3> Capacidad:</h3></small>
                            </div>
                            <small>
                                <h3>
                                    <b>
                                        <div class="col-xs-1" id="capacity">
                                            <?php echo $arr['capacity']; ?>
                                        </div>
                                    </b>
                                    <input type="number" value="<?php echo $arr['capacity']; ?>" id="capacity_n" class="hidden">
                                </h3>
                            </small>
                        </div>
                        <table>
                            <tr>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big><b>Dormitorios:</b></big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-dorm"  name="rent-dorm" min="0"   value="<?php echo $arr['dorm']; ?>"   class="form-control" onblur="savhou(this.name, this.value);" />
                                        </div>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big><b>Cama matrimonial:</b></big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-cmat"  name="sum[]" min="0" value="<?php echo $arr['cmat']; ?>"  class="form-control" data-val="2" onblur="savhou(this.id, this.value);capacity(this.id, this.value, 2);" />
                                        </div>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big><b>Cama individual:</b></big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-cindiv"  name="sum[]" min="0" value="<?php echo $arr['cindiv']; ?>"  class="form-control" data-val="1" onblur="savhou(this.id, this.value);
                                                                    capacity(this.id, this.value, 1);" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big><b>Sofa cama Doble:</b></big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-sofcdoble"  name="sum[]" min="0" value="<?php echo $arr['sofcdoble']; ?>"  class="form-control" data-val="2" onblur="savhou(this.id, this.value);
                                                                    capacity(this.id, this.value, 2);" />
                                        </div>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;"><big>
                                                    <b>Sof&aacute; Cama individual:</b></big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-sofcind"  name="sum[]" min="0"value="<?php echo $arr['sofcind']; ?>"  class="form-control" data-val="1" onblur="savhou(this.id, this.value);
                                                                    capacity(this.id, this.value, 1);" />
                                        </div>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon"style="text-align: left;">
                                                <big>
                                                    <b>Litera(s):</b>
                                                </big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-litera"  name="sum[]" min="0" value="<?php echo $arr['litera']; ?>" class="form-control" data-val="2" onblur="savhou(this.id, this.value);
                                                                    capacity(this.id, this.value, 2);" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big>
                                                    <b>Plegatin(es):</b>
                                                </big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-plegatines"  name="sum[]" min="0" value="<?php echo $arr['plegatines']; ?>" class="form-control" data-val="1" onblur="savhou(this.id, this.value);
                                                                    capacity(this.id, this.value, 1);" />
                                        </div>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big>
                                                    <b>Ba&ntilde;os:</b>
                                                </big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-bano" min="0" value="<?php echo $arr['bano']; ?>" name="rent-bano"  class="form-control" onblur="savhou(this.name, this.value);" />
                                        </div>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big>
                                                    <b>Con ba&ntilde;era:</b>
                                                </big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-cbanera" min="0" value="<?php echo $arr['cbanera']; ?>"  name="rent-cbanera"  class="form-control" onblur="savhou(this.name, this.value);" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big>
                                                    <b>Con ducha:</b>
                                                </big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-cducha"  name="rent-cducha" min="0" value="<?php echo $arr['cducha']; ?>"  class="form-control" onblur="savhou(this.name, this.value);" />
                                        </div>
                                    </div>
                                </td>
                                <td width="15%">
                                    <div class="form-group">
                                        <div class="input-group">
                                            <div class="input-group-addon" style="text-align: left;">
                                                <big>
                                                    <b>Aseos:</b>
                                                </big>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div class="form-group">
                                        <div class="input-group">
                                            <input type="number"  id="rent-aseos" min="0" value="<?php echo $arr['aseos']; ?>" name="rent-aseos"  class="form-control" onblur="savhou(this.name, this.value);" />
                                        </div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        <?php
                        $qry = "select * from cms_catalog where required=0 ";
                        $gc = mysqli_query($CNN, $qry)or $err = mysqli_error($CNN);
                        while ($log = mysqli_fetch_array($gc)) {
                            ?>
                            <div class="row">
                                <div class="col-lg-4 text-uppercase" style="border-bottom: 2px solid; ">
                                    <b><?php echo $log['common']; ?></b>
                                </div>
                            </div>
                            <br>
                            <table width="100%"  class="table-responsive " cellspacing='0' >
                                <?php
                                $adondist = mysqli_query($CNN, "SELECT  a.*, (SELECT b.caption FROM cms_addon_translate b WHERE b.aid=a.id AND lang='es') AS caption  FROM cms_addons a  WHERE a.cid={$log['id']}") or $err = mysqli_error($CNN);
                                while ($r = mysqli_fetch_array($adondist)) {
                                    if ($r['agregador'] < 1) {
                                        if ($r['tipo'] == 0) {
                                            $class = "onclick='savchbox({$log['id']},{$r['id']},this.checked)' ";
                                        } else {
                                            $class = "onblur='sav_pit({$log['id']},{$r['id']},this.value,0)'";
                                        }
                                    } else {
                                        $class = "";
                                        $class2 = "";
                                    }
                                    $val = getData3("cms_property_addons", "pid", $id, "cid", $log['id'], 'aid', $r['id'], 'ovalue');
                                    $textra = getData3("cms_property_addons", "pid", $id, "cid", $log['id'], 'aid', $r['id'], 'dest');
                                    $myid = getData3("cms_property_addons", "pid", $id, "cid", $log['id'], 'aid', $r['id'], 'id');
                                    $saved = 0;
                                    if ($myid != null) {
                                        $saved = $myid;
                                    }
                                    $ppos = strpos($textra, '|');
                                    if (($ppos < 1) && ($r['agregador'] < 1)) {
                                        $vlu = $val;
                                        $txtr = $textra;
                                    } else {
                                        $vlu = "";
                                        $txtr = "";
                                    }
                                    ?>
                                    <tr id="row_<?php echo $r['id'] ?>" data-save="0">
                                        <td width="15%" style="vertical-align: top;">
                                            <?php if ($r['tipo'] > 0) { ?>
                                                <div class="col-sm-12 input-group-addon" style="text-align: left; min-width: 100%; ">
                                                    <big><b>&nbsp;&nbsp;<?php echo strtoupper($r['caption']); ?></b></big>
                                                </div>
                                                <?php
                                            } else {
                                                ?>
                                                <table style="vertical-align: top;" width="100%">
                                                    <tr style="vertical-align: top;">
                                                        <td width="1" align="left">
                                                            <div class="form-group" style="text-align: left;">
                                                                <div class="input-group" style="text-align: left;">
                                                                    <div class="input-group-addon" style="text-align: left;">
                                                                        <big><input type="checkbox" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?>
                                                                            <?php
                                                                            if ($saved > 0) {
                                                                                echo "checked data-save='1'";
                                                                            } else {
                                                                                echo "data-save='0'";
                                                                            }
                                                                            ?>
                                                                                    >&nbsp;</big>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group" >
                                                                <div class="input-group">
                                                                    <div class="input-group-addon" style="text-align: left;">
                                                                        <big> <b><?php echo strtoupper($r['caption']); ?></b></big>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                </table>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                        <td>
                                            <table class="table-striped"  id='table_<?php echo $r['id']; ?>' width='90%' >
                                                <thead>
                                                    <tr>
                                                        <td width='20%'  id="in_<?php echo $r['id']; ?>">
                                                            <div class="form-group" >
                                                                <div class="input-group">
                                                                    <?php
                                                                    switch ($r['tipo']) {
                                                                        case 1:
                                                                            ?>
                                                                            <input type="number" id='ova_<?php echo $r['id']; ?>_0'name="ova_<?php echo $r['id']; ?>_0"  class="form-control" <?php echo $class; ?> value="<?php echo $vlu; ?>" min="0">
                                                                            <?php
                                                                            break;
                                                                        case 2:
                                                                            ?>
                                                                            <input type="text" id='ova_<?php echo $r['id']; ?>_0' name="ova_<?php echo $r['id']; ?>_0" class="form-control" <?php echo $class; ?> value="<?php echo $vlu; ?>" placeholder="texto" >
                                                                            <?php
                                                                            break;
                                                                        case 3:
                                                                            ?><?php
                                                                            break;
                                                                    }
                                                                    if ($r['unidad'] != null) {
                                                                        ?>
                                                                        <div class="input-group-addon text-uppercase">
                                                                            <?php
                                                                            echo $r['unidad'];
                                                                            ?>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td width='50%' style="vertical-align: top; " id="te_<?php echo $r['id']; ?>">
                                                            <?php
                                                            if ($r['destino'] == 1) {
                                                                ?>
                                                                <div class="form-group" >
                                                                    <div class="col-sm-12">
                                                                        <input type="text" id="textextra_<?php echo $r['id'] ?>_0" name="textextra_<?php echo $r['id'] ?>_0" <?php echo $class2; ?> class="form-control" value="<?php echo $txtr; ?>" placeholder="texto">
                                                                    </div>
                                                                </div>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                        <td id="ba_<?php echo $r['id']; ?>" style="vertical-align: top; ">
                                                            <?php
                                                            if ($r['agregador'] >= 1) {
                                                                ?>
                                                                <a href="javascript:void(0)" onclick="clon_addon('<?php echo $r['id']; ?>', 1);" class="btn btn-default "><i class="fa fa-plus-circle "></i></a>
                                                                <?php
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                    <?php
                                                    if ($vlu == "" && $txtr == "" && $r['tipo'] != 0) {
                                                        $varr = explode("|", $val);
                                                        $txarr = explode("|", $textra);
                                                        for ($k = 0; $k < count($varr); $k++) {
                                                            ?>
                                                            <tr id="hij_<?php echo $r['id'] . '_' . $k; ?>">
                                                                <td style="padding-top:0%;">
                                                                    <div class="form-group" >
                                                                        <div class="input-group">
                                                                            <?php
                                                                            switch ($r['tipo']) {
                                                                                case 0:
                                                                                    ?><input type="checkbox" data-inpt="<?php echo $r['id']; ?>" id='ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>' name="ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>" class="form-control" <?php echo $class; ?> value="1"
                                                                                    <?php
                                                                                    if ($varr[$k] != null) {
                                                                                        echo "selected";
                                                                                    }
                                                                                    ?>><?php
                                                                                           break;
                                                                                       case 1:
                                                                                           ?>
                                                                                    <input type="number" data-inpt="<?php echo $r['id']; ?>" value="<?php echo $varr[$k]; ?>" id='ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>'name="ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?>"  class="form-control" <?php echo $class; ?> min="0">
                                                                                    <?php
                                                                                    break;
                                                                                case 2:
                                                                                    ?>
                                                                                    <input type="text" data-inpt="<?php echo $r['id']; ?>" value="<?php echo strtoupper($varr[$k]); ?>" id='ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?> ' name="ova_<?php echo $r['id']; ?>_<?php echo $k + 1; ?> " class="form-control" <?php echo $class; ?> placeholder="texto" >
                                                                                    <?php
                                                                                    break;
                                                                                case 3:
                                                                                    ?><?php
                                                                                    break;
                                                                            }
                                                                            ?>
                                                                            <div class="input-group-addon text-uppercase">
                                                                                <?php
                                                                                echo $r['unidad'];
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                <td>
                                                                    <?php
                                                                    if ($r['destino'] == 1) {
                                                                        ?>
                                                                        <div class="form-group" >
                                                                            <div class="col-sm-12">
                                                                                <input type="text" value="<?php echo strtoupper($txarr[$k]); ?>" data-txt="<?php echo $r['id']; ?>" id="textextra_<?php echo $r['id'] ?>_<?php echo $k + 1; ?>" name="textextra_<?php echo $r['id'] ?>_<?php echo $k + 1; ?>" <?php echo $class2; ?> class="form-control " placeholder="texto">
                                                                            </div>
                                                                        </div>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </td>
                                                                <td>
                                                                    <a class="btn btn-warning " onclick="delrowclon(<?php echo $r['id'] . "," . $k + 1; ?>);" href="javascript:void(0)">
                                                                        <i class="fa fa-remove "></i>
                                                                    </a>
                                                                </td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </table>
                            <?php
                        }
                        ?>
                    </div>
                    <!----TARIFAS--->
                    <div role="tabpanel" class="tab-pane" id="tarifas" style="padding: 2%;">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <big><b>Fianza:$</b></big>
                                        </div>
                                        <input type="number" id="rent-fianza" name="rent-fianza" data-save="1" min="0" value="<?php echo $arr['fianza']; ?>"class="form-control " onblur="savhou(this.name, this.value);" />
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php
                        $gett = "select * from crs_rates_use where pid=$mpid";
                        $G = mysqli_query($CNN, $gett)or $err = "Error al consultar las tarifas" . mysqli_error($CNN);
                        if (!isset($err)) {
                            while ($ra = mysqli_fetch_array($G)) {
                                ?>
                                <div class="row">
                                    <div class="col-lg-12 text-uppercase text-info">
                                        <big><b>tarifa:
                                                <?php
                                                echo getData('crs_rates', "id", $ra['rid'], "name");
                                                ?>
                                            </b></big>
                                    </div>
                                </div>
                                <div class="row text-uppercase" style="font-weight: bold;" >
                                    <div class="col-xs-offset-1" style="border-bottom: 0px solid #cccccc;">&nbsp;</div>
                                    <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                        Desde
                                    </div>
                                    <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                        Hasta
                                    </div>
                                    <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;text-align: right;">
                                        Diario
                                    </div>
                                    <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;text-align: right;">
                                        semanal
                                    </div>
                                    <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;text-align: right;">
                                        Entrada
                                    </div>
                                    <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;text-align: right;">
                                        Salida
                                    </div>
                                </div>
                                <?php
                                $gtd = "select * from crs_rates_detail where rid={$ra['rid']}";
                                $TA = mysqli_query($CNN, $gtd) or $err = "Error al traer los detalles de la tarifa" . mysqli_error($CNN);
                                $nt = mysqli_num_rows($TA);
                                if ($nt > 0) {
                                    if (!isset($err)) {
                                        while ($fa = mysqli_fetch_array($TA)) {
                                            ?>
                                            <div class="row" style="text-align: right;">
                                                <div class="col-xs-offset-1" style="border-bottom: 0px solid #cccccc;">&nbsp</div>
                                                <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                                    <?php echo date("d", strtotime($fa['date_ini'])) . "-" . $mes[(int) date("m", strtotime($fa['date_ini']))] . "-" . date("Y", strtotime($fa['date_ini'])); ?>
                                                </div>
                                                <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                                    <?php echo date("d", strtotime($fa['date_end'])) . "-" . $mes[(int) date("m", strtotime($fa['date_end']))] . "-" . date("Y", strtotime($fa['date_end'])); ?>
                                                </div>
                                                <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                                    $<?php echo number_format($fa['diario'], 2); ?>
                                                </div>
                                                <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                                    $<?php echo number_format($fa['semanal'], 2); ?>
                                                </div>
                                                <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                                    <?php  if($fa['checkin']>0){ echo $semana[$fa['checkin']];}else{ echo "N/A";} ?>
                                                </div>
                                                <div class="col-sm-1" style="border-bottom: 1px solid #cccccc;">
                                                    <?php  if($fa['checkout']>0){ echo $semana[$fa['checkout']];}else{ echo "N/A";} ?>
                                                </div>
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="col-lg-5 alert-info">
                                            <?php echo $err; ?>
                                        </div>
                                        <?php
                                    }
                                    ?>
                                    <?php
                                } else {
                                    ?>
                                    <div class="col-lg-5 alert-info">
                                        NO SE DETALLES DE LA TARIFA
                                    </div>
                                    <?php
                                }
                                ?>
                                <?php
                            }
                        } else {
                            echo $err;
                        }
                        ?>
                    </div>
                    <!----OFERTAS----->
                    <div role="tabpanel" class="tab-pane" id="ofertas" style="padding: 2%;">
                        <?php
                        $geofe = "select * from crs_offer_use where pid=$mpid";
                        $G = mysqli_query($CNN, $geofe)or $err = "Error al consultar las tarifas" . mysqli_error($CNN);
                        $nuo = mysqli_num_rows($G);
                        if ($nuo > 0) {
                            if (!isset($err)) {
                                while ($of = mysqli_fetch_array($G)) {
                                    $gof = "select * from crs_offer where id={$of['idof']}";
                                    $OF = mysqli_query($CNN, $gof) or $err = "Error al traer los detalles de la oferta" . mysqli_error($CNN);
                                    if (!isset($err)) {
                                        $noo = mysqli_num_rows($OF);
                                        if ($noo > 0) {
                                            while ($fe = mysqli_fetch_array($OF)) {
                                                ?>
                                                <div class="container bg-success">
                                                    <div class="row">
                                                        <div class="col-lg-4 text-uppercase text-info" style="font-weight: bold;font-size:14px;  border-bottom:2px #149bdf solid;">
                                                            <big><b>tarifa:<?php echo $fe['name']; ?></b></big>
                                                        </div>
                                                    </div>
                                                    <div class="row text-uppercase" style="font-size:14px;">
                                                        <div class="col-xs-offset-3"></div>
                                                        <div class="col-xs-2"  style="font-weight: bold; border-bottom: 1px #fafafa solid;">
                                                            desde
                                                        </div>
                                                        <div class="col-xs-2"  style="font-weight: bold; border-bottom: 1px #fafafa solid;">
                                                            hasta
                                                        </div>
                                                        <div class="col-xs-2"  style="font-weight: bold; border-bottom: 1px #fafafa solid;">
                                                            Descuento/porcentaje
                                                        </div>
                                                    </div>
                                                    <div class="row" style="font-size:14px;">
                                                        <div class="col-xs-offset-3"></div>
                                                        <div class="col-xs-2"  style="font-weight: bold; border-bottom: 1px solid #cccccc;">
                                                            <?php echo date("d", strtotime($fe['date_ini'])) . "-" . $mes[(int) date("m", strtotime($fe['date_ini']))] . "-" . date("Y", strtotime($fe['date_ini'])); ?>
                                                        </div>
                                                        <div class="col-xs-2" style="font-weight: bold; border-bottom: 1px solid #cccccc;">
                                                            <?php echo date("d", strtotime($fe['date_end'])) . "-" . $mes[(int) date("m", strtotime($fe['date_end']))] . "-" . date("Y", strtotime($fe['date_end'])); ?>
                                                        </div>
                                                        <div class="col-xs-2 text-center" style="font-weight: bold; border-bottom: 1px solid #cccccc;">
                                                            <?php
                                                            if ($fe['tipo'] == 0) {
                                                                echo $fe['cant'] . "%";
                                                            } else {
                                                                echo number_format($fe['cant']);
                                                            }
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <br>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <div class="col-lg-5 alert-info">
                                                NO SE DETALLES DE LA OFERTA
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="alert alert-danger">
                                            <?php echo $err; ?>
                                        </div>
                                        <?php
                                    }
                                }
                            } else {
                                echo $err;
                            }
                        } else {
                            ?>
                            <div class="col-lg-5 alert-info text-uppercase">
                                no se encontraron ofertas asignadas a la propiedad
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            } else {
                echo $e;
            }
        } else {
            ?>
            <div class="alert alert-info">
                <h2><i class="fa fa-exclamation-triangle"> Lo sentimos, no se encontro esta propiedad </i></h2>
            </div>
            <?php
        }
        break;
    case 7:
        if (isset($_REQUEST["id"])) {
            $id = $_REQUEST["id"];
            ?><i class="fa fa-picture-o"></i><label>Galer&iacute;a</label><br><?php
            $traedatos = mysqli_query($CNN, "SELECT p.*,b.name as dest FROM cms_property p INNER JOIN cms_property_locale b ON (p.location=b.`id`) WHERE p.id=$id");
            while ($h = mysqli_fetch_array($traedatos)) {
                echo "<small><b>" . strtoupper($h['title']) . "</small>";
            }
        } else {
            $id = 0;
        }
        ?>
        <div id="frmPost" class="dropzone"></div>
        <div id="gallery_show" name="gallery_show"></div>
        <script>
            var dz = $("#frmPost").dropzone({
                maxFilesize: 200,
                url: "content/upload/property/upload.inc.php?id=<?php echo $id; ?>",
                complete: function (file) {
                    console.log(file);
                    $.ajax({
                        method: "POST",
                        url: "include/modules/property/gallery.ajax.php",
                        data: {"id": "<?php echo $id; ?>"}
                    }).done(function (data) {
                        $("#gallery_show").html(data);
                    });
                }
            });
            $(document).ready(function ()
            {
                $.ajax({
                    method: "POST",
                    url: "include/modules/property/gallery.ajax.php",
                    data: {"id": "<?php echo $id; ?>"}
                }).done(function (data) {
                    $("#gallery_show").html(data);
                });
            });
        </script>
        <div class="modal fade" id="mod_elim" name="mod_elim" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" >
                <div class="modal-content" >
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="exampleModalLabel">Eliminar</h4>
                    </div>
                    <div class="modal-body" id="elimina_c" name="elimina_c">
                        <form id='form_elim' name='form_elim' method='POST' >
                            <input type="text" name="op" id="op" value="80" class="hidden"/>
                            <input type="text" name="elim_id" id="elim_id" class="hidden"/>
                            <input type="text" value="<?php echo $id; ?>"name="prop_id" id="prop_id" class="hidden"/>
                            <div class="form-group">
                                <label for="recipient-name" class="control-label">¿Esta seguro que desea eliminar la imagen?:</label>
                                <div id="tit" name="tit"></div>
                                <input type="text" name="el_id" class="form-control hidden" id="el_id" />
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                        <button type="button" class="btn btn-success" id="aceptar" name="aceptar" onclick="eliminaitemimage(<?php echo $id; ?>);">Aceptar</button>
                    </div>
                </div>
            </div>
        </div>
        <?php
        break;
    case 10:
        $id = $_REQUEST["id"];
        $info = array();
        $desc = array();
        $adds = array();
        $getinfo = "select * from cms_property where id=$id";
        $gf = mysqli_query($CNN, $getinfo) or $e = "ERROR #0: Error al traer los datos de la casa<br>consulte a su administrador<br>" . mysqli_error($CNN);
        if (!isset($e)) {
            while ($d = mysqli_fetch_array($gf)) {
                $info = $d;


                $getr = mysqli_query($CNN, "select * from cms_property_translate where pid=$id");
                while ($d = mysqli_fetch_array($getr)) {
                    $desc[$d['cname'] . "_" . $d['lang']] = $d['caption'];
                }
                $manlang = array();
                $coo = 0;
                $getr2 = mysqli_query($CNN, "select * from cms_property_translate where pid=$id group by lang");
                while ($d = mysqli_fetch_array($getr2)) {
                    $manlang[$coo] = $d['lang'];
                    $coo++;
                }
                $arrdif = array_diff($language, $manlang);
                if (count($arrdif) >= 1) {
                    $nwlang = "insert into cms_property_translate(pid,cname,lang)values";
                    foreach ($arrdif as $le) {
                        $nwlang.="('$id','rent-short','$le'),";
                        $nwlang.="('$id','rent-large','$le'),";
                    }
                    $nwlang = substr($nwlang, 0, -1);
                    $addnw = mysqli_query($CNN, $nwlang);
                    unset($desc);
                    $desc = array();
                    $getr = mysqli_query($CNN, "select * from cms_property_translate where pid=$id");
                    while ($d = mysqli_fetch_array($getr)) {
                        $desc[$d['cname'] . "_" . $d['lang']] = $d['caption'];
                    }
                }
                $geado = mysqli_query($CNN, "select * from cms_property_addons where pid=$id");
                $noro = mysqli_num_rows($geado);
                if ($noro >= 1) {
                    while ($a = mysqli_fetch_array($geado)) {
                        $adds[$a['cid'] . "_" . $a['aid'] . "_data"] = $a['ovalue'];
                    }
                } else {
                    $exq = "INSERT INTO cms_property_addons (cid, aid,ovalue,pid) SELECT a.cid,a.id,a.valor,'$id' AS pid  FROM cms_addons a WHERE required=1";
                    $inval = mysqli_query($CNN, $exq) or $err = "error al insertar los valores " . mysqli_error($CNN);
                    if (!isset($err)) {
                        $geado = mysqli_query($CNN, "select * from cms_property_addons where pid=$id");
                        while ($a = mysqli_fetch_array($geado)) {
                            $adds[$a['cid'] . "_" . $a['aid'] . "_data"] = $a['ovalue'];
                        }
                    }
                }
                ?>
                <h4><b><?php echo strtoupper($info['title']); ?></b><small>(editar)</small></h4>
                <form action="./?m=property&s=housing&o=1" method="post" class="form"name="formhousing" id="formhousing" enctype="multipart/form-data" >
                    <!---activo o inactivo-->
                    <div class="checkbox-1">
                        <br><br>
                        <span>Activo/Inactivo</span>
                        <input type="checkbox" id="ejemplo-1" value="<?php echo $info['status']; ?>" name="ejemplo-1"  class="hidden" onclick="status();"/>
                        <label for="ejemplo-1"></label>
                    </div>
                    <input type="number" value="0" id="rent-status" name="rent-status" class="hidden"><!---STATUS DE LA PROPIEDAD 0=INACTIVO / 1=ACTIVO---->
                    <input type="text" id="idsav" name="idsav" value="<?php echo $info['id']; ?>" class="hidden" ><!--ID DE PROPIDAD GUARDADA 0=GUARDADA/N=GUIARDADO--->
                    <input type="text" id="shlang" name="shlang" value="1" class="hidden" ><!--DESC CORTA 0=GUARDADA/N=GUARDADO--->
                    <input type="text" id="lonlang" name="lonlang" value="1" class="hidden" ><!--DESC LARGA 0=GUARDADA/N=GUARDADO--->
                    <div role="tabpanel">
                        <!---LISTADO DE PESTAÑAS--->
                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#informacion" aria-controls="informacion" role="tab" data-toggle="tab" class="text-uppercase">Informaci&oacute;n</a>
                            </li>
                            <?php
                            $nam_t = mysqli_query($CNN, "select * from cms_catalog");
                            while ($name = mysqli_fetch_array($nam_t)) {
                                ?>
                                <li role="presentation" class="text-uppercase">
                                    <a href="#<?php echo $name['id']; ?>" aria-controls="<?php echo $name['id']; ?>" role="tab" data-toggle="tab">
                                        <?php echo $name['common']; ?>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                            <!-- <li role="presentation">
                                 <a href="#Precios" aria-controls="informacion" role="tab" onclick="checaguarda();" data-toggle="tab">Precios</a>
                             </li>-->
                        </ul>
                        <!--CONTENIDO DE LAS PESTAÑAS-->
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active text-left " id="informacion" style="padding:1%;">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Nombre:</div>
                                                <input type="text"  id="rent-title" name="rent-title" value="<?php echo $info['title']; ?>" class="form-control  text-uppercase" onchange="updatacampos(this.name, this.value);"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 ">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Referencia:</div>
                                                <input type="text" id="rent-ref" name="rent-ref" class="form-control  text-uppercase" value="<?php echo $info['ref']; ?>" onchange="updatacampos(this.name, this.value);" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Modo:</div>
                                                <select id="rent-modo" name="rent-modo" class="form-control  text-uppercase" onchange="updatacampos(this.name, this.value);" >
                                                    <option value="0" <?php
                if ($info['modo'] == 0) {
                    echo "selected";
                }
                            ?>>Alquiler</option>
                                                    <option value="1" <?php
                                    if ($info['modo'] == 1) {
                                        echo "selected";
                                    }
                            ?>>Gestion</option>
                                                    <option value="2" <?php
                                    if ($info['modo'] == 2) {
                                        echo "selected";
                                    }
                            ?>>Venta</option>
                                                    <option value="3" <?php
                                    if ($info['modo'] == 3) {
                                        echo "selected";
                                    }
                            ?>>Traspaso</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Tipo:</div>
                                                <select id="rent-tipo" name="rent-tipo" class="form-control  text-uppercase" onchange="updatacampos(this.name, this.value);" >
                                                    <?php
                                                    $typ = "SELECT * from cms_property_type ";
                                                    $slt = mysqli_query($CNN, $typ);
                                                    while ($x = mysqli_fetch_array($slt)) {
                                                        ?>
                                                        <option value='<?php echo $x['id']; ?>'<?php
                                    if ($info['tipo'] == $x['id']) {
                                        echo "selected";
                                    }
                                                        ?>><?php echo $x['name']; ?></option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Ba&ntilde;os:</div>
                                                <input type="number" id="rent-bathroom" name="rent-bathroom" value="<?php echo $info['bathroom']; ?>" min="0" class="form-control  text-uppercase"  onblur="updatacampos(this.name, this.value);" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Servicios:</div>
                                                <input type="number" id="rent-servicios" name="rent-servicios"  value="<?php echo $info['servicios']; ?>" min="0" class="form-control  text-uppercase" onblur="updatacampos(this.name, this.value);"  />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Habitaciones:</div>
                                                <input type="number" id="rent-room" name="rent-room" value="<?php echo $info['room']; ?>" min="0"class="form-control  text-uppercase" onblur="updatacampos(this.name, this.value);" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-2">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <div class="input-group-addon">Ocupantes:</div>
                                                <input type="number" id="rent-capacity" name="rent-capacity" value="<?php echo $info['capacity']; ?>" min="0" class="form-control  text-uppercase" onblur="updatacampos(this.name, this.value);" />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <div class="input-group-addon">Ubicacion:</div>
                                                    <select id="rent-location" name="rent-location" class="form-control  text-uppercase" onblur="updatacampos(this.name, this.value);"  >
                                                        <?php
                                                        $consulta = "SELECT * from cms_property_locale ";
                                                        $result = mysqli_query($CNN, $consulta);
                                                        while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
                                                            ?>
                                                            <option value='<?php echo $x['id']; ?>'<?php
                                        if ($info['location'] == $x['id']) {
                                            echo "selected";
                                        }
                                                            ?>><?php echo $x['name']; ?></value>
                                                                <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div class=row>
                                                <div class="col-lg-12">
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <div class="input-group-addon">Direcci&oacute;n:</div>
                                                            <input type="text" id="rent-address" name="rent-address"  value="<?php echo $info['address']; ?>"class="form-control  text-uppercase" onkeypress="clearmapa();
                                                                                    mapadire(this.value);" onblur="updatacampos(this.name, this.value);" />
                                                            <input type="text" id="dirho_num" value="0" class="hidden">
                                                        </div>
                                                    </div>
                                                </div>
                                                <!----INICIAN LAS TRADUCCIONES--->
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div>
                                                            <ul class="nav nav-tabs" role="tablist">
                                                                <?php
                                                                foreach ($language as $L) {
                                                                    ?>
                                                                    <li role="presentation" class="<?php
                                                if ($L == "es") {
                                                    echo "active";
                                                }
                                                                    ?>">
                                                                        <a href="#tab_<?php echo $L; ?>" aria-controls="tab_<?php echo $L; ?>" role="tab" data-toggle="tab" class="text-uppercase">
                                                                            <?php echo $L; ?>
                                                                            <?php if ($L == "es") { ?>
                                                                                <span class="label label-danger">Requerido</span>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        </a>
                                                                    </li>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </ul>
                                                            <div class="tab-content">
                                                                <?php
                                                                foreach ($language as $L) {
                                                                    ?>
                                                                    <div role="tabpanel" class="tab-pane  <?php
                                                if ($L == "es") {
                                                    echo "active";
                                                }
                                                                    ?> " id="tab_<?php echo $L; ?>">
                                                                        <br>
                                                                        <div class="row ">
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon">Descripci&oacute;n Corta<small><?php echo "(" . $L . ")"; ?></small></div>
                                                                                        <input type="text" id="rent-short_<?php echo $L; ?>" value="<?php echo $desc["rent-short_" . $L] ?>" name="rent-short_<?php echo $L; ?>"  size="200" class="form-control  text-uppercase" onblur="saveshort(this.name, this.value);"  />
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-lg-12">
                                                                                <div class="form-group">
                                                                                    <div class="input-group">
                                                                                        <div class="input-group-addon">Descripci&oacute;n Larga<small><?php echo "(" . $L . ")"; ?></small></div>
                                                                                        <textarea type="text" id="rent-large_<?php echo $L; ?>" name="rent-large_<?php echo $L; ?>" rows="6" cols="100%" class="form-control  text-uppercase" onblur="savelong(this.name, this.value);" /><?php echo $desc["rent-large_" . $L] ?></textarea>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <?php
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6"><!---Aqui va el mapa--->
                                        <div id="test" class="gmap3"></div>
                                        <input type="text" name="lat" id="lat" value="0" class="hidden"><!--latitud-->
                                        <input type="text" name="long" id="long" value="0"class="hidden" ><!---Longitud--->
                                    </div>
                                </div>
                            </div>
                            <!-- Dinamico -->
                            <?php
                            $gettabs = mysqli_query($CNN, "select * from cms_catalog");
                            while ($p = mysqli_fetch_array($gettabs)) {
                                ?>
                                <div role="tabpanel" class="tab-pane" id="<?php echo $p['id']; ?>" name="<?php echo $p['id']; ?>" style="padding:1%;">
                                    <?php
                                    $addons = "SELECT a.caption,b.* FROM  cms_addon_translate a INNER JOIN cms_addons b ON (a.aid=b.id) WHERE tname='{$p['id']}' AND lang='es'";
                                    $ado = mysqli_query($CNN, $addons) or $err = "error al traer el catalogo <b>{$p['common']}<b><br>" . mysqli_error($CNN);
                                    if (!isset($err)) {
                                        $ro = 0;
                                        while ($r = mysqli_fetch_array($ado)) {
                                            unset($val);
                                            if (array_key_exists($p['id'] . "_" . $r["id"] . "_data", $adds)) {
                                                $ck = "checked data-save='1'";
                                                $val = $adds[$p['id'] . "_" . $r["id"] . "_data"];
                                            } else {
                                                $val = null;
                                                $ck = "data-save='0'";
                                            }
                                            $chked = $chked2 = "";
                                            if ($val == 1) {
                                                $chked = "checked";
                                            }
                                            if ($val == 0) {
                                                $chked2 = "checked";
                                            }
                                            $req = null;
                                            unset($idimpt);
                                            $idimpt = $p['id'] . "_" . $r['id'];
                                            if ($r['required'] == 1) {
                                                $req = 'checked="checked"  readonly="readonly" onclick="javascript: return false;"';
                                            } else {
                                                $req = 'onclick="saveitem(' . $p['id'] . ',' . $r['id'] . ');"';
                                            }
                                            if ($ro == 0) {
                                                ?>
                                                <div class="row">
                                                    <?php
                                                }
                                                $ro++;
                                                ?>
                                                <div class="col-lg-4">
                                                    <table class="table table-bordered table-hover">
                                                        <tr >
                                                            <td widht="1" style="vertical-align: middle; ">
                                                                <input type="checkbox" class=" "  id="<?php echo $idimpt; ?>" value="<?php echo $r['id']; ?>" <?php echo $req . $ck; ?> />
                                                            </td>
                                                            <td widht="49%" style="vertical-align: middle; ">
                                                                <?php echo strtoupper(utf8_decode($r['caption'])); ?>
                                                            </td>
                                                            <td width="50%" style="vertical-align: middle; ">
                                                                <?php
                                                                switch (($r['tipo'])) {
                                                                    case 0:
                                                                        ?>
                                                                        <input type="radio" id="<?php echo $idimpt; ?>_data" name="<?php echo $idimpt; ?>_data" value="1" onblur="save_value(<?php echo $p['id'] . ',' . $r['id']; ?>, 1);" <?php echo $chked; ?>>Si
                                                                        <input type="radio" id="<?php echo $idimpt; ?>_data" class=" text-uppercase" name="<?php echo $idimpt; ?>_data" value="0" onblur="save_value(<?php echo $p['id'] . ',' . $r['id']; ?>, 0);" <?php echo $chked2; ?>>No
                                                                        <?php
                                                                        break;
                                                                    case 1:
                                                                        ?>
                                                                        <input type="number" id="<?php echo $idimpt; ?>_data" value="<?php echo $val; ?>" class="form-control  text-uppercase"  onblur="save_value(<?php echo $p['id'] . ',' . $r['id']; ?>, this.value);"/>
                                                                        <?php
                                                                        break;
                                                                    case 2:
                                                                        ?>
                                                                        <input type="text"id="<?php echo $idimpt; ?>_data"  value="<?php echo $val; ?>" class="form-control  text-uppercase"  placeholder="Text"  onblur="save_value(<?php echo $p['id'] . ',' . $r['id']; ?>, this.value);"/>
                                                                        <?php
                                                                        break;
                                                                }
                                                                ?>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <?php
                                                if ($ro == 3) {
                                                    $ro = 0;
                                                    ?>
                                                </div>
                                                <?php
                                            }
                                        }
                                        if ($ro <= 3) {
                                            ?>
                                        </div><?php
                        }
                    } else {
                                        ?>
                                    <div class="alert alert-danger">
                                        <?php echo $err; ?>
                                    </div>
                                    <?php
                                    unset($err);
                                }
                                ?>
                            </div>
                            <?php
                        }
                        ?>
                    </div>
                </form>
                <script>
                    $(document).ready(function () {
                        cargamapa();
                    });
                </script>
                <?php
            }
        } else {
            ?>
            <div class="alert alert-danger ">
                <?php strtoupper($e); ?>
            </div>
            <?php
        }
        break;
    case 11:
        $errstr = "";
        $title = filter_input(INPUT_POST, "rent-title");
        $prize = filter_input(INPUT_POST, "rent-prize");
        $room = filter_input(INPUT_POST, "rent-room");
        $capacity = filter_input(INPUT_POST, "rent-capa");
        $bathroom = filter_input(INPUT_POST, "rent-bat");
        $type = filter_input(INPUT_POST, "rent-type");
        $mode = filter_input(INPUT_POST, "rent-mode");
        $place = filter_input(INPUT_POST, "rent-ubi");
        $short = filter_input(INPUT_POST, "rent-short");
        $large = filter_input(INPUT_POST, "rent-large");
        $meta = substr(filter_input(INPUT_POST, "rent-meta"), 0, -1);
        $address = filter_input(INPUT_POST, "rent-address");
        $seo = filter_input(INPUT_POST, "rent-seo");
        $oSQL = "INSERT INTO cms_property(title,prize,room,capacity,bathroom,tipo,modo,location,short_desc,long_desc,metadatos,seo,address)VALUES ('$title','$prize','$room','$capacity','$bathroom','$type','$mode','$place','$short','$large','$meta','$seo','$address')";
        $q = mysqli_query($CNN, $oSQL) or $e = (mysqli_errno($CNN) . ":" . mysqli_error($CNN) . "<br/>" . $oSQL);
        ///* ### SECUNDARIO ###
        $arr = array('interior', 'exterior', 'equip', 'general');
        $pre = array('in', 'out', 'equi', 'gen');
        if (!isset($e)) {
            ?>
            <h3>Se ha dado de alta la informaci&oacute;n general de la propiedad</h3>
            <?php
            $id = mysqli_insert_id($CNN);
            $f2 = 0;
            for ($i = 0; $i < count($arr); $i++) {

                $mysq2 = "SELECT a.* FROM cms_property_{$arr[$i]} a WHERE a.active=1";
                $sq2 = mysqli_query($CNN, $mysq2) or $eex = mysqli_errno($CNN) . ": " . mysqli_error($CNN);
                if (!isset($eex)) {
                    $insernew = "insert into cms_property_e_{$arr[$i]} (pid, oid,ovalue) values";
                    while ($t = mysqli_fetch_array($sq2)) {
                        $fld = $pre[$i] . "_" . $t['id'];
                        if (isset($_REQUEST[$fld])) {
                            $data = $pre[$i] . "_" . $t['id'] . "_data";
                            $valdata = filter_input(INPUT_POST, $data);
                            $val = $valdata;
                            if ($valdata == "") {
                                $val = null;
                            }
                            $insernew.="('$id','{$t['id']}','$val'),";
                            $f2++;
                        }
                        $fld = "";
                        $data = "";
                        $val = "";
                    }
                    $insernew = substr($insernew, 0, -1);
                    $insernew.=";";
                    if ($f2 > 0) { //solo si hay algun error
                        $in = mysqli_query($CNN, $insernew) or $errx = mysqli_errno($CNN) . ":" . mysqli_error($CNN) . "<br/>" . $insernew;
                        if (!isset($err)) {
                            ?>
                            <div class="alert alert-success">
                                <h4>Se ha guardado la informaci&oacute;n para el cat&aacute;logo <?php echo $arr[$i]; ?></h4>
                            </div>
                            <?php
                        } else {
                            ?>
                            <div class="well well-sm" >
                                Lo sentimos, ocurri&oacute; un error con el cat&aacute;logo <?php echo $arr[$i]; ?><br>
                                ERROR <?php echo ($i + 1); ?><br/>
                                CODE:#<?php echo $errx; ?><br/>
                                <button name="regresa" class="btn btn-danger" onclick="window.history.go(-1);
                                                                    return false;"> Regresar </button>
                            </div>
                            <?php
                        }
                    }
                } else {
                    ?>
                    <div class="well well-sm" >
                        Lo sentimos, ocurri&oacute; un error. <br>
                        ERROR <?php echo ($i + 1); ?><br/>
                        CODE:#<?php echo $eex; ?><br/>
                        <button name="regresa" class="btn btn-danger" onclick="window.history.go(-1);
                                                    return false;"> Regresar </button>
                    </div>
                    <?php
                }
            }
        } else {
            ?>
            <div class="well well-sm" >
                Lo sentimos, ocurri&oacute; un error. <br>
                ERROR <?php echo ($i + 1); ?><br/>
                CODE:#<?php echo $err; ?><br/>
                <button name="regresa" class="btn btn-danger" onclick="window.history.go(-1);
                                    return false;"> Regresar </button>
            </div>
            <?php
        }
        break;
}
