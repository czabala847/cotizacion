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
            <tr>
              <th>1143460015</th>
              <th>Carlos Zabala</th>
              <th>czabala847@gmail.com</th>
              <th>Activo</th>
              <th>Editar</th>
            </tr>
            <tr>
              <th>1</th>
              <th>Prueba1</th>
              <th>prueba1@gmail.com</th>
              <th>Inactivo</th>
              <th>Editar</th>
            </tr>
          </tbody>
        </table>
      </div>
    </section>
  </div>
</body>

</html>