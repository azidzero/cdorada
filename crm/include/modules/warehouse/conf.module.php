<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "warehouse";
$mod->name = "Almac&eacute;n";
$mod->icon = "cubes";

$mod->addSection("Almacenes", "store", "building");
$mod->addOption("store", "Nuevo", 0, "plus");
$mod->addOption("store", "Administrar", 2, "table");

$mod->addSection("Categor&iacute;as", "cat", "tags");
$mod->addOption("cat", "Nuevo", 0, "plus");
$mod->addOption("cat", "Administrar", 2, "table");

$mod->addSection("Productos", "product", "cube");
$mod->addOption("product", "Nuevo", 0, "plus");
$mod->addOption("product", "Administrar", 2, "table");
$mod->addOption("product", "Existencias", 7, "th");
$mod->addOption("product", "Descargar Lista de Precios", 9, "download");
$mod->addOption("product", "Cargar Lista de Precios", 1, "upload");

$mod->addSection("Movimientos", "movement", "refresh");
$mod->addOption("movement", "Nuevo", 0, "plus");
$mod->addOption("movement", "Administrar", 2, "table");

$mod->addSection("Unidades de Medida", "um", "sliders");
$mod->addOption("um", "Nuevo", 0, "plus");
$mod->addOption("um", "Administrar", 2, "table");

$mod->addSection("Transporte", "carriage", "truck");
$mod->addOption("carriage", "Nuevo", 0, "plus");
$mod->addOption("carriage", "Administrar", 2, "table");

