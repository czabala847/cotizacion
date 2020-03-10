<?php

$nombre = $_POST['nombre'];
$cedula = $_POST['cedula'];

$array = ["nombre" => $nombre, "cedula" => $cedula];

echo json_encode($array);
