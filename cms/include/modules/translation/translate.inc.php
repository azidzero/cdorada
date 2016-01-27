<?php
error_reporting(0);
//include_once("class.array2xml2array.php");
require_once('Array2XML.php');
$o = $_REQUEST['o'];
switch ($o) {
    case 0:
        $traeactivos = mysqli_query($CNN, "select * from cms_translation_lang where status=1");
        ?><select id="lang_trad" name="lang_trad" onload="traeform();" onchange="traeform();">
            <option></option>
           <!-- <optgroup label="-">
                <option value="p">Principales</option>
            </optgroup>-->
            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;-Idiomas-">
                <?php
                while ($l = mysqli_fetch_array($traeactivos)) {
                    ?><option value="<?php echo $l['id']; ?>"><?php echo $l['name_es']; ?></option><?php
                }
                ?>
            </optgroup>
        </select>
        <div id="form_lang" name="form_lang"></div>
        <?php
        break;
    case 1:
       /*  echo "<pre>";
          print_r($_REQUEST);
          echo "</pre>"; */
        $lang = filter_input(INPUT_POST, "langu");
        $idiom = "";
        $traeidiom = mysqli_query($CNN, "select * from cms_translation_lang where iso_639_1='$lang'") or $errlang = "error al guardar el lenguaje" . mysqli_error($CNN);
        if (!isset($errlang)) {
            while ($l = mysqli_fetch_array($traeidiom)) {
                $idiom = $l['name_es'];
            }
        }
        $elxml = "<language name=\"" . strtoupper($lang) . "\" ISO=\"" . strtoupper($lang) . "-" . strtoupper($lang) . "\" locale=\"" . $idiom . "\">\n"
                . "\t<sections>\n";
        $pad = explode("|", filter_input(INPUT_POST, "padres"));
        $description = explode("|", filter_input(INPUT_POST, "description"));
        $descpa = explode("|", filter_input(INPUT_POST, "descpa"));
        $hijo = filter_input(INPUT_POST, "arr_hijos");
        $nvarr = explode("|", $hijo);
        for ($xx = 0; $xx < count($nvarr); $xx++) {
            $nvarr[$xx] = explode(">", $nvarr[$xx]);
        }
         /*echo "<pre>";
          print_r($nvarr[0]);
          echo "</pre>"; */
        for ($i = 0; $i < count($pad); $i++) {
            $elxml.="\t\t<section name=\"" . $pad[$i] . "\" description=\"" . $description[$i] . "\">";
            $elem = 0;
            $elem = count($nvarr[$i]);
            $lishij = $nvarr[$i];
            for ($h = 0; $h < $elem; $h++) {
                if ($lishij[$h] != null) {
                    $val = filter_input(INPUT_POST, $lishij[$h]);
                    $titu= "title".$pad[$i];
                    $titu2=$lishij[$h];
                   // echo $titu2."---".$titu."<br>";
                    
                    if($titu2!=$titu)
                    {
                        $elxml.="\n\t\t\t<string name=\"" . $lishij[$h] . "\">" . $val . "</string>";
                        $val = null;
                    }
                    else
                    {
                         $elxml.="\n\t\t\t<string name=\"title\">" . $val . "</string>";
                        $val = null;
                    }
                }
            }
            $elxml.="\n\t\t</section>\n";
            unset($lishij);
        }
        $elxml.="\t</sections>\n</language>";
        // echo $elxml;
        $file = fopen("../include/lang/" . $lang . ".lang.xml", "w");
        fwrite($file, $elxml);
        fclose($file);
        ?>
        <h2><label class='lbl-success'>Guardado con Exito</label></h2>
        <?php
        break;
}

