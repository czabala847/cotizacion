<?php
// sleep(5);
require_once("../Model/User.php");

$identification = $_POST["cedula"];
$password = $_POST["contraseña"];
$login = $_POST["login"];

$newUser = new User();


if ($login === 'sign-in') {
  $response = $newUser->signIn($identification, $password);
} else {
  $name = $_POST["nombre"];
  $email = $_POST["email"];
  $response = $newUser->signUp($identification, $name, $email, $password);
}

if ($response === true) {

  if ($login === 'sign-in') {
    session_start();
    $_SESSION["newsession"] = $identification;
    // header("Location: ../../nueva-cotizacion.php");
  }
  echo json_encode(["success" => true, "login" => $login]);
} else {
  echo json_encode(["success" => false, "errorMessage" => $response]);
}
