<?php

require "../conexion.php";

$name = $_POST['nombre'];
$identityCard = $_POST['cedula'];
$email = $_POST['correo'];
$subject = $_POST['asunto'];

$queryInsert = "INSERT INTO cotizacion (nombre, cedula, correo, asunto) VALUES ('$name', '$identityCard', '$email', '$subject')";

$response = $mysqli->query($queryInsert);

if ($response) {
  echo "Correcto";
} else {
  echo "Algo falló";
}
