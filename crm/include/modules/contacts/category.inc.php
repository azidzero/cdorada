<?php
switch ($o) {
    case 0:
        ?>
        <form action='./?m=contacts&s=category&o=1' method="post">
            <h4>Crear Categor&iacute;a</h4>       
            <table class="table table-condensed">
                <tr>
                    <td width='33%'>
                        <div class="input-group">
                            <span class="input-group-addon">Categor&iacute;a Superior</span>
                            <select id="cate_parent" name="cat_parent" class="form-control" >
                                <option value="0">Ninguna</option>
                                <?php
                                $Q = mysqli_query($CORE->CNN, "SELECT * from crm_contacts_category");
                                while ($R = mysqli_fetch_array($Q)) {
                                    echo "<option value=\"{$R['id']}\">{$R['name']}</option>\n";
                                }
                                ?>
                            </select>
                        </div>
                    </td>
                    <td>
                        <div class="input-group">
                            <span class="input-group-addon">Nombre</span>
                            <input id="cat_name" name="cat_name" type="text" class="form-control" />
                        </div>
                    </td>
                    <td>
                        <button type="submit" class="btn btn-success"><i class="fa fa-chevron-right"></i></button>
                    </td>
                </tr>
            </table>
        </form>
        <?php
        break; /* NEW */
    case 1:
        $parent = filter_input(INPUT_POST, 'cat_parent');
        $name = filter_input(INPUT_POST, 'cat_name');
        if (mysqli_query($CORE->CNN, "INSERT INTO crm_contacts_category(parent,name) VALUES('$parent','$name')")) {
            ?>
            <div class="alert alert-success">
                <h4>Se ha realizado la operaci&oacute;n con &eacute;xito!</h4>
                <p>Se ha dado de alta la categor&iacute;a <b>"<?php echo $name; ?>"</b></p>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">                
                <h4>Ha ocurrido un error al realizr la operacion!</h4>
                <p><?php echo $CORE->CNN->error; ?></p>                
            </div>
            <?php
        }
        break; /* ADD */
    case 2:
        ?>
        <h4>Administraci&oacute;n de Categor&iacute;as</h4>
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                    <td>c.Padre</td>                                       
                    <td width="1">&nbsp;</td>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
        <script>
            $(document).ready(function () {
                jTable('tbl_admin','include/modules/contacts/category.table.php');
            });
        </script>
        <?php
        break; /* ADMIN */
    case 3:
        $id = $_REQUEST["id"];
        $q = mysqli_query($CNN, "SELECT * from blog_category WHERE id=$id");
        while ($r = mysqli_fetch_array($q)) {
            ?>
            <form action='./?m=contacts&s=category&o=4' method="post">
                <h4>Actualizar Categor&iacute;a</h4>       
                <table class="table table-condensed">
                    <tr>
                        <td width='33%'>
                            <div class="input-group">
                                <span class="input-group-addon">Categor&iacute;a Superior</span>
                                <select id="cate_parent" name="cat_parent" class="form-control" >
                                    <option value="0">Ninguna</option>
                                    <?php
                                    $Q = mysqli_query($CORE->CNN, "SELECT * from blog_category");
                                    while ($R = mysqli_fetch_array($Q)) {
                                        echo "<option value=\"{$R['id']}\">{$R['name']}</option>\n";
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Nombre</span>
                                <input id="cat_name" name="cat_name" type="text" class="form-control" />
                            </div>
                        </td>
                        <td>
                            <button type="submit" class="btn btn-success"><i class="fa fa-chevron-right"></i></button>
                        </td>
                    </tr>
                </table>
            </form>
            <?php
        }
        break; /* EDIT */
    case 4:break; /* UPDATE */
    case 5:break; /* DEL */
    case 6:break; /* DELETE */
}