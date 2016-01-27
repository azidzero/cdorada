<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class MODULE {

    public $name;
    public $url;
    public $icon;
    public $section = Array();
    public $option = Array();
    public $public = true;

    function __construct() {
        $this->addSection("Inicio", "home", "home");
        // $this->addOption("home", "", 0, "dashboard");
    }

    function addSection($name, $url, $icon = "") {
        $arr = Array("name" => $name, "url" => $url, "icon" => $icon);
        $this->section[] = $arr;
    }

    function addOption($section, $name, $url, $icon = '') {
        $arr = Array("name" => $name, "url" => $url, "icon" => $icon);
        $this->option[$section][] = $arr;
    }

    function getSection() {
        return $this->section;
    }

    function getOption($section) {
        if (isset($this->option[$section])) {
            return $this->option[$section];
        }
    }

}
