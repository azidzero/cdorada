<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CORE {

    public $a_m;                // Modulo actual
    public $a_s;                // Seccion actual
    public $a_o;                // Opcion actual
    public $modules = Array(); // Coleccion de Modulos cargados
    private $theme;             // Tema cargado
    public $CNN;

    function __construct($m, $s, $o, $SQL) {
        $this->a_m = $m;    // Actual Modulo
        $this->a_s = $s;    // Actual Seccion
        $this->a_o = $o;    // Actual opcion
        $this->CNN = $SQL;  // Nuestra conexion a MySQL
    }

    function loadModule() {
        $path = "./include/modules"; // Carpeta donde se encuentran los modulos
        $o = opendir($path);        // Apertura de la carpeta
        while ($file = readdir($o)) {       // Leectura de los archivos contenidos en la carpeta
            if ($file != ".." && $file != "." && is_dir($path . "/" . $file)) { // Si el archivo es un directorio lo procesa
                $cfg = $path . "/" . $file . "/conf.module.php";    // definimos el archivo de configuracion a buscar
                if (file_exists($cfg)) {    // Si existe
                    unset($mod);            // Limpiamos la variable en case de que se haya cargado un modulo antes
                    include($cfg);          // Se incluye el archivo con la configuracion del modulo ya como objeto
                    $this->modules[$mod->url] = $mod;   // se agrega el modulo a la coleccion
                }
            }
        }
    }

    function getModules() {
        return $this->modules;
    }

    public function getTopNav($css) {
        echo "<ul class=\"$css\">"; // Inicio de la lista de modulos
        foreach ($this->modules as $module) {// Lectura de la coleccion de modulos
            if ($this->a_m == $module->url) {   // Verificamos si el modulo que estamos leyendo es el modulo activo
                echo "<li class=\"active\">";   // agregamos la clase active para destacar que este es el modulo donde estamos
                echo "<a href=\"./?m={$module->url}\">"; // tomamos del modulo su url 
                echo "<i class=\"fa fa-{$module->icon}\"></i>"; // su icono
                echo "<span class=\"sb-text\"> {$module->name}</span>"; // Texto, esta dentro de un span con una clase para texto responsivo
                echo "</a>";
                echo "</li>";
            } else {
                echo "<li><a href=\"./?m={$module->url}\"><i class=\"fa fa-{$module->icon}\"></i><span class=\"sb-text\"> {$module->name}</span></a></li>";
            }
        }
        echo "</ul>";
    }

    public function getSidebar($css) { // #Sidebar
        echo "<ul class=\"$css\">"; // Declaracion de la seccion, cargamos una clase para el sidebar
        $ss = $this->modules[$this->a_m]->getSection(); // De los modulos cargados, tomamos el actual, y solicitamos las secciones
        foreach ($ss as $section) { // Por cada una de las secciones
            if ($this->a_s == $section["url"]) { // Verificamos si es la seccion actual
                echo "<li class=\"active\">";
            } else {
                echo "<li>";
            }
            if ($section["url"] == $this->a_s) { // Aqui ponemos las opciones para si estara abierto el nodo o cerrado
                $aria = "true";
                $in = "in";
            } else {
                $aria = "false";
                $in = "";
            }
            //       [                                    ] seccion para decir que este sera en trigger para mostrar las opciones
            echo "<a aria-controls=\"sm_{$section["url"]}\" data-toggle=\"collapse\" href=\"#sm_{$section["url"]}\">";
            echo "<i class=\"fa fa-{$section["icon"]}\"></i><span class=\"sb-text\"> {$section["name"]}</span>";
            echo "</a>";
            $oo = $this->modules[$this->a_m]->getOption($section["url"]);
            if (is_array($oo)) { // [OPCIONES]
                echo "<ul aria-expanded=\"$aria\" id=\"sm_{$section["url"]}\" class=\"nav collapse $in\">";
                foreach ($oo as $option) {
                    echo "<li><a href=\"./?m={$this->a_m}&s={$section["url"]}&o={$option["url"]}\"><i class=\"fa fa-{$option["icon"]}\"></i><span class=\"sb-text\"> {$option["name"]}</span></a></li>";
                }
                echo "</ul>";
            }
            echo "</li>";
        }
        echo "</ul>";
    }

    public function getSubNav($css) {
        $oo = $this->modules[$this->a_m]->getOption($this->a_s);
        if (is_array($oo)) {
            echo "<ul class=\"$css\">";

            foreach ($oo as $option) {
                echo "<li><a href=\"./?m={$this->a_m}&s={$this->a_s}&o={$option["url"]}\"><i class=\"fa fa-{$option["icon"]}\"></i><span class=\"sb-text\"> {$option["name"]}</span></a></li>";
            }
            echo "</ul>";
        }
    }

    public function home() {
        global $m, $s, $o;
        ?>
        <h3><img src = "include/modules/<?php echo $m; ?>/icon.png" /> <?php echo $this->modules[$m]->name;
        ?></h3>
        <?php
        $se = $this->modules[$m]->section;
        foreach ($se as $section) {
            if ($section['url'] != "home") {
                ?>
                <div class="panel panel-default">
                    <div class="panel-heading" style="background:rgba(0,0,0,0.1);border-bottom:1px solid rgba(0,0,0,0.1);padding:8px;color:#039;">
                        <b><img src="include/modules/<?php echo $m; ?>/s.<?php echo $section["url"]; ?>.png" /> <?php echo $section['name']; ?></b>
                    </div>
                    <div class="panel-body">
                        <?php
                        if (isset($this->modules[$m]->option[$section['url']])) {
                            $op = $this->modules[$m]->option[$section['url']];
                            ?>
                            <ul class="nav nav-pills">
                                <?php
                                foreach ($op as $option) {
                                    ?>
                                    <li><a href="./?m=<?php echo $m; ?>&s=<?php echo $section['url']; ?>&o=<?php echo $option['url']; ?>"><?php echo $option['name']; ?></a></li>
                                    <?php
                                }
                                ?>
                            </ul>
                            <?php
                        }
                        ?>
                    </div>
                </div>
                <?php
            }
        }
    }

}
