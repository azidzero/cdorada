<?php
include("../../../inc/app.conf.php");
$lq = mysqli_query($CNN, "SELECT * from cms_translation_lang WHERE status=1");
$language = array();
while ($lr = mysqli_fetch_array($lq)) {
    $language[] = $lr['iso_639_1'];
}
$opc = filter_input(INPUT_POST, "op");
switch ($opc) {
    case 0:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_general WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 1:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_interior WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 2:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_exterior WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 3:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_equip WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 4:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_extra WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 5:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_property_locale WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 6:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_type WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 7:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from cms_property WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 8:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * from web_activity_gallery WHERE id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
    case 10:
        $id = filter_input(INPUT_POST, "id");
        $q = mysqli_query($CNN, "SELECT * FROM cms_property_deal where id=$id") or die(mysqli_error($CNN));
        while ($r = mysqli_fetch_array($q)) {
            $json = ($r);
        }
        echo json_encode($json);
        break;
}
?>

