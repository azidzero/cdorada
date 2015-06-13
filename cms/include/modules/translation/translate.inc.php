<h4>Traducciones</h4>
<?php
$path = "../include/lang";
if (is_dir($path)) {
    $o = opendir($path);
    while ($file = readdir($o)) {
        if ($file != "." && $file != ".." && strstr($file, ".xml") != "") {
            // echo $file . "<br/>";
        }
    }
    $tmp = $path . "/es.lang.xml";
    $xml = simplexml_load_file($tmp);
    $xml_array = xml2array($xml);
    /*
     * Secciones
     */
    $sections = $xml_array['sections']['section'];
    foreach ($sections as $section) {
        $link[] = $section["@attributes"]['name'];
    }
    echo "<h1>{$xml_array["@attributes"]["name"]} - <small>{$xml_array["@attributes"]["locale"]}</small></h1>";
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
            $sections = $xml_array['sections']['section'];
            $x = 0;
            foreach ($sections as $section) {
                ?>
                <div role="tabpanel" class="tab-pane <?php
                if ($x == 0) {
                    echo "active";
                }
                ?>" id="<?php echo $section["@attributes"]['name']; ?>">
                    <?php
                    echo "<h3>" . $section["@attributes"]['name'] . " <small>{$section["@attributes"]['description']}</small></h3>";
                    if (isset($section['string'])) {
                        $string = $section['string'];
                        if (is_array($string)) {
                            echo "<table class=\"table table-condensed\">";
                            foreach ($string as $str) {
                                echo "<tr>";
                                echo "<td>";
                                echo "<div class=\"input-group\">";
                                if (isset($str["@attributes"]["name"])) {
                                    echo "<span class=\"input-group-addon\">{$str["@attributes"]["name"]}</span>";
                                }
                                if (isset($str["@value"])) {
                                    echo "<input class=\"form-control\" id=\"{$str["@attributes"]["name"]}\" value=\"{$str["@value"]}\" />";
                                }
                                echo "</div>";
                                echo "</td>";
                                echo "</tr>";
                            }
                            echo "</table>";
                        } else {
                            echo "<pre>";
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
