<!-- paginador -->
<div class="pagination">
    <ul class="pagination__list">
        <?php if ($dataTable["numberPages"] > 1) : ?>

            <!-- Para el botón anterior -->
            <?php if ($dataTable['actualPage'] < 1) : ?>
                <li class='pagination__list--item'><a class="btn btn--disabled pagination__list--link" href="#">Anterior</a></li>
            <?php else : ?>
                <li class='pagination__list--item'><a class="btn btn--primary pagination__list--link" data-page="<?php echo $dataTable['actualPage'] - 1 ?>" href="#">Anterior</a></li>
            <?php endif; ?>

            <!-- Mostrar siempre el botón de primera página en el paginador -->
            <li class='pagination__list--item'><a class="btn pagination__list--link <?php echo 0 == $dataTable['actualPage'] ? 'btn--active' : 'btn--primary' ?>" data-page="<?php echo 0 ?>" href="#"><?php echo 1 ?></a></li>

            <!-- iterar el número de páginas -->
            <?php

            if ($dataTable["numberPages"] > 2) {
                define("NUMBER_PAGES_SHOW", 2); //Número de paginas a mostrar en el paginador despúes de la primera página
                $from = 0; //Desde que página se va a mostrar en el paginador.
                $to = 0; //Hasta que página se mostrar

                //Si la página actual siempre es menor al número de páginas totales
                if ($dataTable['actualPage'] < $dataTable["numberPages"] - 1) {
                    //Mostrar al comenzar las 3 primeras páginas
                    if ($dataTable['actualPage'] < NUMBER_PAGES_SHOW) {
                        $from = 1; //Se empieza desde el 1 (segunda página ya que la página cero siempre se debe mostrar, por lo tanto se quita del ciclo)
                        $to = NUMBER_PAGES_SHOW + 1;
                    } else {
                        //Cuando ya la página actual va por la tercera página
                        $from = $dataTable['actualPage'];
                        $to = $dataTable['actualPage'] + NUMBER_PAGES_SHOW;
                    }
                } else { //Cuando ya no hay más paginas, mostrar 2 últimas páginas, y la primera
                    $from = $dataTable["numberPages"] - NUMBER_PAGES_SHOW;
                    $to = $dataTable["numberPages"];
                }

                for ($i = $from; $i < $to; $i++) {
                    $typeButton = $i == $dataTable['actualPage'] ? 'btn--active' : 'btn--primary'; //Mostrar si la página esta activa
                    $textButton = $i + 1; //Mostrar el número de la página en el botón del páginador
                    echo "<li class='pagination__list--item'><a class = 'btn pagination__list--link $typeButton' data-page='$i'>$textButton</a></li>";
                }
            }
            ?>

            <?php if ($dataTable["numberPages"] <= 2) : ?>
                <li class='pagination__list--item'><a class="btn pagination__list--link <?php echo 1 == $dataTable['actualPage'] ? 'btn--active' : 'btn--primary' ?>" data-page="<?php echo 1 ?>" href="#"><?php echo 2 ?></a></li>
            <?php endif; ?>

            <!-- Para el botón siguiente -->
            <?php if ($dataTable['actualPage'] < ($dataTable["numberPages"] - 1)) : ?>
                <li class='pagination__list--item'><a class="btn btn--primary pagination__list--link" data-page="<?php echo $dataTable['actualPage'] + 1 ?>" href="#">Siguiente</a></li>
            <?php else : ?>
                <li class='pagination__list--item'><a class="btn btn--disabled pagination__list--link" href="#">Siguiente</a></li>
            <?php endif; ?>
        <?php endif; ?>
    </ul>
</div>