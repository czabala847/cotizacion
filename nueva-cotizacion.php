<?php
session_start();

if (!isset($_SESSION["newsession"])) {
  header("Location: ./index.php");
}

require_once("./App/View/Header.php");

htmlHeader('Nueva Cotización');
?>

<header class="header">
  <div class="container">
    <nav class="header-menu">
      <ul class="header-menu__list">
        <!-- <li class="header-menu__list--item">
          <a class="header-menu__list--link" href="#">Inicio</a>
        </li> -->
        <li class="header-menu__list--item">
          <a class="header-menu__list--link" href="App\Model\Logout.php">Salir</a>
        </li>
      </ul>
    </nav>
  </div>
</header>

<section class="quotation">
  <div class="container">
    <div class="quotation-container">
      <article class="quotation__detail">
        <h1 class="title-primary">Envia tu cotización</h1>
        <p class="quotation__detail--description">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          Deserunt atque at quidem culpa dolore quis accusantium.
        </p>
      </article>
      <form id="frm-cotizacion" action="App\Model\AgregarCotizacion.php" method="POST" class="quotation__form" enctype="multipart/form-data" autocomplete="off">
        <input type="text" placeholder="Nombre" name="nombre" require />
        <input type="text" placeholder="Cédula" name="cedula" require />
        <input type="email" placeholder="Correo" name="correo" require />
        <textarea placeholder="Comentarios" name="asunto" id="" cols="30" rows="10"></textarea>
        <div class="quotation-btn">
          <button type="submit" class="btn btn--primary">Enviar</button>
          <input type="file" class="btn" name="archivo[]" value="Adjuntar archivos" accept="application/pdf, .jpg" multiple="multiple" />
        </div>
      </form>
      <div id="loading">
        <div class="lds-roller">
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
  </div>
</section>

</div>
<!-- <script src="src/js/cotizacion.js"></script> -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="module" src="src/js/index.js"></script>
</body>

</html>