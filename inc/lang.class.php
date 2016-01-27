<?php

class lang {

    private $lang_source;
    private $XML;

    function __construct($lang) {
        $this->lang_source = $lang;
    }

    function getAbrv() {
        return $this->lang_source;
    }

    function loadModule($module) {
        $lang = $this->lang_source;
        $file = "include/lang/$lang.lang.xml";
        $dfile = "include/lang/es.lang.xml";
        if (file_exists($file) || file_exists("../../../" . $file)) {
            if (file_exists($file)) {
                $data = mb_convert_encoding(file_get_contents($file), 'UTF-8');
            } else {
                $data = mb_convert_encoding(file_get_contents("../../../" . $file), 'UTF-8');
            }
            $xml = new SimpleXMLElement($data);
            $this->XML = $xml;
        } elseif (file_exists($dfile) || file_exists("../" . $dfile) || file_exists("../../" . $dfile)) {
            $file = "include/lang/es.lang.xml";
            $data = mb_convert_encoding(file_get_contents($file), 'UTF-8');
            $xml = new SimpleXMLElement($data);
            $this->XML = $xml;
        } else {
            echo "<span class=\"label label-danger\">Not Found!!! $file: " . __DIR__ . "</span>";
        }
    }

    public function getString($se, $str, $lang = "es") {
        $output = "";
        foreach ($this->XML->sections->section as $section) {
            if ($section["name"] == $se) {
                $sel = $section;
                break;
            }
        }
        foreach ($sel->string as $string) {
            if ($string["name"] == $str) {
                $output = $string;
                break;
            }
        }
        if ($output == "") {
            $output = "%$str%";
        }
        return utf8_decode($output);
    }

}
