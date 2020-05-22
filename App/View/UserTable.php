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
          <a class="btn-status" data-id=<?php echo $user["id"] ?> data-status=<?php echo strtolower($user["estado"]) ?> href="#">
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
    <li><a class="users_pagination--link" data-href="anterior" href="">Anterior</a></li>
    <!-- <li><a class="users_pagination--link" data-href="0" href="">1</a></li>
            <li><a class="users_pagination--link" data-href="1" href="">2</a></li>
            <li><a class="users_pagination--link" data-href="2" href="">3</a></li> -->
    <li><a class="users_pagination--link" data-href="<?php echo $page + 1 ?>" href="">Siguiente</a></li>
  </ul>
</div>