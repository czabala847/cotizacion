<?php

require_once("DataBase.php");

class User
{
  private $id;
  private $identification;
  private $name;
  private $email;
  private $password;
  private $status;
  private $rol;
  private $db;

  public function __construct()
  {
    $this->db = new DataBase();
  }

  //Guardar en variables datos del usuario
  private function saveDataUser($name, $email, $password)
  {

    $this->setName($name);
    $this->setEmail($email);
    $this->setPassword(password_hash($password, PASSWORD_DEFAULT));
    $this->setStatus("A");
    $this->setRol(2);
  }

  //Registro
  public function createUser($identification, $name, $email, $password)
  {
    $newUser = $this->searchUser($identification, true);

    if (!$newUser) {
      //Guardar datos
      $this->saveDataUser($name, $email, $password, 2);
      $this->setIdentification($identification);
      $queryInsert = "INSERT INTO usuario (cedula, nombre, correo, contrasena, estado, rol) VALUES (?, ?, ?, ?, ?, ?)";
      $response = $this->db->modification($queryInsert, array($this->getIdentification(), $this->getName(), $this->getEmail(), $this->getPassword(), $this->getStatus(), $this->getRol()));

      if ($response) {
        return $response;
      } else {
        return "Ha ocurrido un error al crear el usuario";
      }
    } else {
      return "usuario ya se encuentra creado";
    }
  }

  //Validar si un usuario se encuentra registrado, buscar en la columna ingresado por parametro
  public function searchUser($id, $searchIdentification = false)
  {

    $searchColum = "id";

    if ($searchIdentification) {
      $searchColum = "cedula";
    }

    $querySearch = "SELECT * FROM usuario WHERE $searchColum = ?";
    $userFound = $this->db->select($querySearch, array($id), false);

    //Si se encuentra retornar el resultado de la consulta
    if (!empty($userFound)) {
      return $userFound;
    } else {
      return false;
    }
  }

  //Login
  public function login($identification, $pass)
  {

    $user = $this->searchUser($identification, true);

    if (!$user) {
      return "El usuario ingresado no existe";
    } else if (password_verify($pass, $user["contrasena"])) {
      if ($user["estado"] === 'A') {
        return true;
      } else {
        return "Usuario se encuentra inactivo";
      }
    } else {
      return "Contraseña incorrecta";
    }
  }

  public function updateUser(int $id, string $name, string $email, int $rol, $password = false)
  {
    $userFound = $this->searchUser($id);
    if ($userFound) {
      $this->saveDataUser($name, $email, $password);
      $this->setId($id);
      $this->setRol($rol);

      $queryUpdate = "UPDATE usuario SET nombre = ?, correo = ?, rol = ? WHERE id = ?";
      $params = array($this->getName(), $this->getEmail(), $this->getRol(), $this->getId());

      //Si tambien se actualiza la contraseña
      if ($password) {
        $queryUpdate = "UPDATE usuario SET nombre = ?, correo = ?, rol = ?, contrasena = ? WHERE id = ?";
        $params = array($this->getName(), $this->getEmail(), $this->getRol(), $this->getPassword(), $this->getId());
      }

      $response = $this->db->modification($queryUpdate, $params);
      if ($response) {
        return ["success" => true, "message" => "Actualizado con exito"];
      } else {
        return ["success" => false, "message" => "Ha ocurrido un error al actualizar el usuario"];
      }
    }
  }

  //Mostrar todos los usuarios
  public function getAllUsers($value, $page = 0)
  {
    define("LIMIT", 5);
    $index = $page * LIMIT;
    // $query = "SELECT * FROM usuario";
    // $params = array();
    $search = "%$value%";
    $params = array($search, $search, $search);

    $queryCount = "SELECT COUNT(*) Cantidad FROM usuario WHERE nombre LIKE ? OR cedula LIKE ? OR correo LIKE ?";
    $resultCount = $this->db->select($queryCount, $params, false);
    $numberPages = ceil(intval($resultCount["Cantidad"]) / LIMIT);

    $query = "SELECT U.id, U.cedula, U.nombre, U.correo, U.estado, R.nombre rol FROM usuario U INNER JOIN rol R ON U.rol = R.id WHERE U.nombre LIKE ? OR U.cedula LIKE ? OR U.correo LIKE ? LIMIT $index, " . LIMIT;
    // if ($value != "") {
    // }

    return ["data" => $this->db->select($query, $params, true), "page" => $page, "numberPages" => $numberPages];
  }

  //Cambiar estado del usuario
  public function changeStatus($id)
  {
    $user = $this->searchUser($id);
    $queryUpdate = "UPDATE usuario SET estado = ? WHERE id = ?";
    $messageModification = "activado";
    if ($user) {
      if ($user["estado"] == 'A') {
        $response = $this->db->modification($queryUpdate, array("I", $id));
        $messageModification = 'desactivado';
      } else {
        $response = $this->db->modification($queryUpdate, array("A", $id));
      }

      if ($response) {
        return "Usuario $messageModification con éxito";
      } else {
        return "Ocurrio un error al cambiar el estado del usuario";
      }
    } else {
      return "Usuario a modificar el estado no existe";
    }
  }

  public function getId()
  {
    return $this->id;
  }

  public function getIdentification()
  {
    return $this->identification;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getPassword()
  {
    return $this->password;
  }

  public function getStatus()
  {
    return $this->status;
  }

  public function setId($id)
  {
    $this->id = $id;
  }

  public function setIdentification($identification)
  {
    $this->identification = $identification;
  }

  public function setName($name)
  {
    $this->name = $name;
  }

  public function setEmail($email)
  {
    $this->email = $email;
  }

  public function setPassword($password)
  {
    $this->password = $password;
  }

  public function setStatus($status)
  {
    $this->status = $status;
  }

  public function setRol($rol)
  {
    $this->rol = $rol;
  }

  public function getRol()
  {
    return $this->rol;
  }
}
