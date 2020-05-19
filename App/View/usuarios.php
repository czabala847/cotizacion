<?php
session_start();

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración de usuarios</title>
  <link rel="stylesheet" href="../../src/css/style.css" />
  <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet" />
</head>

<body>
  <div id="user">
    <div class="user-header-hero">
      <header class="header">
        <div class="container">
          <nav class="header-menu">
            <ul class="header-menu__list">
              <!-- <li class="header-menu__list--item">
          <a class="header-menu__list--link" href="#">Inicio</a>
        </li> -->
              <li class="header-menu__list--item">
                <a class="header-menu__list--link" href="nueva-cotizacion.php">Crear cotización</a>
                <a class="header-menu__list--link" href="../Model/Logout.php">Salir</a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <section class="hero">
        <div class="container">
          <h1 class="title-primary">Administrador de usuarios</h1>
          <form action="" autocomplete="off">
            <input type="text" placeholder="Buscar" name="buscador" id="fieldSearch" />
          </form>
        </div>
      </section>
    </div>
    <section class="users">
      <div class="container">
        <div class="table-container" id="userTable">

        </div>
      </div>
    </section>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script src="https://kit.fontawesome.com/2028b75fa6.js" crossorigin="anonymous"></script>
  <script type="module" src="../../src/js/User.js"></script>
</body>

</html>