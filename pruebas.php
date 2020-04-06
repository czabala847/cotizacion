<?php

require_once("./App/Lib/DataBase.php");
// require_once("./App/Model/Cotizacion.php");

// $cotizacion = new Cotizacion("carlos", "1143460015", "ca", "ds", []);
// $code = $cotizacion->generateCode("cotizacion", "COD-");

// echo $code;

$pruebaConexion = new DataBase();
// $query = "SELECT * FROM cotizacion";
$codigo = 2;


// echo '<pre>';
// var_dump($result);
// echo '</pre>';

$query = "DELETE FROM cotizacion WHERE codigo = ?";
$result = $pruebaConexion->modification($query, [$codigo]);

var_dump($result);
