<?php

require_once("./App/Lib/DataBase.php");
// require_once("./App/Model/Cotizacion.php");


$pruebaConexion = new DataBase();
$codigo = 2;

$selectCount = "SELECT COUNT(*) AS cantidad FROM cotizacion";
// $quantity = intval($this->db->select($selectCount, true)["cantidad"]);
$result = $pruebaConexion->select("SELECT codigo_cotizacion FROM cotizacion_detalle WHERE codigo_cotizacion = ? LIMIT 1", array("s"), false);


// var_dump($result);


if (!empty($result)) {
  echo "yeah";
} else {
  echo "nooo";
}
