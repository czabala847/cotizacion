<?php
session_start();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8" />
    <meta name="description" content="Poniendo en practica conocimientos en php.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Inicio</title>
    <link href="https://fonts.googleapis.com/css?family=Cabin&display=swap" rel="stylesheet" />
    <link rel="stylesheet" href="<?= getUrlMedia() ?>css/style.css" />
</head>

<body>
    <div id="app">

        <header class="header">
            <div class="container">
                <nav class="header-menu">
                    <ul class="header-menu__list">
                        <li class="header-menu__list--item">
                            <a class="header-menu__list--link" href="index.php">Inicio</a>
                        </li>
                        <li class="header-menu__list--item">
                            <a class="header-menu__list--link" href="#">Acerca de</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </header>

        <section class=" login">
            <div class="container">
                <div class="login-container">
                    <div class="login-description">
                        <div class="login-decription__text">
                            <h1 class="title-primary">Hola, bienvenido</h1>
                            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Pariatur cumque quam fugiat perferendis accusantium consequuntur.</p>
                        </div>
                        <figure>
                            <img class="login-description__img" src="<?= getUrlMedia(); ?>/img/upload/495078-PHE69C-919.png" alt="login imagen" width="400" />
                        </figure>
                    </div>
                    <div class="login-form" id="container-form" data-up="inactive">
                        <div class="form-container">
                            <h2>Iniciar Sesión</h2>
                            <form id="form-login" class="quotation__form" action="" autocomplete="off" method="POST">
                                <input class="login-form__input" type="text" name="cedula" placeholder="Cédula" required />
                                <input class="login-form__input" type="password" name="contraseña" placeholder="Contraseña" required />
                                <input type="hidden" name="login" value="" />
                                <div class="form-login__btn">
                                    <input id="btn-send" class="btn btn--primary" type="submit" value="Enviar" />
                                    <i id="icon-loading" class="fa fa-spinner fa-spin hidden-element"></i>
                                </div>
                            </form>
                            <p>
                                <span>No tienes una cuenta?</span> <a id="registerLogin" class="link" href="">Registrate</a>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="https://kit.fontawesome.com/2028b75fa6.js" crossorigin="anonymous"></script>
    <script type="module" src="<?= getUrlMedia(); ?>js/Login.js"></script>
</body>

</html>