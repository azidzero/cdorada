<?php

$mod = new MODULE;
$mod->url = "crm";
$mod->name = "CRM";
$mod->icon = "crm";
$mod->desc = "Gesti&oacute;n de Relaci&oacute;n con el cliente";

$mod->addSection('Cliente', 'customer');
$mod->addOption('customer', 'Agregar', 0);
$mod->addOption('customer', 'Administrar', 2);

$mod->addSection('Mensajeria', 'messages');
$mod->addOption('messages', 'Agregar', 0);
$mod->addOption('messages', 'Administrar', 2);

/*
$mod->addSection('Empresa', 'corp');
$mod->addOption('corp', 'Agregar', 0);
$mod->addOption('corp', 'Administrar', 2);

$mod->addSection('Contacto', 'contact');
$mod->addOption('contact', 'Agregar', 0);
$mod->addOption('contact', 'Administrar', 2);

$mod->addSection('Actividades', 'activity');
$mod->addOption('activity', 'Agregar', 0);
$mod->addOption('activity', 'Administrar', 2);

$mod->addSection('Catalogos', 'catalog');
$mod->addOption('catalog', 'Actividades', 0);
$mod->addOption('catalog', 'Telefonos', 1);
$mod->addOption('catalog', 'Correo Electronico', 2);
$mod->addOption('catalog', 'Sitio Web', 3);
$mod->addOption('catalog', 'Tipo de Empresa', 4);

*/