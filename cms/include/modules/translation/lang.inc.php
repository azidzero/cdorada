<?php

switch ($o) {
    case 0:
        ?>
        <h3>Agregar lenguaje</h3>
        <?php
        $tlang = mysqli_query($CNN, "select * FROM cms_translation_lang")or die(mysqli_error($CNN));
        while ($l = mysqli_fetch_array($tlang)) {
            //echo utf8_encode($l['name_es']);
        }
        ?>
        <table id="tbl_admin" class="table table-condensed">
            <thead>
                <tr>
                <td>ID</td>
                <td>Lenguaje</td>
                <td>Activo</td>
                <td>corto</td>
                </tr>
            </thead>
            <tbody style="align:center;"></tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <script>
            $(document).ready(function () {
                jTable('tbl_admin', 'include/modules/translation/langs.table.php');
            });
        </script>
        <?php
        break;
    case 2:
        break;
}


