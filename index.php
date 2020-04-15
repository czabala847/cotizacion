<?php
require_once("./App/View/Header.php");

htmlHeader('Cotización');
?>

<section class="login">
  <div class="container">
    <div class="login-container">
      <div class="login-description">
        <p>Bienvenida, descrición...</p>
      </div>
      <form class="login-form quotation__form" action="" autocomplete="off">
        <input type="text" name="user" placeholder="Usuario" />
        <input type="password" name="password" placeholder="Contraseña" />
        <input class="btn btn--primary" type="submit" value="Enviar" />
      </form>
    </div>
  </div>
</section>


</div>
<!-- <script src="src/js/cotizacion.js"></script> -->
<!-- <script src="src/js/index.js"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> -->
</body>

</html>