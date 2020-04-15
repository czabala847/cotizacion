<?php
require_once("./App/View/Header.php");

htmlHeader('Nueva Cotización');
?>

<section class="quotation">
  <div class="container">
    <div class="quotation-container">
      <article class="quotation__detail">
        <h1 class="quotation__detail--title">Envia tu cotización</h1>
        <p class="quotation__detail--description">
          Lorem ipsum dolor sit amet, consectetur adipisicing elit.
          Deserunt atque at quidem culpa dolore quis accusantium.
        </p>
      </article>
      <form id="frm-cotizacion" action="App\Model\Insert.php" method="POST" class="quotation__form" enctype="multipart/form-data" autocomplete="off">
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

<?php

require_once("./App/View/Footer.php");

?>