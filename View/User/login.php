<?php
getHeaderTemplate();
?>

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
                    <div class="login-form" id="login-form-container" data-up="inactive">
                        <div class="form-container">
                            <h2>Iniciar Sesión</h2>
                            <form id="login-form" class="quotation__form" action="" autocomplete="off" method="POST">
                                <input class="login-form__input" type="text" name="cedula" placeholder="Cédula" required />
                                <input class="login-form__input" type="password" name="contraseña" placeholder="Contraseña" required />
                                <input type="hidden" name="login" value="" />
                                <div class="login-form__btn">
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="https://kit.fontawesome.com/2028b75fa6.js" crossorigin="anonymous"></script>
    <script type="module" src="<?= getUrlMedia(); ?>js/User/UserLogin.js"></script>
</body>

</html>