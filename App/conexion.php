<?php

$user = "root";
$pass = "";
$db = "cotizacion";

$mysqli = new mysqli("localhost", $user, $pass, $db);

if ($mysqli->connect_error) {
  die('Error en la conexión ' . $mysqli->connect_error);
}

// printf("Servidor información: %s\n", $mysqli->server_info);
