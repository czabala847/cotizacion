<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta http-equiv="X-UA-Compatible" content="ie=edge" />
  <title>Cotización</title>
  <link rel="stylesheet" href="./src/css/style.css" />
  <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet" />
</head>

<body>
  <div id="app">
    <header class="header">
      <div class="container">
        <nav class="header-menu">
          <ul class="header-menu__list">
            <li class="header-menu__list--item">
              <a class="header-menu__list--link" href="#">Inicio</a>
            </li>
            <li class="header-menu__list--item">
              <a class="header-menu__list--link" href="#">Administración</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>
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
          <form id="frm-cotizacion" action="App\Model\Insert.php" method="POST" class="quotation__form" enctype="multipart/form-data">
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
  <script src="src/js/index.js"></script>
  <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</body>

</html>