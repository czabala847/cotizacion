<?php
session_start();

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}

?>

<table class="users__table">
  <thead>
    <tr>
      <th>id</th>
      <th>Cédula</th>
      <th>Nombre</th>
      <th>Correo</th>
      <th>Perfil</th>
      <th>Estado</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($listUser as $user) : ?>
      <tr>
        <th><?php echo $user["id"]; ?></th>
        <th><?php echo $user["cedula"]; ?></th>
        <th><?php echo $user["nombre"]; ?></th>
        <th><?php echo $user["correo"]; ?></th>
        <th><?php echo $user["rol"]; ?></th>
        <th>
          <a class="btn-status" data-id="<?php echo $user['id'] ?>" data-status="<?php echo strtolower($user['estado']) ?>" href="usuario<?php echo $user['id'] ?>">
            <?php
            if ($user["estado"] === 'A') :
              echo "<i class='fas fa-check-square'></i>";
            else :
              echo "<i class='fas fa-window-close'></i>";
            endif; ?>
          </a>
        </th>
        <th><a href=<?php echo "usuarioEditar.php?id=" . $user["id"] ?>><i class="fas fa-pen-square"></i></a></th>
      </tr>
    <?php endforeach ?>
  </tbody>
</table>

<!-- paginador -->
<div class="users__pagination">
  <ul class="users__pagination--list">
    <?php if ($numberPages > 1) : ?>

      <!-- Para el botón anterior -->
      <?php if ($actualPage < 1) : ?>
        <li><a class="btn btn--disabled users_pagination--link" href="#">Anterior</a></li>
      <?php else : ?>
        <li><a class="btn btn--primary users_pagination--link" data-page="<?php echo $actualPage - 1 ?>" href="#">Anterior</a></li>
      <?php endif; ?>

      <!-- Mostrar siempre el botón de primera página en el paginador -->
      <li><a class="btn users_pagination--link <?php echo 0 == $actualPage ? 'btn--active' : 'btn--primary' ?>" data-page="<?php echo 0 ?>" href="#"><?php echo 1 ?></a></li>

      <!-- iterar el número de páginas -->
      <?php

      if ($numberPages > 2) {
        define("NUMBER_PAGES_SHOW", 2); //Número de paginas a mostrar en el paginador despúes de la primera página
        $from = 0; //Desde que página se va a mostrar en el paginador.
        $to = 0; //Hasta que página se mostrar

        //Si la página actual siempre es menor al número de páginas totales
        if ($actualPage < $numberPages - 1) {
          //Mostrar al comenzar las 3 primeras páginas
          if ($actualPage < NUMBER_PAGES_SHOW) {
            $from = 1; //Se empieza desde el 1 (segunda página ya que la página cero siempre se debe mostrar, por lo tanto se quita del ciclo)
            $to = NUMBER_PAGES_SHOW + 1;
          } else {
            //Cuando ya la página actual va por la tercera página
            $from = $actualPage;
            $to = $actualPage + NUMBER_PAGES_SHOW;
          }
        } else { //Cuando ya no hay más paginas, mostrar 2 últimas páginas, y la primera
          $from = $numberPages - NUMBER_PAGES_SHOW;
          $to = $numberPages;
        }

        for ($i = $from; $i < $to; $i++) {
          $typeButton = $i == $actualPage ? 'btn--active' : 'btn--primary'; //Mostrar si la página esta activa
          $textButton = $i + 1; //Mostrar el número de la página en el botón del páginador
          echo "<li><a class = 'btn users_pagination--link $typeButton' data-page='$i'>$textButton</a></li>";
        }
      }
      ?>

      <?php if ($numberPages <= 2) : ?>
        <li><a class="btn users_pagination--link <?php echo 1 == $actualPage ? 'btn--active' : 'btn--primary' ?>" data-page="<?php echo 1 ?>" href="#"><?php echo 2 ?></a></li>
      <?php endif; ?>

      <!-- Para el botón siguiente -->
      <?php if ($actualPage < ($numberPages - 1)) : ?>
        <li><a class="btn btn--primary users_pagination--link" data-page="<?php echo $actualPage + 1 ?>" href="#">Siguiente</a></li>
      <?php else : ?>
        <li><a class="btn btn--disabled users_pagination--link" href="#">Siguiente</a></li>
      <?php endif; ?>
    <?php endif; ?>
  </ul>
</div>