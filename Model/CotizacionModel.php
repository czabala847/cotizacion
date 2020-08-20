<?php

require_once("UploadFile.php");

class CotizacionModel
{
  private $code;
  private $name;
  private $identification;
  private $email;
  private $subject;
  private $files;
  private $db;
  private $uf;

  public function __construct()
  {
    $this->db = new Mysql();
    $this->uf = new uploadFile();
  }

  // Crear cotización
  public function createQuotation(string $name, string $identification, string $email, string $subject, $files)
  {
    //Guardar datos
    $this->setName($name);
    $this->setIdentification($identification);
    $this->setEmail($email);
    $this->setSubject($subject);
    $this->setFiles($files);

    $arrParams = array($this->getName(), $this->getIdentification(), $this->getEmail(), $this->getSubject());
    $strQueryInsert = "INSERT INTO cotizaciones (nombre, cedula, correo, asunto) VALUES (?, ?, ?, ?)";

    $responseInsert = $this->db->insert($strQueryInsert, $arrParams);
    //Codigo de la cotización, es el id que se genera automaticamente de la base de datos
    $this->setCode($responseInsert);

    if ($responseInsert > 0) {
      $loaded = $this->createDetailQuotation($this->getCode(), $this->getIdentification(), $this->getFiles());

      if (!$loaded["success"]) {
        if (!$this->exitsDetail($this->getCode())) {
          //Borrar la cotización ya que no se cargo ningún detalle
          $queryDelete = "DELETE FROM cotizaciones WHERE id = ?";
          $this->db->update($queryDelete, array($this->getCode()));
        }
      }

      return $loaded;
    }
  }

  // Insertar detalle de la cotización
  private function createDetailQuotation(int $codeQuotation, string $identificationUser, $files)
  {
    $newFile = array(); //crear array asociativo, por cada archivo cargado
    foreach ($files["name"] as $key => $value) {

      $strQueryInsert = "INSERT INTO cotizaciones_detalle (ruta, codigo_cotizacion) VALUES (?, ?)";
      //Ruta vacia, y id de la cotización
      $arrParams = array(" ", $codeQuotation);
      $responseInsert = $this->db->insert($strQueryInsert, $arrParams);

      $idDetail = $responseInsert;

      if ($responseInsert > 0) {

        $newFile["name"] = $files["name"][$key];
        $newFile["type"] = $files["type"][$key];
        $newFile["tmp_name"] = $files["tmp_name"][$key];
        $newFile["error"] = $files["error"][$key];
        $newFile["size"] = $files["size"][$key];

        $fileLoaded = $this->uf->upload($newFile, $identificationUser, $idDetail);

        // si se cargo correctamente, guardar la ruta en base de datos
        if ($fileLoaded["success"]) {
          $arrParams = array($fileLoaded["route"], $idDetail);
          $this->db->insert("UPDATE cotizaciones_detalle SET ruta = ? WHERE id = ?", $arrParams);
        } else {
          $this->db->update("DELETE FROM cotizaciones_detalle WHERE id = ?", array($idDetail));
          return $fileLoaded;
        }
      }
    }

    return ["success" => true, "detalle" => $idDetail];
  }

  // Si existe detalle, de la cotización
  private function exitsDetail(int $codeQuotation)
  {
    $result = $this->db->select("SELECT codigo_cotizacion FROM cotizaciones_detalle WHERE codigo_cotizacion = ? LIMIT 1", array($codeQuotation));

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

  public function setCode(int $code)
  {
    return $this->code = $code;
  }

  public function setName(string $name)
  {
    return $this->name = $name;
  }

  public function setIdentification(string $identification)
  {
    return $this->identification = $identification;
  }

  public function setEmail(string $email)
  {
    return $this->email = $email;
  }

  public function setSubject(string $subject)
  {
    return $this->subject = $subject;
  }

  public function setFiles($files)
  {
    return $this->files = $files;
  }
}
