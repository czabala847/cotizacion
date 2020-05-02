<?php
session_start();

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Nueva cotización</title>
  <link rel="stylesheet" href="../../src/css/style.css" />
  <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet" />
</head>

<body>
  <div id="app">

    <header class="header">
      <div class="container">
        <nav class="header-menu">
          <ul class="header-menu__list">
            <!-- <li class="header-menu__list--item">
          <a class="header-menu__list--link" href="#">Inicio</a>
        </li> -->
            <li class="header-menu__list--item">
              <a class="header-menu__list--link" href="usuarios.php">Administrar Usuario</a>
              <a class="header-menu__list--link" href="../Model/Logout.php">Salir</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>

    <section class="quotation">
      <div class="container">
        <div class="quotation-container">
          <article class="quotation__detail">
            <h1 class="title-primary">Envia tu cotización</h1>
            <p class="quotation__detail--description">
              Lorem ipsum dolor sit amet, consectetur adipisicing elit.
              Deserunt atque at quidem culpa dolore quis accusantium.
            </p>
          </article>
          <form id="frm-cotizacion" action="App\Model\AgregarCotizacion.php" method="POST" class="quotation__form" enctype="multipart/form-data" autocomplete="off">
            <input type="text" placeholder="Nombre" name="nombre" required />
            <input type="text" placeholder="Cédula" name="cedula" required />
            <input type="email" placeholder="Correo" name="correo" required />
            <textarea placeholder="Comentarios" name="asunto" id="" cols="30" rows="10"></textarea>
            <div class="quotation-btn">
              <button id="btn-send" type="submit" class="btn btn--primary"><span>Enviar</span><i id="icon-loading" class="fa fa-spinner fa-spin hidden-element"></i></button>
              <input type="file" class="btn" name="archivo[]" value="Adjuntar archivos" accept="application/pdf, .jpg" multiple="multiple" required />
            </div>
          </form>
          <div id="loading">
            <div class="lds-roller">
              <div></div>
              <div></div>
              <div></div>
            </div>
          </div>
        </div>
      </div>
    </section>

  </div>
  <!-- <script src="src/js/cotizacion.js"></script> -->
  <!-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
  <script src="https://kit.fontawesome.com/2028b75fa6.js" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script type="module" src="../../src/js/Cotizacion.js"></script>
</body>

</html>