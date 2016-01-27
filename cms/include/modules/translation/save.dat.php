<?php
include("../../../inc/app.conf.php");
$p = filter_input(INPUT_POST, "op");
switch ($p) {
    case 0:
        $id = filter_input(INPUT_POST, "id");
        $acti = mysqli_query($CNN, "update cms_translation_lang set status=0 where id=$id");
        if (!$acti) {
            ?>OCURRIO UN ERROR<?php
            echo mysqli_error($CNN);
        } else {
            ?>LENGUAJE DESACTIVADO <?php
        }
        break;
    case 1:
        $id = filter_input(INPUT_POST, "id");
        $acti = mysqli_query($CNN, "update cms_translation_lang set status=1 where id=$id");
        if (!$acti) {
            ?>OCURRIO UN ERROR<?php
            echo mysqli_error($CNN);
        } else {
            $slan = mysqli_query($CNN, "select iso_639_1  from cms_translation_lang where id=$id")or die(mysqli_errno($CNN));
            while ($a = mysqli_fetch_array($slan)) {
                $file = $a['iso_639_1'] . ".lang.xml";
            }
            if (file_exists("../../lang/" . $file)&& file_exists("../../../include/lang/" . $file)) {
                //echo "existe";
                ?>LENGUAJE ACTIVADO CORRECTAMENTE<?php
            } else {
                if (!file_exists("../../lang/" . $file))
                {
                $dest = $_SERVER['DOCUMENT_ROOT'] . "/cms/include/lang/$file";
                $orig = $_SERVER['DOCUMENT_ROOT'] . "/cms/include/lang/es.lang.xml";
                }
                if(!file_exists("../../../include/lang/" . $file))
                {
                $dest2 = $_SERVER['DOCUMENT_ROOT'] . "/include/lang/$file";
                $orig2 = $_SERVER['DOCUMENT_ROOT'] . "/include/lang/es.lang.xml";
                }
                if (!copy($orig, $dest)) {
                    echo "Error al activar su lenguaje cms";
                    ?> LENGUAJE NO ACTIVADO CORRECTAMENTE<?php
                } else {
                    if (!copy($orig2, $dest2)) {
                        echo "Error al activar su lenguaje web";
                        ?> LENGUAJE NO ACTIVADO CORRECTAMENTE<?php
                    } else {
                        ?>LENGUAJE ACTIVADO CORRECTAMENTE<?php
                    }
                }
            }
        }
        break;
    case 10:
        $id = filter_input(INPUT_POST, 'idlang');
        switch ($id) {
            case 'p':
                ?>
                <h1><small>Principales</small></h1>
                <?php
                $getid = mysqli_query($CNN, "SELECT * FROM cms_translation_lang WHERE( iso_639_1='es' OR  iso_639_1='fr' OR  iso_639_1='ru' OR  iso_639_1='en') AND STATUS=1 order by id")or $err = "error:" . mysqli_error($CNN);
                if (!isset($err)) 
                {
                    $leng = array();
                    $pos = 0;
                    while ($l = mysqli_fetch_array($getid)) 
                    {
                        $leng[$pos][0] = $l['iso_639_1'];
                        $leng[$pos][1] = $l['name_es'];
                        $pos++;
                    }
                    $path = "../../../include/lang";
                    if (is_dir($path)) {
                        $o = opendir($path);
                        for ($p = 0; $p < count($leng); $p++) {
                            $tmp = $path . "/{$leng[$p][0]}.lang.xml";
                            echo $tmp;
                            $xml = simplexml_load_file($tmp);
                            $xml_array[$p] = xml2array($xml);
                        }
                        for ($s = 0; $s < count($leng); $s++) 
                        {
                            $link = array();
                            $sections = $xml_array[$s]['sections']['section'];
                            foreach ($sections as $section) 
                            {
                                $link[] = $section["@attributes"]['name'];
                            }
                        }
                        ?>
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <?php
                                for ($i = 0; $i < count($link); $i++) {
                                    if ($i == 0) {
                                        echo '<li role="presentation" class="active"><a href="#' . $link[$i] . '" aria-controls="home" role="tab" data-toggle="tab">' . $link[$i] . '</a></li>';
                                    } else {
                                        echo '<li role="presentation" class=""><a href="#' . $link[$i] . '" aria-controls="home" role="tab" data-toggle="tab">' . $link[$i] . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                            <!-- Tab panes -->
                            <div class="tab-content">
                                <?php
                                for ($x = 0; $x < count($leng); $x++)
                                {
                                    $sections[$x] = $xml_array[$x]['sections']['section'];
                                }
                                $x = 0;
                                for ($x = 0; $x < count($leng); $x++) 
                                {
                                    foreach ($sections[$x] as $section) 
                                    {
                                        ?>
                                        <div role="tabpanel" class="tab-pane
                                        <?php
                                        if ($x == 0) 
                                        {
                                            echo "active";
                                        }
                                        ?>" id="<?php echo $section["@attributes"]['name']; ?>"><?php
                                                 echo "<h3>" . $section["@attributes"]['name'] . " <small>{$section["@attributes"]['description']}</small></h3>";
                                                 if (isset($section['string'])) {
                                                     $string = $section['string'];
                                                     if (is_array($string)) {
                                                         echo "<table class=\"table table-condensed\" border='1'>";
                                                         if (isset($string[0])) {
                                                             echo "<thead>";
                                                             echo "<th></th>";
                                                             for ($o = 0; $o < count($leng); $o++) 
                                                             {
                                                                 echo "<th>" . strtoupper($leng[$o][0]) . "-" . $leng[$o][1] . "</th>";
                                                             }
                                                             echo "</thead>";
                                                         }
                                                         foreach ($string as $str) {
                                                             echo "<tr>";
                                                             echo "<td width=\"10%\">";
                                                             echo "<div class=\"input-group\">";
                                                             if (isset($str["@attributes"]["name"])) {
                                                                 echo "<span class=\"input-group-addon\">" . ucwords(strtolower($str["@attributes"]["name"])) . "</span>";
                                                             }
                                                             echo "</td>";
                                                             for ($x = 0; $x < count($leng); $x++) {
                                                                 echo "<td>";
                                                                 if (isset($str["@value"])) {
                                                                     echo "<input class=\"form-control\" name=\"" . $leng[$x][0] . "_" . $str["@attributes"]["name"] . "\" id=\"" . $leng[$x][0] . "_" . $str["@attributes"]["name"] . "\" value=\"{$str["@value"]}\" />";
                                                                 }
                                                                 echo "</div>";
                                                                 echo "</td>";
                                                             }
                                                             echo "</tr>";
                                                         }
                                                         echo "</table>";
                                                     } else {
                                                         echo "<pre>";
                                                         print_r($section['string']);
                                                         echo "</pre>";
                                                     }
                                                 }
                                                 ?></div><?php
                                        $x++;
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo "Error en el directorio";
                    }
                } else {
                    ?><h4><?php echo $err; ?></h4><?php
                }
                break;
            default:
                $la = "";
                ?>
                <form  action="./?m=translation&s=translate&o=1" method="POST" >
                    <?php
                    $sel = mysqli_query($CNN, "select * from cms_translation_lang where id=$id");
                    while ($g = mysqli_fetch_array($sel)) {
                        $la = $g['iso_639_1'];
                        $na = $g['name_es'];
                    }
                    //echo "<h1>$la</h1>";
                    $path = "../../../../include/lang";
                    if (is_dir($path)) {
                        $o = opendir($path);
                        $tmp = $path . "/$la.lang.xml";
                     //   echo "<h1>$tmp</h1>";
                       // echo  $_SERVER['DOCUMENT_ROOT'] ."/cms/include/lang/$la.lang.xml";
                        $xml = simplexml_load_file($tmp);
                        $xml_array = xml2array($xml);
                        /*                         * :::::::::::::::::::::::::SECCIONES:::::::::::::::::::::::::::::::. */
                        $padres = "";
                        $description=null;
                        $sections = $xml_array['sections']['section'];
                        foreach ($sections as $section) {
                            $link[] = $section["@attributes"]['name'];
                            $padres.=$section["@attributes"]['name'] . "|";
                        }
                        echo "<h1>" . strtoupper($la) . "-<small>$na</small></h1>";
                        $padres = substr($padres, 0, -1);
                        $hijo = null;
                        $counttitl=0;
                        ?> 
                        <div role="tabpanel">
                            <!-- Nav tabs -->
                            <ul class="nav nav-tabs" role="tablist">
                                <?php
                                for ($i = 0; $i < count($link); $i++) {
                                    if ($i == 0) {
                                        echo '<li role="presentation" class="active"><a href="#' . $link[$i] . '" aria-controls="home" role="tab" data-toggle="tab">' . $link[$i] . '</a></li>';
                                    } else {
                                        echo '<li role="presentation" class=""><a href="#' . $link[$i] . '" aria-controls="home" role="tab" data-toggle="tab">' . $link[$i] . '</a></li>';
                                    }
                                }
                                ?>
                            </ul>
                            <!-- Tab panes -->
                            <input type="text" name="langu" id="langu" value="<?php echo $la ?>" style="visibility:hidden;width: 1px; height: 1px;">
                            <input type="text" name="padres" id="padres" value="<?php echo $padres ?>" style="visibility:hidden;width: 1px; height: 1px;">
                            <div class="tab-content">
                                <?php
                                $sections = $xml_array['sections']['section'];
                                $x = 0;
                                $atna = 0;
                                $desc = "";
                                foreach ($sections as $section) {
                                    ?>
                                    <div role="tabpanel" class="tab-pane <?php
                                    if ($x == 0) {
                                        echo "active";
                                    }
                                    ?>" id="<?php echo $section["@attributes"]['name'];
                                    ?>">
                                             <?php
                                             if(isset($section["@attributes"]['description']))
                                             {
                                                 echo "<h3>" . $section["@attributes"]['name'] . " <small>{$section["@attributes"]['description']}</small></h3>";
                                             $description.=$section["@attributes"]['description']."|";
                                             }
                                             else
                                             {
                                                 echo $section["@attributes"]['name'];
                                             }
                                             ?>
                                        
                                        <?php
                                        if (isset($section['string'])) {
                                            $string = $section['string'];
                                            if (is_array($string)) {
                                                if(isset($section["@attributes"]['description']))
                                                {
                                                $desc.=$section["@attributes"]['description'] . "|";
                                                }?>
                                                <table class="table table-condensed">
                                                    <?php
                                                    $vis=0;
                                                    foreach ($string as $str) {
                                                        echo "<tr>";
                                                        echo "<td>";
                                                        echo "<div class=\"input-group\">"; 
                                                        if(isset ($section['string']['@value']))
                                                        {
                                                            if($vis=='0')
                                                            {
                                                                ?>
                                                                 <input type="text" id="<?php echo $str["name"].$section["@attributes"]['name']; ?>" name="<?php echo $str["name"].$section["@attributes"]['name'];?>" value="<?php echo $section['string']['@value'] ;?>" style="visibility:hidden;width: 1px; height: 1px;">
                                                                <?php
                                                                $hijo.=">" . $str["name"].$section["@attributes"]['name'];
                                                                $vis++;
                                                            }
                                                        }
                                                            if (isset($str["@attributes"]["name"])) 
                                                            {
                                                                
                                                                echo "<span class=\"input-group-addon\">{$str["@attributes"]["name"]}</span>";
                                                                if($str["@attributes"]["name"]=="title")
                                                                {
                                                                    $hijo.=">" . $str["@attributes"]["name"].$section["@attributes"]['name'];
                                                                }
                                                                else
                                                                {
                                                                   $hijo.=">" . $str["@attributes"]["name"];
                                                                }
                                                                
                                                            }
                                                            if (isset($str["@value"])) {
                                                                if($str["@attributes"]["name"]=="title")
                                                                {
                                                                echo "<input class=\"form-control\"  id=\"".$str["@attributes"]["name"].$section["@attributes"]['name']."\" name=\"".$str["@attributes"]["name"].$section["@attributes"]['name']."\" value=\"{$str["@value"]}\">";
                                                                }
                                                                else
                                                                {
                                                                    echo "<input class=\"form-control\"  id=\"".$str["@attributes"]["name"]."\" name=\"".$str["@attributes"]["name"]."\" value=\"{$str["@value"]}\">";
                                                                }
                                                                
                                                                }
                                                        echo "</div>";
                                                        echo "</td>";
                                                        echo "</tr>";
                                                    }
                                                    $hijo.="|";
                                                    ?>
                                                </table><?php
                                            } else {
                                                echo "-----<pre>";
                                                print_r($section['string']);
                                                echo "</pre>";
                                            }
                                        }
                                        ?>
                                    </div> 
                                    <?php
                                    $x++;
                                }
                                ?>
                            </div>
                        </div>
                        <?php
                    } else {
                        echo "Error: " . $path;
                    }
                    $hijo = substr($hijo, 0, -1);
                    $desc = substr($desc, 0, -1);
                    $description = substr($description, 0, -1);
                    ?>
                    <input  type="text" id="arr_hijos" name="arr_hijos" value="<?php echo $hijo; ?>" style="visibility:hidden;width: 1px; height: 1px;">
                    <input  type="text" id="descpa" name="descpa" value="<?php echo $desc; ?>" style="visibility:hidden;width: 1px; height: 1px;">
                     <input  type="text" id="description" name="description" value="<?php echo $description; ?>" style="visibility:hidden;width: 1px; height: 1px;">
                    <button type="submit" class="btn btn-success">Guardar</button>
                </form> 
                <?php
                break;
        }
        break;
}

function xml2array($xmlObject, $out = []) {
    foreach ($xmlObject->attributes() as $attr => $val)
        $out['@attributes'][$attr] = (string) $val;

    $has_childs = false;
    foreach ($xmlObject as $index => $node) {
        $has_childs = true;
        $out[$index][] = xml2array($node);
    }
    if (!$has_childs && $val = (string) $xmlObject)
        $out['@value'] = $val;

    foreach ($out as $key => $vals) {
        if (is_array($vals) && count($vals) === 1 && array_key_exists(0, $vals))
            $out[$key] = $vals[0];
    }
    return $out;
}
