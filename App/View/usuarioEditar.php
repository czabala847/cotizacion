<?php
session_start();
require_once("../Model/User.php");

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}

$newUser = new User();
$user = $newUser->searchUser($_GET["id"]);

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
          <p>C.C <?php echo $user["cedula"] ?></p>
        </div>
      </section>
      <section class="users editUser">
        <div class="container">
          <h2>Editar usuario</h2>
          <form id="formUpdate" class="editUser__form" autocomplete="off" action="">
            <input type="hidden" name="id" value=<?php echo $user["id"] ?> />
            <label for="name">Nombre</label><input class="editUser__form--field" type="text" name="nombre" id="name" value=<?php echo $user["nombre"] ?> required />
            <label for="email">Correo </label><input class="editUser__form--field" type="email" name="correo" id="email" value=<?php echo $user["correo"] ?> required />
            <label for="pw1">Contraseña</label>
            <input class="editUser__form--field" type="password" name="password" id="password" required />
            <label for="pw2">Confirmar contraseña</label><input class="editUser__form--field" type="password" name="password2" id="pw2" required />
            <input class="btn btn--primary" type="submit" id="btnEnviar" value="Enviar">
          </form>
        </div>
      </section>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
  <script type="module" src="../../src/js/User.js"></script>
</body>

</html>