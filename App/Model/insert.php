<?php

require_once "./UploadFile.php";
require_once "./Cotizacion.php";

$name = $_POST['nombre'];
$identification = $_POST['cedula'];
$email = $_POST['correo'];
$subject = $_POST['asunto'];
$file = $_FILES['archivo'];



$cotizacion = new Cotizacion($name, $identification, $email, $subject, $file);

$result = $cotizacion->createQuotation();
echo json_encode($result);
