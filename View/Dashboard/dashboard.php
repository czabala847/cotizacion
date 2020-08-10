<?php
session_start();

if (!isset($_SESSION["newsession"])) {
    $location = "location: " . getUrlBase();
    header($location);
}

getHeaderTemplate();

?>

<body>
    <div id="app" class="app-dashboard">
        <!-- =======BARRA MENU IZQUIERDO ============= -->
        <aside class="asidebar">
            <div class="asidebar-container">
                <figure class="asidebar__logo">
                    <h3 class="asidebar__logo--text">LOGO</h3>
                </figure>
                <nav class="aside-bar__menu">
                    <ul>
                        <li class="asidebar__menu--item"><i class="fas fa-users"></i><span>Usuarios</span>
                            <ol>
                                <li>Lista de usuarios</li>
                                <li>Roles</li>
                            </ol>
                        </li>
                        <li class="asidebar__menu--item"><i class="fas fa-sign-out-alt"></i>Salir</li>
                    </ul>
                </nav>
            </div>
        </aside>
        <section class="dashboard">
            <!-- ======= HEADER ============= -->
            <header class="header">
                <div class="container">
                    <div class="dashboard-header">
                        <div class="header-route">
                            <i class="fas fa-home"> / </i>
                            <a class="link" href="<?= getUrlBase() . $data['titlePage']; ?>"><?= $data["titlePage"]; ?></a>
                        </div>
                        <div class="header-options">
                            <i class="fas fa-cog"></i>
                        </div>
                    </div>
                </div>
            </header>

            <!-- ======= DASHBOARD ============= -->
            <div class="dashboard-container">
                <div class="container">
                    <div class="dashboard-welcome">
                        <h2>Bienvenido</h2>
                        <p>
                            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dolor nesciunt doloribus nobis,
                            animi eaque inventore autem corporis, culpa esse, harum provident labore sequi architecto
                            placeat temporibus vel consectetur soluta ad.
                        </p>
                        <p>
                            Lorem ipsum dolor sit amet consectetur, adipisicing elit. Saepe,
                            deleniti sequi beatae officiis enim atque reiciendis veniam,
                            eaque qui dolorum fugiat tenetur. Voluptatem aut maiores officiis,
                            omnis culpa officia provident!
                        </p>
                    </div>
                </div>
            </div>

        </section>
    </div>
    <script src="https://kit.fontawesome.com/2028b75fa6.js" crossorigin="anonymous"></script>
</body>

</html>