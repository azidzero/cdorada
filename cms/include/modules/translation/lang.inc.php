<?php
$o = $_REQUEST['o'];
switch ($o) {
    case 0:
        ?>
        <h3>Agregar lenguaje</h3>
        <table id="tbl_langua" class="table table-condensed">
            <thead>
                <tr>
                    <td>ID</td>
                    <td>Nombre</td>
                </tr>
            </thead>
            <tbody style="text-align:center;">
                <?php
                $q = mysqli_query($CNN, "SELECT * from cms_translation_lang");
                while ($r = mysqli_fetch_array($q)) {
                    ?>
                    <tr>
                        <td><?php echo $r[0]; ?></td>
                        <td><?php echo utf8_encode($r[1]); ?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <!-----------------------TERMINA TABLA DINAMICA------------------->
        <!-----------------------INICIA SCRIPT DE LLAMADO A TABLA DINAMICA------------------->
        <!--<script>
            $(document).ready(function () {
                jTable('tbl_langua', 'include/modules/translation/langs.table.php');
            });
        </script>-->
        <?php
        break;
    case 2:
        break;
}


