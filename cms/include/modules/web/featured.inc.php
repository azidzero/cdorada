<h4>Elementos destacados</h4>
 <script src="js/main.core.js"></script>
<?php
switch ($o) 
{
    case 0:
        ?>        
        <form action="./?m=web&s=featured&o=1" class="form" method="post" enctype="multipart/form-data" >
            <div class="well well-sm">
                <b>Crear Elemento Destacado Nuevo</b>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Titulo</span>
                                <input type="text" id="feat-title" name="feat-title" class="form-control" />                        
                            </div>
                        </td>
                        <td rowspan="3">
                            <div class="input-group">
                                <span class="input-group-addon">Mensaje</span>
                                <textarea id="feat-caption" name="feat-caption" class="form-control" rows="5"></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Enlace</span>
                                <input type="text" id="feat-url" name="feat-url" class="form-control" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Im&aacute;gen</span>
                                <input type="file" id="feat-image" name="feat-image" class="form-control" />
                            </div>
                        </td>
                    </tr>
                </table>
                <button type="submit" class="btn btn-danger">Enviar</button>
            </div>
        </form>
        <?php
        break;
    case 1:
        $target_path = "content/upload/cms/temp.jpg";
        if(move_uploaded_file($_FILES['feat-image']['tmp_name'], $target_path)) 
        {
            $title = filter_input(INPUT_POST, "feat-title");
            $caption = filter_input(INPUT_POST, "feat-caption");
            $url = filter_input(INPUT_POST, "feat-url");
            mysqli_query($CNN, "INSERT INTO web_featured(title,caption,url) VALUES('$title','$caption','$url')");
            $nid = str_pad(mysqli_insert_id($CNN), 8, "0", STR_PAD_LEFT);
            $nname = str_replace("temp.jpg", "featured-" . $nid . ".jpg", $target_path);
            rename($target_path, $nname);
            ?>
            <div style="min-height:240px;width:32%;background-image:url('<?php echo $nname;?>');background-size:cover;background-position:center;">
                <h4><?php echo $title; ?></h4>
                <p><?php echo $caption; ?></p>
            </div>
            <?php
        } else {
            
        }
        break;
    case 2:
      $consulta = "SELECT * from web_featured ";
        $result=mysqli_query($CNN,$consulta);
        
        ?>
       <table name="table_dest" id="table_dest" width="100%">
           <thead >
                <tr>
                    <th>Id</th>
                    <th>Titulo</th>
                    <th>descripcion</th>
                    <th>URL</th>
                    <th>Imagen</th>
                    <th>Accion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
                {
                    echo "<tr>
                               <td>$x[id]</td>
                               <td> $x[title]</td>
                               <td> $x[caption]</td>
                                <td> $x[url]</td>
                                 <td> $x[id]</td>
                           <td>
                           <table width=\"100%\"><tr><td>
                           <form name=\"del$x[id]\" id=\"del$x[id]\" action=\"./?m=web&s=featured&o=12\" method=\"post\" ONSUBMIT=\"return pregunta($x[id]);\">
                                <input type=\"text\" value=\"$x[id]\"id=\"id_del\" name=\"id_del\"/> 
                             <button><img src='images/cancel.png' alt='Eliminar' title='Eliminar'/></button>
                            </form>
                             </td><td>
                            <form id=\"$x[id]\"action=\"./?m=web&s=featured&o=10\" method=\"post\">
                                 <input type=\"text\" value=\"$x[id]\"id=\"id_edit\" name=\"id_edit\"/>                        
                               <button type=\"submit\"><img src='images/edit.png' alt='Editar' title='Editar' /></button>
                             </form></td></tr></table>
                            </td>
                        </tr>";
                }
                ?>
            </tbody>
        </table>
        <?php
        break;
    case 10:
        $aid = filter_input(INPUT_POST, "id_edit");
         $consulta = "SELECT * from web_featured where id=$aid";
        $result=mysqli_query($CNN,$consulta);
        while ($x = mysqli_fetch_array($result, MYSQLI_ASSOC)) 
        {
        ?>     
          
        <form action="./?m=web&s=featured&o=11" class="form" method="post" enctype="multipart/form-data" >
            <input type="text" value="<?php echo $aid; ?>" name="val_mod" style=" width:1px;height: 1px; visibility:hidden;"/>
            <div class="well well-sm">
                <b>Crear Elemento Destacado Nuevo</b>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Titulo</span>
                                <input type="text" value="<?php echo $x['title']; ?>" id="feat-title" name="feat-title" class="form-control" />                        
                            </div>
                        </td>
                        <td rowspan="3">
                            <div class="input-group">
                                <span class="input-group-addon">Mensaje</span>
                                <textarea id="feat-caption" name="feat-caption" class="form-control" rows="5"><?php echo $x['caption']; ?></textarea>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Enlace</span>
                                <input type="text" id="feat-url" name="feat-url" value="<?php echo $x['url'];?>" class="form-control" />
                            </div>
                        </td>
                    </tr>
                  <!--  <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Im&aacute;gen</span>
                                <input type="file" id="feat-image" name="feat-image" class="form-control" />
                            </div>
                        </td>
                    </tr>-->
                </table>
                <button type="submit" class="btn btn-danger">Guardar Cambios</button>
            </div>
        </form>
        <?php
        }
        break;
    case 11:
            $title = filter_input(INPUT_POST, "feat-title");
            $caption = filter_input(INPUT_POST, "feat-caption");
            $url = filter_input(INPUT_POST, "feat-url");
            $vmod = filter_input(INPUT_POST, "val_mod");
            mysqli_query($CNN, "update web_featured set title='$title',caption='$caption',url='$url' where id=$vmod");
            ?>
            <div style="min-height:240px;width:32%;background-image:url('<?php echo $url;?>');background-size:cover;background-position:center;">
                <h1>GUARDADO CORRECTAMENTE</h1>
                <h4><?php echo $title; ?></h4>
                <p><?php echo $caption; ?></p>
                <form action="./?m=web&s=featured&o=2" class="form" method="post" enctype="multipart/form-data" >
                <button type="submit" class="btn btn-success">REGRESAR</button>
                </fotm>
            </div>
            <?php
        break;
    case 12:
         $iddel = filter_input(INPUT_POST, "id_del");
        $imgnam= str_pad($iddel, 8, "0", STR_PAD_LEFT);
         $nname ="featured-".$imgnam.".jpg";
         $target_path = "content/upload/cms/".$nname;
         if(unlink($target_path))
         {
             mysqli_query($CNN, "delete from web_featured where id=$iddel");
             ?>
               <h1> SE ELIMINO CORRECTAMENTE</h1>
               <form action="./?m=web&s=featured&o=2" class="form" method="post" enctype="multipart/form-data" >
                <button type="submit" class="btn btn-success">REGRESAR</button>
                </fotm>
             <?php
     
         }
        break;
        
        
}