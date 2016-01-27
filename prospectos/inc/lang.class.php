<?php

class lang {

    private $current = "ES";
    private $XML;

    function __construct($module, $lang = "es") {
        $this->current = $lang;
        $file = "include/modules/$module/$lang.lang.xml";

        $data = mb_convert_encoding(file_get_contents($file), 'UTF-8');
        $xml = new SimpleXMLElement($data);
        $this->XML = $xml;
    }
    public function getString($se, $str) {
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
        return utf8_decode($output);
    }

}
