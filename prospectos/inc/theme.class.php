<?php

class theme {

    public $theme = "default";
    private $C;
    private $path;

    function __construct($C) {
        $this->C = $C;
    }

    function loader() {
        $this->path = "include/themes/{$this->theme}";
        include($this->path . "/index.thm.php");
    }

}
