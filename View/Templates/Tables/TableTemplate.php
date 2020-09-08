<table class="table">
    <thead class="table__header">
        <tr class="table__row">
            <!-- **** RECORRER LA CABECERA DE LA TABLA ******** -->
            <?php foreach ($dataTable["columns"] as $column) : ?>
                <th class="table__column"><?= $column ?></th>
            <?php endforeach; ?>
            <!-- **** COLUMNAS ESTADO Y EDITAR SIEMPRE DEBE DE ESTAR ******** -->
            <th class="table__column">Estado</th>
            <th class="table__column">Editar</th>
        </tr>
    </thead>
    <tbody class="table__body">
        <!-- **** IMPRIMIR CADA FILA EN LA TABLA ******** -->
        <?php foreach ($dataTable["data"] as $data) : ?>
            <tr class="table__row">
                <!-- **** IMPRIMIR COLUMNAS DEPENDIENDO DE LOS DATOS PASADOS AL ARRAY DATATABLE["DATA"] ******** -->
                <!-- COUNT($DATA) / 2, es el número real de columnas, ya que hay columnas que se repiten, indice númerico y llave -->
                <?php foreach ($dataTable["keys"] as $key) : ?>
                    <th class="table__column"><?php echo $data[$key]; ?></th>
                <?php endforeach; ?>
                <th class="table__column">
                    <a class="btn-status" data-id="<?php echo $data['id'] ?>" data-status="<?php echo strtolower($data['estado']) ?>" href="">
                        <?php
                            if ($data["estado"] === 'A') :
                                echo "<i class='fas fa-check-square'></i>";
                            else :
                                echo "<i class='fas fa-window-close'></i>";
                            endif; ?>
                    </a>
                </th>
                <th class="table__column"><a href=<?php echo getUrlBase() . "user/edit/" . $data["id"] ?>><i class="fas fa-pen-square"></i></a></th>
            </tr>
        <?php endforeach ?>

    </tbody>
</table>

<?php getPaginationTemplate($dataTable); ?>