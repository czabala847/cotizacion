<?php
session_start();
require_once("User.php");

$user = $_POST["cedula"];
$password = $_POST["contraseña"];
$login = $_POST["login"];

// $newUser = new User();

// $response = $newUser->userRegistered($user, $password);

// if ($response) {
//   $_SESSION["newsession"] = $user;
//   // header("Location: ../../nueva-cotizacion.php");
// }

echo json_encode(["Login" => $login]);
