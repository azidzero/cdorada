<?php
include("../../../inc/app.conf.php");
$id = filter_input(INPUT_POST, "id");
?>  

<div id="cssmenu">
    <ul class="menu" id="menu-pages">
        <?php
        $q = mysqli_query($CNN, "SELECT * from cms_property_gallery WHERE pid='$id' order by orden asc");
        $nid = mysqli_num_rows($q);
       $p=0;
       $numsrc=array();
        while ($r = mysqli_fetch_array($q)) {
            $ord = $r['orden'];
            $numsrc[$p]="content/upload/property/".$r['name'] . "_m.jpg";
            $p++;
            printf("<li id=\"page_%s\"  style=\"background-image: url('content/upload/property/" . $r['name'] . "_m.jpg');background-size: 150px 100px;background-repeat: no-repeat;\"><div id=\"id_" . $r['orden'] . "\" ></div><button id='elimina' style=\"float:rigth; margin-left:105px; opacity:.7; hover{opacity:1;}\"class='btn btn-danger' onclick='traeventana(" . $r['id'] . ",8,$id);'><i class=\"fa fa-trash\"></i></button></li>", $r['id'], $r['pid']);
        }
        ?>
    </ul>
</div>
<br>
<div id="carousel-example-generic" class="carousel slide" data-ride="carousel" style="max-width: 600px;max-height: 400px; align:center;">
    <!-- Indicators -->
    <ol class="carousel-indicators">
        <?php for($x=0;$x<$nid;$x++)
        {?>
           <li data-target="#carousel-example-generic" data-slide-to="<?php echo $x; ?>" <?php if($x==0){?> class="active" <?php } ?>></li>
           <?php
        } ?>
    </ol>
    <center>
    <div class="carousel-inner" role="listbox">
       
            <?php for($y=0;$y<$nid;$y++)
            {
                if($y<=0)
                {
                    ?>
                    <div class="item active">
                        <img src="<?php echo $numsrc[$y];?>" alt="." width="800px" height="600px">
                        <!-- <div class="carousel-caption">
                        carrusel
                        </div>-->
                    </div>
                    <?php
                }
                else
                {
                   ?>
        <div class="item" id="img1" name="img1">
            <img src="<?php echo $numsrc[$y];?>" alt="..."  width="800px" height="600px">
           <!-- <div class="carousel-caption">
                <button onclick="alert('hola');" class="btn btn-success">Borrar</button>
            </div>-->
        </div>
                   <?php 
                }
            }
            ?>
    </div>

    <!-- Controls -->
    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
    <br><br>
<script>
    $(document).ready(function () {
        $("#menu-pages").sortable({
            update: function (event, ui) {
                $.post
                        ("include/modules/property/images.php",
                                {type: "orderPages", pages: $('#menu-pages').sortable('serialize')
                                })
                        .done(function (data) {
                            var stri = data;
                            var arr = stri.split("|");
                            for (var x = 0; x < arr.length; x++) {
                                $('#lab_' + arr[x]).val(x + 1);
                            }
                        });
            }
        });
    });
</script>
</center>