<?php

/*
 * Configuracion para el Modulo de Respaldos
 */

class modservice extends module {

    function __construct() {
        $this->name = "<i class=\"fa fa-wrench\"></i> &Oacute;rdenes de Servicio";
        $this->url = "service";
        $this->pre = "service";
        $this->desc = "&Oacute;rdenes de Servicio";
        $this->hasWidget = true;
        $this->hasNav = true;
        $this->hasNotify = false;
        include('mod.nav.php');
        $this->nav = $nav;
    }

}

$mod = new modservice();