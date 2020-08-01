<?php

getHeaderTemplate();

?>

<body>
    <div id="app" class="app-dashboard">
        <!-- =======BARRA MENU IZQUIERDO ============= -->
        <aside class="asidebar">
            <div class="asidebar-container">
                aside bar
            </div>
        </aside>
        <section class="dashboard">
            <!-- =======HEADER ============= -->
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