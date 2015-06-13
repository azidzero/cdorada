<h2>Opciones</h2>
<?php
switch ($o) {
    case 0:
        ?>
        <div class="well well-sm">
            <form action="./?m=property&s=option&o=10" class="form" method="post" enctype="multipart/form-data" >
                <span class="span2">Modulo</span>
                <select id="module" name="module" onchange="this.form.submit()" >
                    <option></option>
                    <option value="property">Propiedades</option>
                </select>           
        </div>
        <?php
        break;
    case 10:
        ?>
        <div class="well well-sm">
            <form action="./?m=property&s=option&o=10" class="form" method="post" enctype="multipart/form-data" >
                <span class="span2">Modulo</span>
                <select id="module" name="module" onchange="this.form.submit()" >
                    <option></option>
                    <option value="property">Propiedades</option>
                </select>           
        </div>
        <div>
            <label>Opciones  del area:</label>
            <?php
            $arry = array(getArr('cms_property_extra', 'active', '1', 1));
            $tipod = array(getArr('cms_property_extra', 'active', '1', 2));
            $req = array(getArr('cms_property_extra', 'active', '1', 4));
            $xy = null;
            echo "<table>";
            ?>
            <tr>
                <td>Nombre</td>
                <td>Tipo de dato</td>
                <td>Requerido</td>
            </tr>
            <?php
            for ($i = 0; $i < count($arry[0]); $i++) {
                echo "<tr>";
                $xy = $tipod[0][$i];
                switch ($xy) {
                    case 0:
                        ?>
                        <td>
                            <label><?php echo $arry[0][$i]; ?></label>
                        </td>
                        <td>
                            Boleano
                        </td>
                        <td>
                            <input type="checkbox" name="required" id="required" checked="<?php if ($req[0][$i] == '1') {
                        echo "true";
                    } ?>" <?php if ($req[0][$i] == '1') {
                        echo "disabled";
                    } ?> >
                        </td>
                        <?php
                        break;
                    case 1:
                        ?>
                        <td>
                            <label><?php echo $arry[0][$i]; ?></label>
                        </td>
                        <td>
                            Numerico
                        </td>
                        <td>

                            <input type="checkbox" name="required" id="required" checked="<?php if ($req[0][$i] == '1') {
                            echo "true";
                        } ?>" <?php if ($req[0][$i] == '1') {
                        echo "disabled";
                    } ?> >
                        </td>
                    <?php
                    break;
                case 2:
                    ?>
                        <td>
                            <label><?php echo $arry[0][$i]; ?></label>
                        </td>
                        <td>
                            Texto
                        </td>
                        <td>
                            <input type="checkbox" name="required" id="required" checked="<?php if ($req[0][$i] == '1') {
                        echo "true";
                    } ?>" <?php if ($req[0][$i] == 1) {
                        echo "disabled";
                    } ?> >
                        </td>
                    <?php
                    break;
            }
            echo "</tr>";
        }
        echo "</table>";
        ?>
        </div>
        <?php
        break;
}