<?php
session_start();
require_once("../Model/User.php");

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}

$newUser = new User();
$user = $newUser->getUser($_GET["id"]);

?>

<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar usuario</title>
  <link rel="stylesheet" href="../../src/css/style.css" />
  <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet" />
</head>

<body>
  <div id="editUser">
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
          <h1 class="title-primary"><?php echo  $user["nombre"] ?></h1>
          <p>CC XXXXXXXX</p>
        </div>
      </section>
      <section class="users editUser">
        <div class="container">
          <h2>Editar usuario</h2>
          <form class="editUser__form" autocomplete="off" action="">
            <label for="name">Nombre</label><input class="editUser__form--field" type="text" name="nombre" id="name" required />
            <label for="email">Correo </label><input class="editUser__form--field" type="email" name="correo" id="email" required />
            <label for="pw1">Contraseña</label><input class="editUser__form--field" type="password" name="contraseña" id="pw1" required />
            <label for="pw2">Confirmar contraseña</label><input class="editUser__form--field" type="password" name="contraseña2" id="pw2" required />
            <input class="btn btn--primary" type="submit" name="btnEnviar" id="btnEnviar" value="Enviar">
          </form>
        </div>
      </section>
    </div>
  </div>
</body>

</html>