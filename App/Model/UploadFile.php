<?php

class uploadFile
{
  private $file;
  private $fileExtensions;
  private $maxFileSize;

  public function __construct($file)
  {
    $this->file = $file;
    $this->setFileExtensions(["image/jpeg", "application/pdf"]); //Extensiones permitidas
    $this->setMaxFileSize(3000000); //Tamaño maximo 3MB
  }

  /* Función cargar archivo al servidor */
  public function uploadFile($codeUser)
  {
    //Obtener archivos cargados en el file del constructor
    $fileNew = $this->getFile();

    //Obtener posibles errores
    $error = $this->errores($fileNew);

    if (!$error["error"]) {
      /*Guardar en un array los directorios de los archivos cargados al servidor */
      $arrayRoute = [];

      //Ruta donde se guardan los archivos ../../src/archivos/cedulausuario/
      $route = "../../src/archivos/$codeUser/";

      foreach ($fileNew["name"] as $key => $file) {
        //Guardar el nombre del archivo con la ruta.
        $fileName = $route . $file;

        //Si no existe la ruta la crea
        if (!file_exists($route)) {
          mkdir($route);
        }

        //Mover el archivo al directorio especificado
        $result = @move_uploaded_file($fileNew["tmp_name"][$key], $fileName);

        if ($result) {
          //Guardar en el array la ruta de los archivos sin los ../../
          array_push($arrayRoute, substr($fileName, 6, strlen($fileName)));
        } else {
          return ["success" => false, "errorMessage" => "Ocurrió un error al ingresar el archivo"];
        }
      }

      //Devolver rutas
      return ["success" => true, "data" => ["route" => $arrayRoute]];
    } else {
      return ["success" => false, "errorMessage" => $error["message"]];
    }
  }

  /* Manejar errores */
  private function errores($files)
  {
    //Array asosiativo, almacenar posibles errores
    $error = ["error" => false, "message" => ""];
    //Sumar el tamaño de los archivos
    $totalFileSize = 0;

    //Recorrer cada archivo a cargar
    foreach ($files["error"] as $key => $codeError) {
      //Sumando tamaños de los archivos
      $totalFileSize += $files["size"][$key];

      //Si el archivo tiene en el código de error mayor a cero, ocurrió un error en la subida del archivo
      if ($codeError > 0) {
        //retornar error
        return $error = [
          "error" => true,
          "message" => $this->errorMessage($codeError) //Mensaje del error
        ];
      }
      //Por el contrario si el error es 0, no ocurrió el error
      //Si la suma total del tamaño de los archivos es superior al tamaño máximo establecido, mandar el error
      elseif ($totalFileSize > $this->getMaxFileSize()) {
        return $error = [
          "error" => true,
          "message" => $this->errorMessage(9)
        ];
      }
      //Validar que los archivos cargados tengan la extensión permitida
      elseif (!in_array($files["type"][$key], $this->getFileExtensions())) {
        return $error = [
          "error" => true,
          "message" => $this->errorMessage(10)
        ];
      }
    }

    return $error;
  }

  //Mensajes de error por código
  private function errorMessage($code)
  {
    switch ($code) {
      case 1:
        $message = "El archivo cargado supera la directiva upload_max_filesize en php.ini";
        break;
      case 2:
        $message = "El archivo cargado supera la directiva MAX_FILE_SIZE que se especificó en el formulario HTML.";
        break;
      case 3:
        $message = "El archivo cargado solo se cargó parcialmente.";
        break;
      case 4:
        $message = "ningun archivo fue subido.";
        break;
      case 6:
        $message = "Falta una carpeta temporal.";
        break;
      case 7:
        $message = "Error al escribir el archivo en el disco.";
        break;
      case 8:
        $message = "Una extensión PHP detuvo la carga del archivo.";
        break;
      case 9:
        $message = "El archivo cargado excede el tamaño permitido, solo se pueden subir 3 MB.";
        break;
      case 10:
        $message = "El tipo de archivo cargado no esta permitido, solo se permiten PDF y JPG.";
        break;

      default:
        $message = "Error de carga desconocido";
        break;
    }
    return $message;
  }

  /* GETTERS y SETTERS*/
  public function setFileExtensions($fileExtensions)
  {
    $this->fileExtensions = $fileExtensions;
  }

  public function setMaxFileSize($maxFileSize)
  {
    $this->maxFileSize = $maxFileSize;
  }

  public function getFileExtensions()
  {
    return $this->fileExtensions;
  }

  public function getMaxFileSize()
  {
    return $this->maxFileSize;
  }

  public function getFile()
  {
    return $this->file;
  }
}
