<?php

require_once "Config.php";

class DataBase
{
  private $link;
  private $user;
  private $pass;
  private $pdo;

  public function __construct()
  {
    $this->link = DB_LINK;
    $this->user = DB_USER;
    $this->pass = DB_PASS;
  }

  private function getConection()
  {

    try {
      $this->pdo = new PDO($this->link, $this->user, $this->pass);
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  //Añadir queries personalizados como update, delete, o insert
  public function myquery($query, $params)
  {

    $this->getConection();
    $stmt = $this->pdo->prepare($query);

    if (empty($params)) {
      $stmt->execute();
    } else {
      $stmt->execute($params);
    }

    $affectedRows = $stmt->rowCount();
    $result = $stmt->fetchAll();

    $stmt = null;
    $this->pdo = null;

    if (!empty($result)) {
      return $result;
    }

    if ($affectedRows > 0) {
      return true;
    }

    return false;
  }
}
