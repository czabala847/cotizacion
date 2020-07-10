<table class="users__table">
  <thead>
    <tr>
      <th>id</th>
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
        <th><?php echo $user["id"]; ?></th>
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