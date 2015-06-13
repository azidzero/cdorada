<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "web";
$mod->name = "Sitio Web";
$mod->icon = "web";

$mod->addSection('Destacados', 'featured', '');
$mod->addOption('featured', 'Agregar', 0);
$mod->addOption('featured', 'Administrar', 2);

$mod->addSection('Actividades', 'activity', '');
$mod->addOption('activity', 'Agregar', 0);
$mod->addOption('activity', 'Administrar', 2);

$mod->addSection('Info. Viaje', 'info', '');
$mod->addOption('info', 'Agregar', 0);
$mod->addOption('info', 'Administrar', 2);
