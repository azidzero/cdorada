<?php
switch ($o) {
    case 0:
        $uid = $_SESSION["CMS"]["uid"];
        $q = mysqli_query($CNN, "SELECT * from core_user WHERE id=$uid");
        while ($r = mysqli_fetch_array($q)) {
            ?>
            <form action="./?m=account&s=config&o=1" method="POST">
                <input type="hidden" id="id" name="id" value="<?php echo $_SESSION["CMS"]["uid"]; ?>" />
                <h4>Configuraci&oacute;n de cuenta <small><b><?php echo $_SESSION["CMS"]["uname"];?></b></small></h4>
                <table class="table table-condensed">
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Nombre</span>
                                <input type="text" id="user_name" name="user_name" class="form-control" value="<?php echo $r["user_name"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Apellido Paterno</span>
                                <input type="text" id="user_last_p" name="user_last_p" class="form-control" value="<?php echo $r["user_last_p"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Apellido Materno</span>
                                <input type="text" id="user_last_m" name="user_last_m" class="form-control" value="<?php echo $r["user_last_m"]; ?>" />
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Correo Electronico</span>
                                <input type="text" id="email" name="email" class="form-control" value="<?php echo $r["email"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Telefono</span>
                                <input type="text" id="phone" name="phone" class="form-control" value="<?php echo $r["phone"]; ?>" />
                            </div>
                        </td>
                        <td>
                            <div class="input-group">
                                <span class="input-group-addon">Idioma</span>
                                <select id="lang" name="lang" class="form-control">
                                    <?php
                                    $sq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
                                    while ($sr = mysqli_fetch_array($sq)) {
                                        if ($r["lang"] == $sr["iso_639_1"]) {
                                            echo "<option selected=\"selected\" value=\"{$sr["iso_639_1"]}\">{$sr["name_es"]}</option>";
                                        } else {
                                            echo "<option value=\"{$sr["iso_639_1"]}\">{$sr["name_es"]}</option>";
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </td>
                    </tr>
                </table>
                <div class="well well-sm">
                    <button type="submit" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </form>
            <?php
        }
        break;
    case 1:
        $id = filter_input(INPUT_POST, "id");
        $un = filter_input(INPUT_POST, "user_name");
        $ulp = filter_input(INPUT_POST, "user_last_p");
        $ulm = filter_input(INPUT_POST, "user_last_m");
        $email = filter_input(INPUT_POST, "email");
        $phone = filter_input(INPUT_POST, "phone");
        $lang = filter_input(INPUT_POST, "lang");
        mysqli_query($CNN, "UPDATE core_user SET user_name='$un',user_last_p='$ulp',user_last_m='$ulm',email='$email',phone='$phone',lang='$lang' WHERE id=$id") or $e = mysqli_error($CNN);
        if (!isset($e)) {
            ?>
            <div class="alert alert-success">
                <h4>Tu informacion ha sido actualizada exitosamente!</h4>
            </div>
            <?php
        } else {
            ?>
            <div class="alert alert-danger">
                <h4>Tu informacion no ha sido actualizada!</h4>
                <p><?php echo $e; ?></p>
            </div>
            <?php
        }
        break;
}