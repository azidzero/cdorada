<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "service";
$mod->name = "Servicios";
$mod->icon = "cogs";

$mod->addSection("&Aacute;reas de Servicio", "area", "book");
$mod->addOption("area", "Nueva", "0", "plus");
$mod->addOption("area", "Administrar", "2", "table");

$mod->addSection("Accesorios", "accesory", "book");
$mod->addOption("accesory", "Nueva", "0", "plus");
$mod->addOption("accesory", "Administrar", "2", "table");

$mod->addSection("Servicios", "service", "book");
$mod->addOption("service", "Nueva", "0", "plus");
$mod->addOption("service", "Administrar", "2", "table");

$mod->addSection("&Oacute;rden de Servicio", "order", "book");
$mod->addOption("order", "Nueva", "0", "plus");
$mod->addOption("order", "Administrar", "2", "table");
