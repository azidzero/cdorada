<?php
include("../../../inc/app.conf.php");
$id = filter_input(INPUT_POST, "id");
?>
<h4>Imagenes Disponibles para esta propiedad</h4>
<div id="cssmenu">
<ul class="menu" id="menu-pages">
    <?php
    $q = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='$id' order by orden asc");
    $nid = mysqli_num_rows($q);
    while ($r = mysqli_fetch_array($q)) {
        $ord=$r['orden'];

    printf("<li id=\"page_%s\"><div id=\"id_".$r['orden']."\"><img src='content/upload/property/" . $r['name'] . "_m.jpg' width=\"180px\" height=\"120px\" /><br/><button id='elimina' class='btn btn-danger' onclick='traeventana(".$r['id'].",8);'><i class=\"fa fa-trash\"></i>&nbsp;Eliminar</button><label>&Oacute;rden</label><input type=\"text\" size=\"2\" style=\"width:45px;\" name=\"lab_".$r['id']."\" id=\"lab_".$r['id']."\"value=\"".$ord."\" disabled/></div></li>", $r['id'], $r['pid']);
    }
    ?>
</ul>
    </div>
<script>
    $(document).ready(function () {
        $("#menu-pages").sortable({
            update: function (event, ui) {
                $.post
                ("include/modules/property/images.php",
                {type: "orderPages", pages: $('#menu-pages').sortable('serialize')
                })
                        .done(function( data ) {
    var stri=data;
    var arr = stri.split("|");
    for (var x = 0; x < arr.length; x++){
$('#lab_'+arr[x]).val(x+1);
}

  });
            }
        });
    });
</script>
