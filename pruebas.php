<?php

// require_once("./App/Model/DataBase.php");
// require_once("./App/Model/Cotizacion.php");


// $pruebaConexion = new DataBase();
// $codigo = 2;

// $selectCount = "SELECT COUNT(*) AS cantidad FROM cotizacion";
// $quantity = intval($this->db->select($selectCount, true)["cantidad"]);
// $result = $pruebaConexion->select("SELECT codigo_cotizacion FROM cotizacion_detalle WHERE codigo_cotizacion = ? LIMIT 1", array("s"), false);


// var_dump($result);


// if (!empty($result)) {
//   echo "yeah";
// } else {
//   echo "nooo";
// }

// $params = array("carlos zabala", "1143460015", "czabala847@gmail.com", "");

// $id = $pruebaConexion->getIdQuery();
// echo $id;

// $queryInsert = "INSERT INTO cotizacion (nombre, cedula, correo, asunto) VALUES (?, ?, ? , ?)";
// $response = $pruebaConexion->modification($queryInsert, $params);

echo password_hash("1234", PASSWORD_DEFAULT) . "\n";
