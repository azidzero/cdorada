<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "templates";
$mod->name = "Plantillas";
$mod->icon = "template";

$mod->addSection('Plantillas', 'template');
$mod->addOption('template', 'Agregar', 0);
$mod->addOption('template', 'Listar', 2);

$mod->addSection('Variables', 'var');
$mod->addOption('var', 'Agregar', 0);
$mod->addOption('var', 'Listar', 2);