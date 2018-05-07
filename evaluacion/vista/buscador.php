<?php

//Incuimos la conexión a la BD 
include_once '../configuracion/Database.php';
include_once '../modelo/Cliente.php';

$objCliente = new Cliente();

$resultado = $objCliente->buscar($_POST['word']);
