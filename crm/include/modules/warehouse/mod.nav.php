<?php

$sub = Array(
    Array("Nuevo", 0),
    Array("Administrar", 2),
    Array("Existencias", 9),
    Array("<i class=\"fa fa-download-alt\"></i> Descargar Lista de Precios", 20),
    Array("<i class=\"fa fa-upload-alt\"></i> Subir Lista de Precios", 21)
);
$nav[] = Array('Productos', 'product', 1, $sub);

$sub = Array(
    Array("Nuevo", 0),
    Array("Administrar", 2)
);
$nav[] = Array('Movimientos', 'move', 1, $sub);

$sub = Array(
    Array("Nuevo", 0),
    Array("Administrar", 2)
);
$nav[] = Array('Unidades de Medida', 'unit', 1, $sub);
$sub = Array(Array("Nuevo", 0), Array("Administrar", 2));
$nav[] = Array("Almacenes", "store", 1, $sub, '');
$sub = Array(
    Array("Nuevo", 0),
    Array("Administrar", 2)
);
$nav[] = Array("Transporte", "carriage", 1, $sub, '');
?>