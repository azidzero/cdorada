<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "contacts";
$mod->name = "Contactos";
$mod->icon = "contact";

/*
$mod->addSection('Contacto', 'contact', ''); // Agrega una sección al menu
$mod->addOption("contact", "Nuevo", "0", "plus");
$mod->addOption("contact", "Administrar", "2", "table");

$mod->addSection('Empresas', 'enterprise', '');
$mod->addOption("enterprise", "Nueva", "0", "plus");
$mod->addOption("enterprise", "Administrar", "2", "table");
 * 
 */

$mod->addSection('Nueva persona', 'contact', '');
//$mod->addOption("contact", "Nuevo", "0", "plus");

$mod->addSection('Administrar personas', 'admin', '');
//$mod->addOption("admin", "Administrar", "0", "table");