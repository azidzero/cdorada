<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "agency";
$mod->name = "Agencias";
$mod->icon = "agency";

$mod->addSection('Agencias', 'agency');
$mod->addOption('agency', 'Agregar', 0);
$mod->addOption('agency', 'Listar', 2);

$mod->addSection('Agentes', 'agent');
$mod->addOption('agent', 'Agregar', 0);
$mod->addOption('agent', 'Listar', 2);
