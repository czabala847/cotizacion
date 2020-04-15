<?php

class uploadFile
{

  /* Función cargar archivo al servidor */
  public function upload($file, $codeUser, $codeDetail)
  {
    //Obtener posibles errores
    $error = $this->errores($file);

    if (!$error["error"]) {

      //Ruta donde se guardan los archivos ../../src/archivos/cedulausuario/
      $uploadFileDir = "../../src/archivos/$codeUser/";

      $fileName = $file["name"];
      //Dividir nombre en un array, separados por el (.)
      $fileNameCmps = explode(".", $fileName);
      $fileExtension = strtolower(end($fileNameCmps));

      //Convertir nombre con MD5
      $newFileName = md5(time() . $codeDetail) . '.' . $fileExtension;

      //Guardar el nombre del archivo con la ruta.
      $dest_path = $uploadFileDir . $newFileName;

      //Si no existe la ruta la crea
      if (!file_exists($uploadFileDir)) {
        mkdir($uploadFileDir);
      }

      //Mover el archivo al directorio especificado
      $result = @move_uploaded_file($file["tmp_name"], $dest_path);

      if ($result) {
        return ["success" => true, "route" => substr($dest_path, 6, strlen($dest_path))];
      } else {
        return ["success" => false, "errorMessage" => "Ocurrió un error al subir el archivo"];
      }
    } else {
      return ["success" => false, "errorMessage" => "Error al subir archivo" . $file["name"] . " " . $error["message"]];
    }
  }

  /* Manejar errores */
  private function errores($file)
  {
    //Array asosiativo, almacenar posibles errores
    $error = ["error" => false, "message" => ""];

    if ($file["error"] > 0) {
      return $error = [
        "error" => true,
        "message" => $this->errorMessage($file["error"])
      ];
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
      default:
        $message = "Error de carga desconocido";
        break;
    }
    return $message;
  }
}
