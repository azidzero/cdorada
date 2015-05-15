<h4>Elementos destacados</h4>
<?php
switch ($o) {
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
        if (move_uploaded_file($_FILES['feat-image']['tmp_name'], $target_path)) {
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
}