<?php

// require_once("./App/Model/DataBase.php");
// require_once("./App/Model/Cotizacion.php");


// $pruebaConexion = new DataBase();
// $codigo = 2;

// $selectCount = "SELECT COUNT(*) AS cantidad FROM cotizacion";
// $quantity = intval($this->db->select($selectCount, true)["cantidad"]);
// $result = $pruebaConexion->select("SELECT codigo_cotizacion FROM cotizacion_detalle WHERE codigo_cotizacion = ? LIMIT 1", array("s"), false);


// var_dump($result);


// if (!empty($result)) {
//   echo "yeah";
// } else {
//   echo "nooo";
// }

// $params = array("carlos zabala", "1143460015", "czabala847@gmail.com", "");

// $id = $pruebaConexion->getIdQuery();
// echo $id;

// $queryInsert = "INSERT INTO cotizacion (nombre, cedula, correo, asunto) VALUES (?, ?, ? , ?)";
// $response = $pruebaConexion->modification($queryInsert, $params);

// echo password_hash("1234", PASSWORD_DEFAULT) . "\n";

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar usuario</title>
</head>

<body>

  <form id="form" action="">
    <input type="text" placeholder="nombre" name="nombre" />
    <input type="email" placeholder="correo" name="correo" />
    <input type="password" placeholder="contraseña" name="password" />
    <input type="submit" value="enviar">
  </form>

  <script>
    const formulario = document.querySelector("#form")

    formulario.addEventListener("submit", (e) => {
      e.preventDefault();

      const fd = new FormData(formulario);

      debugger;

    })
  </script>
</body>

</html>