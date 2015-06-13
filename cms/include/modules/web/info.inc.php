<?php
switch ($o) {
    case 0:
        ?>
        <form action="./?m=web&s=info&o=1" method="POST" enctype="multipart/form-data">
            <h4>%info-new%</h4>
            <table class="table table-condensed">
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">%post-title%:</span>
                            <input type="text" id="post-title" name="post-title" class="form-control" />
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">%post-short-desc%:</span>
                            <input type="text" id="post-short-desc" name="post-short-desc" class="form-control" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">%post-cat%:</span>
                            <select id="post-cat" name="post-cat" class="form-control">
                                <option value="0">Ninguna</option>
                                <?php
                                $oq = mysqli_query($CNN, "SELECT * from web_info_category");
                                while ($or = mysqli_fetch_array($oq)) {
                                    echo "<option value=\"{$or["id"]}\">{$or["name"]}</option>";
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">%post-cover%:</span>
                            <input type="file" id="cover" name="cover" class="form-control" />
                        </div>
                    </td>
                </tr>
                <tr>
                    <td colspan="4">
                        <input type="hidden" id="post-content" name="post-content" />
                        <strong>%post-content%</strong>
                        <div id="post-content-editor"></div>
                    </td>
                </tr>
            </table>
            <div class="well well-sm">
                <button class="btn btn-primary" onclick="$('#post-content').val($('#post-content-editor').code())">Guardar</button>
            </div>
        </form>
        <script>
            $(document).ready(function () {
                $('#post-content-editor').summernote({height: 240});
            });
        </script>
        <?php
        break;
    case 1:
        $title = filter_input(INPUT_POST, "post-title");
        $short_desc = filter_input(INPUT_POST, "post-short-desc");
        $cat = filter_input(INPUT_POST, "post-cat");
        $content = mysqli_real_escape_string($CNN, filter_input(INPUT_POST, "post-content"));

        $date = date("Y-m-d");
        mysqli_query($CNN, "INSERT INTO web_info(title,short_desc,content,category,fecha) 
            VALUES('$title','$short_desc','$content','$cat','$date')") or die(mysqli_error($CNN));
        $id = mysqli_insert_id($CNN);
        $des = "content/info/item_" . str_pad($id, 6, "0", STR_PAD_LEFT) . ".jpg";
        if (move_uploaded_file($_FILES["cover"]["tmp_name"], $des)) {
            echo "<h4>Se ha cargado la portada</h4>";
        } else {
            echo "<h4>No se ha cargado la portada</h4>";
        }
    case 2:
        ?>
        <table id="tbl" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Titulo</td>
                    <td>Descripcion Corta</td>
                    <td>Categoria</td>
                    <td>&nbsp;</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function(){
               jTable('tbl','include/modules/web/info.table.php');
            });
            </script>
        <?php
        break;
    case 3:
        $id = filter_input(INPUT_GET, "id");
        $q = mysqli_query($CNN, "SELECT * from web_info WHERE id=$id");
        while ($r = mysqli_fetch_array($q)) {
            ?>
            <form action="./?m=web&s=info&o=4" method="POST" enctype="multipart/form-data">
                <input type="hidden" id="id" name="id" value="<?php echo $id; ?>" />
                <h4>%info-new%</h4>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">%post-title%:</span>
                                <input type="text" id="post-title" name="post-title" class="form-control" value="<?php echo $r["title"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">%post-short-desc%:</span>
                                <input type="text" id="post-short-desc" name="post-short-desc" class="form-control" value="<?php echo $r["short_desc"]; ?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">%post-cat%:</span>
                                <select id="post-cat" name="post-cat" class="form-control">
                                    <option value="0">Ninguna</option>
                                    <?php
                                    $oq = mysqli_query($CNN, "SELECT * from web_info_category");
                                    while ($or = mysqli_fetch_array($oq)) {
                                        if ($r["category"] == $or["id"]) {
                                            echo "<option selected=\"selected\" value=\"{$or["id"]}\">{$or["name"]}</option>";
                                        } else {
                                            echo "<option value=\"{$or["id"]}\">{$or["name"]}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">%post-cover%:</span>
                                <input type="file" id="cover" name="cover" class="form-control" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="4">
                            <input type="hidden" id="post-content" name="post-content" />
                            <strong>%post-content%</strong>
                            <div id="post-content-editor"><?php echo $r["content"]; ?></div>
                        </td>
                    </tr>
                </table>
                <div class="well well-sm">
                    <button class="btn btn-primary" onclick="$('#post-content').val($('#post-content-editor').code())">Guardar</button>
                </div>
            </form>
            <script>
                $(document).ready(function () {
                    $('#post-content-editor').summernote({height: 240});
                });
            </script>
            <?php
        }
        break;
    case 4:        
        $id = filter_input(INPUT_POST, "id");
        $title = filter_input(INPUT_POST, "post-title");
        $short_desc = filter_input(INPUT_POST, "post-short-desc");
        $cat = filter_input(INPUT_POST, "post-cat");
        $content = mysqli_real_escape_string($CNN, filter_input(INPUT_POST, "post-content"));
        mysqli_query($CNN, "UPDATE web_info SET 
                title='$title' ,short_desc='$short_desc',content='$content' ,category='$cat' WHERE id='$id'
                ") or die(mysqli_error($CNN));
        echo "<h3>Actividad actualizada con exito</h3>";
        // imagen
        $des = "content/info/item_" . str_pad($id, 6, "0", STR_PAD_LEFT) . ".jpg";
        if ($_FILES["cover"]["error"] == 0) {
            unlink($des);
            if (move_uploaded_file($_FILES["cover"]["tmp_name"], $des)) {
                echo "<h4>Se ha cargado la portada</h4>";
            } else {
                echo "<h4>No se ha cargado la portada</h4>";
            }
        }
        break;
    case 5:
        $id = filter_input(INPUT_POST, "id");
        break;
    case 6:
        break;
}