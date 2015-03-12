<?php

class lang {

    private $lang_source;
    private $XML;

    function __construct($lang) {
        $this->lang_source = $lang;
    }

    function loadModule($module) {
        $lang = $this->lang_source;
        $file = "include/modules/$module/$lang.lang.xml";
        if (file_exists($file)) {            
            $data = mb_convert_encoding(file_get_contents($file),'UTF-8');
            $xml = simplexml_load_string($data);
            $json = json_Encode($xml);
            $jsono = json_decode($json,true);
            $this->XML = $jsono;
        } else {
            echo "No existe el archivo";
        }
    }

    public function getString($module, $section, $string, $lang = "") {
        foreach($this->XML as $K=>$STR){
        print_r($K);
        echo "<hr noshade />";
        print_r($STR);
        }
    }

}
