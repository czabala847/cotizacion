<?php

session_start();

if (!isset($_SESSION["newsession"])) {
    $location = "location: " . getUrlBase();
    header($location);
}

getHeadTemplate($dataPage);
?>

<body>
    <!-- =======  INICIO APP ============= -->
    <div id="app" class="app-dashboard">

        <!-- =======  MENU IZQUIERDO ============= -->
        <?php getSideBarTemplate(); ?>

        <!-- =======  CONTENIDO DERECHO ============= -->
        <section class="dashboard">

            <!-- ======= HEADER ============= -->
            <header class="header">
                <div class="container">
                    <div class="header__dashboard">
                        <div class="header__dashboard--route">
                            <i class="fas fa-home"> / </i>
                            <a class="link" href="<?= getUrlBase() . $dataPage['titlePage']; ?>"><?= $dataPage["titlePage"]; ?></a>
                        </div>
                        <div class="header__dashboard--options">
                            <i class="fas fa-cog"></i>
                        </div>
                    </div>
                </div>
            </header>