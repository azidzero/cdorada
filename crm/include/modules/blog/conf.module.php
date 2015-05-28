<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "blog";
$mod->name = "Actividades";
$mod->icon = "dashboard";

$mod->addSection('Categor&iacute;as', 'category', '');
$mod->addOption('category', 'Agregar', 0);
$mod->addOption('category', 'Administrar', 2);

$mod->addSection('P&aacute;ginas', 'page', '');
$mod->addOption('page', 'Agregar', 0);
$mod->addOption('page', 'Administrar', 2);

$mod->addSection('Publicaciones', 'post', '');
$mod->addOption('post', 'Agregar', 0);
$mod->addOption('post', 'Administrar', 2);
