<?php

$mod = new MODULE;  // Se declara un nuevo modulo
$mod->url = "warehouse";    // url que usara
$mod->name = "Almac&eacute;n";  // Nombre visible al usuario
$mod->icon = "cubes";           // Icono, esto lo cambiare a arreglo, para que indique si es un icono de fontawesome o imagen
// # Hasta aqui ./?m={warehouse}
$mod->addSection("Almacenes", "store", "building");     // Nueva seccion: Nombre,url,icono o imagen
// # Hasta aqui ./?m={warehouse}&s={store}
$mod->addOption("store", "Nuevo", 0, "plus");           // Nueva Opcion: seccion,nombre,url,icono
// # Hasta aqui ./?m={warehouse}&s={store}&o={0}
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

/*
MODULE[warehouse]
    SECTION[store]
        OPTION[0]
 */
