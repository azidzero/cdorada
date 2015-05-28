<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

$mod = new MODULE;
$mod->url = "accounting";
$mod->name = "Contabilidad &amp; Finanzas";
$mod->icon = "money";

$mod->addSection("Cuentas", "account", "book");
$mod->addOption("account","Nueva","0","plus");
$mod->addOption("account","Administrar","2","table");

$mod->addSection("Cheques", "check", "book");
$mod->addSection("Gastos", "expense", "book");
$mod->addSection("Movimientos", "movement", "book");
$mod->addSection("Cuentas por cobrar", "cxc", "book");
$mod->addSection("Cuentas por pagar", "cxp", "book");

