<?php
session_start();
require_once("User.php");

$user = $_POST["usuario"];
$password = $_POST["contraseña"];

$newUser = new User();

$response = $newUser->userRegistered($user, $password);

if ($response) {
  $_SESSION["newsession"] = $user;
  // header("Location: ../../nueva-cotizacion.php");
}

echo json_encode($response);
