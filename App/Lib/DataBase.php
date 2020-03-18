<?php

require_once "Config.php";

class DataBase
{
  public $host;
  public $user;
  public $pass;
  public $dbname;
  public $mysqli;

  public function __construct()
  {
    $this->host = DB_HOST;
    $this->user = DB_USER;
    $this->pass = DB_PASS;
    $this->dbname = DB_NAME;
    $this->getConection();
  }

  public function getConection()
  {
    $this->mysqli = new mysqli($this->host, $this->user, $this->pass, $this->dbname);

    if ($this->mysqli->connect_error) {
      die('Error en la conexión ' . $this->mysqli->connect_error);
    } else {
      return $this->mysqli;
    }

    // printf("Servidor información: %s\n", $mysqli->server_info);
  }

  public function select($query, $fetchArray)
  {
    $result = $this->mysqli->query($query) or die($this->mysqli->error . __LINE__);
    if ($result->num_rows > 0) {
      if ($fetchArray) {
        return $result->fetch_array(MYSQLI_ASSOC);
      } else {
        return $result;
      }
    } else {
      return false;
    }
  }

  //Añadir queries personalizados como update, delete, o insert
  public function myquery($query)
  {
    $mysquery = $this->mysqli->query($query) or die($this->mysqli->error . __LINE__);
    if ($mysquery) {
      return $mysquery;
    } else {
      return false;
    }
  }
}
