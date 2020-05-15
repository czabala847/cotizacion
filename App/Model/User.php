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
  private $db;

  public function __construct()
  {
    $this->db = new DataBase();
  }

  //Validar si un usuario se encuentra registrado
  private function existUser($identification)
  {
    $querySearch = "SELECT * FROM usuario WHERE cedula = ?";
    $user = $this->db->select($querySearch, array($identification), false);

    //Si se encuentra retornar el resultado de la consulta
    if (!empty($user)) {
      return $user;
    } else {
      return false;
    }
  }

  //Login
  public function signIn($identification, $pass)
  {

    $user = $this->existUser($identification);

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

  //Guardar datos del usuario
  private function saveUser($name, $email, $password)
  {

    $this->setName($name);
    $this->setEmail($email);
    $this->setPassword(password_hash($password, PASSWORD_DEFAULT));
    $this->setStatus("A");
  }

  //Registro
  public function signUp($identification, $name, $email, $password)
  {
    $user = $this->existUser($identification);

    if (!$user) {

      $this->saveUser($name, $email, $password);
      $this->setIdentification($identification);
      $queryInsert = "INSERT INTO usuario (cedula, nombre, correo, contrasena, estado) VALUES (?, ?, ?, ?, ?)";
      $response = $this->db->modification($queryInsert, array($this->getIdentification(), $this->getName(), $this->getEmail(), $this->getPassword(), $this->getStatus()));

      if ($response) {
        return $response;
      } else {
        return "Ha ocurrido un error al crear el usuario";
      }
    } else {
      return "usuario ya se encuentra creado";
    }
  }


  public function updateUser($id, $name, $email, $password)
  {
    $user = $this->getUser($id);
    if ($user) {
      $this->saveUser($name, $email, $password);
      $this->setId($id);

      $queryUpdate = "UPDATE usuario SET nombre = ?, correo = ?, contrasena = ? WHERE id = ?";
      $response = $this->db->modification($queryUpdate, array($this->getName(), $this->getEmail(), $this->getPassword(), $this->getId()));
      if ($response) {
        return "Actualizado con exito";
      } else {
        return "Ha ocurrido un error al actualizar el usuario";
      }
    }
  }

  //Buscar usuario por id
  public function getUser($id)
  {
    $query = "SELECT * FROM usuario WHERE id = ?";
    return $this->db->select($query, array($id), false);
  }

  //Mostrar todos los usuarios
  public function getAllUsers()
  {
    $query = "SELECT * FROM usuario";
    return $this->db->select($query, array(), true);
  }

  public function changeStatus($id)
  {
    $user = $this->getUser($id);
    $queryUpdate = "UPDATE usuario SET estado = ? WHERE id = ?";
    $messageModification = "activado";

    if ($user) {
      if ($user["estado"] === 'A') {
        $response = $this->db->modification($queryUpdate, array('I', $id));
        $messageModification = 'desactivado';
      } else {
        $response = $this->db->modification($queryUpdate, array('A', $id));
      }

      if ($response) {
        return "Usuario $messageModification con éxito";
      } else {
        return "Ocurrio un error al modificar el usuario";
      }
    } else {
      return "Usuario a modificar no existe";
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
}
