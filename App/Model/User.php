<?php

require_once("../Lib/DataBase.php");

class User
{
  private $id;
  private $identification;
  private $name;
  private $password;
  private $status;
  private $db;

  public function __construct()
  {
    $this->db = new DataBase();
  }

  public function userRegistered($identification, $pass)
  {
    $querySearch = "SELECT * FROM usuario WHERE cedula = ?";

    $user = $this->db->select($querySearch, array($identification), false);

    if (!empty($user)) {
      if (password_verify($pass, $user["contrasena"])) {
        return true;
      } else {
        return "Contraseña incorrecta";
      }
    } else {
      return "Usuario no encontrado";
    }
  }

  private function existUser($identification)
  {
  }

  public function consultUser($identification, $name, $password)
  {
    $querySearch = "SELECT * FROM usuario WHERE cedula = ?";

    $user = $this->db->select($querySearch, array($identification), false);

    return $user;
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

  public function setIdentification($id)
  {
    $this->id = $id;
  }

  public function setName($name)
  {
    $this->name = $name;
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
