<?php

require_once "Config.php";

class DataBase
{
  private $link;
  private $user;
  private $pass;
  private $pdo;
  private $idQuery;

  public function __construct()
  {
    $this->link = DB_LINK;
    $this->user = DB_USER;
    $this->pass = DB_PASS;
    $this->idQuery = 0;
  }

  private function getConection()
  {

    try {
      $this->pdo = new PDO($this->link, $this->user, $this->pass);
      $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
    } catch (PDOException $e) {
      print "¡Error!: " . $e->getMessage() . "<br/>";
      die();
    }
  }

  private function myQuery($query, $params)
  {

    try {
      $this->getConection();
      $stmt = $this->pdo->prepare($query);

      if (empty($params)) {
        $stmt->execute();
      } else {

        $stmt->execute($params);
      }

      // print_r($stmt->errorInfo());

      $auxStmt = $stmt;

      //Guardar id de la fila afectada
      $this->setIdQuery($this->pdo->lastInsertId());

      //cerrar conexión
      $stmt = null;
      $this->pdo = null;

      return $auxStmt;
    } catch (Exception $e) {
      return $e->getMessage();
    }
  }

  //Para los select
  public function select($query, $params, $all)
  {
    $result = $this->myQuery($query, $params);

    if ($all) {
      return $result->fetchAll(PDO::FETCH_ASSOC);
    }

    return $result->fetch();
  }

  //Añadir queries personalizados como update, delete, o insert
  public function modification($query, $params)
  {

    $result = $this->myQuery($query, $params);
    $affectedRows =   $result->rowCount();

    $result = null;

    if ($affectedRows > 0) {
      return true;
    }
    return false;
  }

  public function getIdQuery()
  {
    return $this->idQuery;
  }

  private function setIdQuery($idQuery)
  {
    $this->idQuery = $idQuery;
  }
}
