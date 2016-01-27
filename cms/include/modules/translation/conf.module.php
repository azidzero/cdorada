<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "translation";
$mod->name = "Traduccion";
$mod->icon = "translation";

$mod->addSection('Lenguajes', 'lang');
//$mod->addOption('lang', 'Agregar', 0);
//$mod->addOption('lang', 'Administrar', 2);

$mod->addSection('Traducciones', 'translate');
//$mod->addOption('translate', 'Agregar', 0);
//$mod->addOption('translate', 'Administrar', 2);