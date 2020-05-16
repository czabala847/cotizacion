<?php
// sleep(5);
require_once("../Model/User.php");

$user = new User();

if (isset($_POST["modify"])) {

  $result = $user->changeStatus($_GET["id"]);
  echo json_encode($result);
}

// $id = $_POST["id"];
// $name = $_POST["nombre"];
// $email = $_POST["correo"];

// //Validar si se quiere actualizar tambien la contraseña
// if (isset($_POST["password"])) {
//   $password = $_POST["password"];
//   $resultUpdate = $user->updateUser($id, $name, $email, $password);
// } else {
//   $resultUpdate = $user->updateUser($id, $name, $email);
// }



// echo json_encode($resultUpdate);
// echo json_encode($password);
