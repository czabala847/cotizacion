<?php

require_once("./App/Lib/DataBase.php");

$pruebaConexion = new DataBase();
$codigo = 1;
$query = "SELECT * FROM cotizacion";

$result = $pruebaConexion->myquery($query, []);

echo '<pre>';
var_dump($result);
echo '</pre>';
