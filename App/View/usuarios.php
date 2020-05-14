<?php
session_start();
require_once("../Model/User.php");

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}

$user = new User();
$listUser = $user->showAllUser();

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
                <a class="header-menu__list--link" href="usuarios.php">Administrar Usuario</a>
                <a class="header-menu__list--link" href="../Model/Logout.php">Salir</a>
              </li>
            </ul>
          </nav>
        </div>
      </header>
      <section class="hero">
        <div class="container">
          <h1 class="title-primary">Administrador de usuarios</h1>
          <form action="">
            <input type="text" placeholder="Buscar">
          </form>
        </div>
      </section>
    </div>
    <section class="users">
      <div class="container">
        <table class="users__table">
          <thead>
            <tr>
              <th>Cédula</th>
              <th>Nombre</th>
              <th>Correo</th>
              <th>Estado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php foreach ($listUser as $user) : ?>
              <tr>
                <th><?php echo $user["cedula"]; ?></th>
                <th><?php echo $user["nombre"]; ?></th>
                <th><?php echo $user["correo"]; ?></th>
                <th>
                  <?php
                  if ($user["estado"] === 'A') :
                    echo "<a class='btn-status' href='index.php'><i class='fas fa-check-square'></i></a>";
                  else :
                    echo "<a class='btn-status' href=''><i class='btn-status fas fa-window-close'></i></a>";
                  endif; ?>
                </th>
                <th><a href=""><i class="fas fa-pen-square"></i></a></th>
              </tr>
            <?php endforeach ?>
          </tbody>
        </table>
      </div>
    </section>
  </div>
  <script src="https://kit.fontawesome.com/2028b75fa6.js" crossorigin="anonymous"></script>
  <script src="../../src/js/User.js"></script>
</body>

</html>