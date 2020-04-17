<?php

require_once("../Lib/DataBase.php");

class User
{
  private $id;
  private $identification;
  private $name;
  private $password;
  private $status;

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

  // public function __construct($name, $identification, $email, $subject, $files)
  // {
  //   $this->db = new DataBase();
  //   $this->uf = new uploadFile();
  //   //Guardar datos
  //   $this->setName($name);
  //   $this->setIdentification($identification);
  //   $this->setEmail($email);
  //   $this->setSubject($subject);
  //   $this->setFiles($files);
  // }
}
