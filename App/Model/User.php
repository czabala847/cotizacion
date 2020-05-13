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
      return true;
    } else {
      return "Contraseña incorrecta";
    }
  }

  //Registro
  public function signUp($identification, $name, $email, $password)
  {
    $user = $this->existUser($identification);

    if (!$user) {

      //Guardar los parametros
      $this->setIdentification($identification);
      $this->setName($name);
      $this->setEmail($email);
      $this->setPassword(password_hash($password, PASSWORD_DEFAULT));
      $this->setStatus("A");

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

  public function showAllUser()
  {
    $query = "SELECT * FROM usuario";
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
