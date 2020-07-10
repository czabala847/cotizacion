<!-- paginador -->
<div class="users__pagination">
  <ul class="users__pagination--list">
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
    ?>

    <!-- Para el botón siguiente -->
    <?php if ($actualPage < ($numberPages - 1)) : ?>
      <li><a class="btn btn--primary users_pagination--link" data-page="<?php echo $actualPage + 1 ?>" href="#">Siguiente</a></li>
    <?php else : ?>
      <li><a class="btn btn--disabled users_pagination--link" href="#">Siguiente</a></li>
    <?php endif; ?>
  </ul>
</div>