<?php
include_once("../../../inc/app.conf.php");
$id= filter_input(INPUT_POST, "myd");
$qy=mysqli_query($CNN, "select * from crm_persons_gallery where pid=$id")or die(mysqli_error($CNN));
while ($i = mysqli_fetch_array($qy)) {
    ?>
    <div class="col-sm-3">
        <a href="javascript:void(0);" onclick="imgProOpen('<?php echo $i['name']; ?>')">
            <img class="img-thumbnail" src="content/upload/property/<?php echo $i['name']; ?>_m.jpg"  alt="img prospecto" title="Imagen" width="100%" />
        </a>
    </div>
    <?php
}
?>

