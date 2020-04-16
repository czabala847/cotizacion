<?php
require_once("./App/View/Header.php");

htmlHeader('Cotización');
?>

<section class="login">
  <div class="container">
    <div class="login-container">
      <div class="login-description">
        <h1 class="title-primary">Hola, bienvenido</h1>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur cumque quam fugiat perferendis accusantium consequuntur officia quia qui repudiandae dicta nihil nostrum soluta a, laborum nisi corporis hic quos officiis?</p>
      </div>
      <div id="login-form" class="login-form">
        <div id="change-form" data-login="sign-in">
        </div>
        <p>
          <span id="p-text">No tienes una cuenta?</span> <a id="registerLogin" class="link" href="">Registrate</a>
        </p>
      </div>
    </div>
  </div>
</section>


</div>
<script src="src/js/login.js"></script>
</body>

</html>