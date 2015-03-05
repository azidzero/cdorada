<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class CORE {

    public $a_m;
    public $a_s;
    public $a_o;
    private $modules = Array();
    private $theme;
    public $CNN;

    function __construct($m, $s, $o, $SQL) {
        $this->a_m = $m;
        $this->a_s = $s;
        $this->a_o = $o;
        $this->CNN = $SQL;
        $this->theme = new theme($this);
        $this->loadModule();
        $this->theme->loader();
    }

    function loadModule() {
        $path = "./include/modules";

        $o = opendir($path);
        while ($file = readdir($o)) {
            if ($file != ".." && $file != "." && is_dir($path . "/" . $file)) {
                $cfg = $path . "/" . $file . "/conf.module.php";
                if (file_exists($cfg)) {
                    unset($mod);
                    include($cfg);
                    $this->modules[$mod->url] = $mod;
                }
            }
        }
    }

    public function getTopNav($css) {
        echo "<ul class=\"$css\">";
        foreach ($this->modules as $module) {
            if ($this->a_m == $module->url) {
                echo "<li class=\"active\"><a href=\"./?m={$module->url}\"><i class=\"fa fa-{$module->icon}\"></i><span class=\"sb-text\"> {$module->name}</span></a></li>";
            } else {
                echo "<li><a href=\"./?m={$module->url}\"><i class=\"fa fa-{$module->icon}\"></i><span class=\"sb-text\"> {$module->name}</span></a></li>";
            }
        }
        echo "</ul>";
    }

    public function getSidebar($css) {
        echo "<ul class=\"$css\">";
        $ss = $this->modules[$this->a_m]->getSection();
        foreach ($ss as $section) {
            if ($this->a_s == $section["url"]) {
                echo "<li class=\"active\">";
            } else {
                echo "<li>";
            }
            if ($section["url"] == $this->a_s) {
                $aria = "true";
                $in="in";
            } else {
                $aria = "false";
                $in="";
            }
            echo "<a aria-controls=\"sm_{$section["url"]}\" data-toggle=\"collapse\" href=\"#sm_{$section["url"]}\"><i class=\"fa fa-{$section["icon"]}\"></i><span class=\"sb-text\"> {$section["name"]}</span></a>";
            $oo = $this->modules[$this->a_m]->getOption($section["url"]);
            if (is_array($oo)) {
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

}
