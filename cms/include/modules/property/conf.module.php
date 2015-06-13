<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "property";
$mod->name = "Propiedades";
$mod->icon = "property";
$mod->desc = "Control de propiedades";
$mod->addSection('Catalogos', 'catalog');
$mod->addOption('catalog', 'General', 0);
$mod->addOption('catalog', 'Interior', 10);
$mod->addOption('catalog', 'Exterior', 20);
$mod->addOption('catalog', 'Equipamiento', 30);
$mod->addOption('catalog', 'Extra', 40);

$mod->addSection('Destinos', 'locale');
$mod->addOption('locale', 'Agregar', 0);
$mod->addOption('locale', 'Administrar', 2);

$mod->addSection('Tipos', 'type');
$mod->addOption('type', 'Agregar', 0);
$mod->addOption('type', 'Administrar', 2);

$mod->addSection('Viviendas', 'housing');
$mod->addOption('housing', 'Agregar', 0);
$mod->addOption('housing', 'Administrar', 2);
//$mod->addOption('housing', 'Imagenes', 8);

//$mod->addSection('Opciones', 'option');
