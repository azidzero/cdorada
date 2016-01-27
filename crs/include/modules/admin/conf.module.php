<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "admin";
$mod->name = "Administracion";
$mod->icon = "admin";
$mod->desc = "Consola de Administracion";
$mod->public = false;
$mod->addSection('Usuarios', 'user');
$mod->addOption('user', 'Agregar', 0);
$mod->addOption('user', 'Administrar', 2);


