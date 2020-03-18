<?php

require_once "../Lib/DataBase.php";
require_once "UploadFile.php";

class Cotizacion
{
  private $code;
  private $name;
  private $identification;
  private $email;
  private $subject;
  private $files;
  private $db;
  private $uf;

  public function __construct($name, $identification, $email, $subject, $files)
  {
    $this->db = new DataBase();
    $this->uf = new uploadFile($files);
    //Guardar datos
    $this->setName($name);
    $this->setIdentification($identification);
    $this->setEmail($email);
    $this->setSubject($subject);
    $this->setFiles($files);
  }

  //Insertar nueva cotización
  public function createQuotation()
  {

    //Archivo cargado
    $fileLoaded = $this->uf->uploadFile($this->getIdentification());

    if ($fileLoaded["success"]) {
      //Traer código generado automaticamente
      $this->setCode($this->generateCodeQuotation());

      //Insertar cotización
      $queryInsert = "INSERT INTO cotizacion (codigo, nombre, cedula, correo, asunto) VALUES ('" . $this->getCode() . "', '" . $this->getName() . "', '" . $this->getIdentification() . "', '" . $this->getEmail() . "', ' " . $this->getSubject() . "')";
      $response = $this->db->myquery($queryInsert);

      //Recorrer las rutas donde se guardaron los archivos que fueron guardados en el servidor
      foreach ($fileLoaded["data"]["route"] as $route) {
        $qInsertDetailFile = "INSERT INTO cotizacion_detalle (ruta, codigo_cotizacion) VALUES ('" . $route . "', '" . $this->getCode() . "')";
        $this->db->myquery($qInsertDetailFile);
      }

      if ($response) {
        return ["success" => true];
      } else {
        return ["success" => false, "errorMessage" => "A ocurrido un error al guardar la cotización"];
      }
    } else {
      return $fileLoaded;
    }
  }

  //Crear código automatico de la cotizacion
  public function generateCodeQuotation()
  {

    /* Obtener cantidad de registros en la tabla de cotizacion */
    $queryQuantityQuotation = "SELECT COUNT(*) AS cantidad FROM cotizacion";

    /*Obtener cantidad del array asociativo y convertirlo a número */
    $quantity = intval($this->db->select($queryQuantityQuotation, true)["cantidad"]);

    $codeQuotation = "COT-";

    //Aumentar cantidad encontrada
    $quantity++;

    if ($quantity < 10) {
      $codeQuotation .= "0" . strval($quantity);
    } else {
      $codeQuotation .= strval($quantity);
    }

    return $codeQuotation;
  }


  /* Getters y Setters */
  public function getCode()
  {
    return $this->code;
  }

  public function getName()
  {
    return $this->name;
  }

  public function getIdentification()
  {
    return $this->identification;
  }

  public function getEmail()
  {
    return $this->email;
  }

  public function getSubject()
  {
    return $this->subject;
  }

  public function getFiles()
  {
    return $this->files;
  }

  public function setCode($code)
  {
    return $this->code = $code;
  }

  public function setName($name)
  {
    return $this->name = $name;
  }

  public function setIdentification($identification)
  {
    return $this->identification = $identification;
  }

  public function setEmail($email)
  {
    return $this->email = $email;
  }

  public function setSubject($subject)
  {
    return $this->subject = $subject;
  }

  public function setFiles($files)
  {
    return $this->files = $files;
  }
}
