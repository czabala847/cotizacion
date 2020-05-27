<?php session_start();

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}

?>

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
<div class="users__pagination">
  <ul class="users__pagination--list">
    <!-- Para el botón anterior -->
    <?php if ($actualPage < 1) : ?>
      <li><a class="btn btn--disabled users_pagination--link" href="#">Anterior</a></li>
    <?php else : ?>
      <li><a class="btn btn--primary users_pagination--link" data-page="<?php echo $actualPage - 1 ?>" href="#">Anterior</a></li>
    <?php endif; ?>

    <!-- iterar el número de páginas -->
    <?php for ($i = 0; $i < $numberPages; $i++) : ?>
      <li><a class="btn users_pagination--link <?php echo $i == $actualPage ? 'btn--active' : 'btn--primary' ?>" data-page="<?php echo $i ?>" href="#"><?php echo $i + 1 ?></a></li>
    <?php endfor; ?>

    <!-- Para el botón siguiente -->
    <?php if ($actualPage < ($numberPages - 1)) : ?>
      <li><a class="btn btn--primary users_pagination--link" data-page="<?php echo $actualPage + 1 ?>" href="#">Siguiente</a></li>
    <?php else : ?>
      <li><a class="btn btn--disabled users_pagination--link" href="#">Siguiente</a></li>
    <?php endif; ?>
  </ul>
</div>