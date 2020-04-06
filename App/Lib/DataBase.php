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

  private function myQuery($query, $params)
  {
    $this->getConection();
    $stmt = $this->pdo->prepare($query);

    if (empty($params)) {
      $stmt->execute();
    } else {
      $stmt->execute($params);
    }

    $auxStmt = $stmt;

    $stmt = null;
    $this->pdo = null;

    return $auxStmt;
  }

  //Para los select
  public function select($query, $params, $assoc)
  {
    $result = $this->myQuery($query, $params);

    if ($assoc) {
      return $result->fetchAll();
    }

    return $result->fetch();
  }

  //Añadir queries personalizados como update, delete, o insert
  public function modification($query, $params)
  {

    $result = $this->myQuery($query, $params);
    $affectedRows =   $result->rowCount();

    if ($affectedRows > 0) {
      return true;
    }
    return false;
  }
}
