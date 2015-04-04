<?php

class lang {

    private $lang_source;
    private $XML;

    function __construct($lang) {
        $this->lang_source = $lang;
    }
    function getAbrv(){
        return $this->lang_source;
    }
    function loadModule($module) {
        $lang = $this->lang_source;
        $file = "include/modules/$module/$lang.lang.xml";
        if (file_exists($file)) {
            $data = mb_convert_encoding(file_get_contents($file), 'UTF-8');
            $xml = new SimpleXMLElement($data);
            $this->XML = $xml;
        } else {
            $file = "include/modules/$module/es.lang.xml";
        }
    }

    public function getString($se, $str, $lang = "") {
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
