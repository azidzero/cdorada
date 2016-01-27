<?php

$mod = new MODULE;
$mod->url = "property";
$mod->name = "Alojamientos";
$mod->icon = "property";
$mod->desc = "Control de Alojamientos";
$ur="select * from  cms_catalog where required=0 order by common asc";
$gtc= mysqli_query($this->CNN, $ur);
while($tl= mysqli_fetch_array($gtc))
{
    $mod->addOption('catalog', $tl['common'], $tl['id']);
}
$mod->addSection('Catalogos', 'catalog');
$mod->addOption('catalog', '<b>Administrar</b>', 40);

$mod->addSection('Ubicaciones', 'locale');
$mod->addOption('locale', 'Agregar', 0);
$mod->addOption('locale', 'Administrar', 2);

$mod->addSection('Tipos', 'type');
$mod->addOption('type', 'Agregar', 0);
$mod->addOption('type', 'Administrar', 2);

$mod->addSection('Alojamiento', 'housing');
$mod->addOption('housing', 'Agregar', 0);
$mod->addOption('housing', 'Administrar', 2);


$mod->addSection('Extras', 'extra');
