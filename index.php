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
      <div class="login-form">
        <h2>Iniciar sesión</h2>
        <form class="quotation__form" action="" autocomplete="off" method="POST" data-login="sign-in">
          <input class="login-form__input" type="text" name="user" placeholder="Usuario" />
          <input class="login-form__input" type="password" name="password" placeholder="Contraseña" />
          <input class="login-form__input" type="password" name="password2" placeholder="Repetir Contraseña" />
          <input class="login-form__input" type="text" name="code" placeholder="Código de registro" />
          <input class="btn btn--primary" type="submit" value="Enviar" />
        </form>
        <p>
          No tienes una cuenta? <a class="link" href="">Registrate</a>
        </p>
      </div>
    </div>
  </div>
</section>


</div>
<script src="src/js/login.js"></script>
</body>

</html>