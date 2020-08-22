<table class="table">
    <thead class="table__header">
        <tr class="table__row">
            <th class="table__column">id</th>
            <th class="table__column">Cédula</th>
            <th class="table__column">Nombre</th>
            <th class="table__column">Correo</th>
            <th class="table__column">Perfil</th>
            <th class="table__column">Estado</th>
            <th class="table__column"></th>
        </tr>
    </thead>
    <tbody class="table__body">
        <?php foreach ($dataTable["data"] as $user) : ?>
            <tr class="table__row">
                <th class="table__column"><?php echo $user["id"]; ?></th>
                <th class="table__column"><?php echo $user["cedula"]; ?></th>
                <th class="table__column"><?php echo $user["nombre"]; ?></th>
                <th class="table__column"><?php echo $user["correo"]; ?></th>
                <th class="table__column"><?php echo $user["rol"]; ?></th>
                <th class="table__column">
                    <a class="btn-status" data-id="<?php echo $user['id'] ?>" data-status="<?php echo strtolower($user['estado']) ?>" href="">
                        <?php
                        if ($user["estado"] === 'A') :
                            echo "<i class='fas fa-check-square'></i>";
                        else :
                            echo "<i class='fas fa-window-close'></i>";
                        endif; ?>
                    </a>
                </th>
                <th class="table__column"><a href=<?php echo getUrlBase() . "user/edit/" . $user["id"] ?>><i class="fas fa-pen-square"></i></a></th>
            </tr>
        <?php endforeach ?>
    </tbody>
</table>

<?php getPaginationTemplate($dataTable); ?>