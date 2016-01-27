<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "reservas";
$mod->name = "Reservas";
$mod->icon = "reser";

$mod->addSection('Reservas', 'reservas');
$mod->addOption('reservas', 'Agregar', 0);
$mod->addOption('reservas', 'Listar', 10);