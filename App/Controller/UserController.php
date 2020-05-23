<?php
// sleep(5);
require_once("../Model/User.php");

$user = new User();

if (isset($_POST["modify"])) {

  //Parte de activar y desactivar usuarios
  if ($_POST["modify"] === "status") {
    $result = $user->changeStatus($_GET["id"]);
    echo json_encode($result);
  }

  //Parte de modificar usuarios
  elseif ($_POST["modify"] === "update") {
    $id = $_POST["id"];
    $name = $_POST["nombre"];
    $email = $_POST["correo"];

    //Validar si se quiere actualizar tambien la contraseña
    if (isset($_POST["password"])) {
      $password = $_POST["password"];
      $resultUpdate = $user->updateUser($id, $name, $email, $password);
    } else {
      $resultUpdate = $user->updateUser($id, $name, $email);
    }
    echo json_encode($resultUpdate);
  }
}

//Mostrar usuarios en tiempo
if (isset($_POST["value"])) {
  $page = $_POST["page"];
  $data = $user->getAllUsers($_POST["value"], $page);
  $listUser = $data["data"];
  $page = $data["page"];
  require_once("../View/UserTable.php");
}
