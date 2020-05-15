<?php
require_once("../Model/User.php");

$user = new User();

if (isset($_POST["modify"])) {
  $result = $user->changeStatus($_GET["id"]);

  echo json_encode($result);
}

$id = $_POST["id"];
$name = $_POST["nombre"];
$email = $_POST["correo"];
$password = $_POST["password"];


$resultUpdate = $user->updateUser($id, $name, $email, $password);

echo json_encode($resultUpdate);
