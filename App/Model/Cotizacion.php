<?php

require_once("../Lib/DataBase.php");
require_once("UploadFile.php");

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
    $this->uf = new uploadFile();
    //Guardar datos
    $this->setName($name);
    $this->setIdentification($identification);
    $this->setEmail($email);
    $this->setSubject($subject);
    $this->setFiles($files);
  }

  // Insertar nueva cotización
  public function createQuotation()
  {
    $this->setCode($this->generateCode("cotizacion", "COT-"));

    $params = array($this->getCode(), $this->getName(), $this->getIdentification(), $this->getEmail(), $this->getSubject());

    $queryInsert = "INSERT INTO cotizacion (codigo, nombre, cedula, correo, asunto) VALUES (?, ?, ?, ? , ?)";
    $response = $this->db->modification($queryInsert, $params);

    if ($response) {
      $loaded = $this->createDetailQuotation($this->getCode());

      if (!$loaded["success"]) {
        if (!$this->exitsDetail($this->getCode())) {
          //Borrar la cotización ya que no se cargo ningún detalle
          $queryDelete = "DELETE FROM cotizacion WHERE codigo = ?";
          $this->db->modification($queryDelete, array($this->getCode()));
        }
      }

      return $loaded;
    }
  }

  private function createDetailQuotation($codeQuotation)
  {
    $file = array();
    foreach ($this->getFiles()["name"] as $key => $name) {
      $codeDetail = $this->generateCode("cotizacion_detalle", "COTDE-");
      $params = array($codeDetail, " ", $codeQuotation);
      $queryInsert = "INSERT INTO cotizacion_detalle (codigo_detalle, ruta, codigo_cotizacion) VALUES (?, ?, ?)";
      $response = $this->db->modification($queryInsert, $params);

      if ($response) {

        $file["name"] = $this->getFiles()["name"][$key];
        $file["type"] = $this->getFiles()["type"][$key];
        $file["tmp_name"] = $this->getFiles()["tmp_name"][$key];
        $file["error"] = $this->getFiles()["error"][$key];
        $file["size"] = $this->getFiles()["size"][$key];

        $fileLoaded = $this->uf->upload($file, $this->getIdentification(), $codeDetail);

        // si se cargo correctamente
        if ($fileLoaded["success"]) {
          $params = array($fileLoaded["route"], $codeDetail);
          $this->db->modification("UPDATE cotizacion_detalle SET ruta = ? WHERE codigo_detalle = ?", $params);
        } else {
          $this->db->myquery("DELETE FROM cotizacion_detalle WHERE codigo_detalle = ?", array($codeDetail));
          return $fileLoaded;
        }
      }
    }

    return ["success" => true];
  }

  //Genera código automatico para la cotización y el detalle
  public function generateCode($table, $prefix)
  {
    $selectCount = "SELECT COUNT(*) AS cantidad FROM $table";
    $quantity = $this->db->select($selectCount, [], false)["cantidad"];

    $quantity = intval($quantity);

    // Aumentar cantidad encontrada
    $quantity++;

    if ($quantity < 10) {
      return $prefix . "0" . strval($quantity);
    } else {
      return $prefix .= strval($quantity);
    }
  }

  // Si existe detalle, de la cotización
  private function exitsDetail($codeQuotation)
  {
    $result = $this->db->select("SELECT codigo_cotizacion FROM cotizacion_detalle WHERE codigo_cotizacion = ? LIMIT 1", array($codeQuotation), false);

    if (!empty($result)) {
      return true;
    } else {
      return false;
    }
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
