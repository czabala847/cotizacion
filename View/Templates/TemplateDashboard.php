<?php

session_start();

if (!isset($_SESSION["newsession"])) {
    $location = "location: " . getUrlBase();
    header($location);
}

getHeaderTemplate($dataPage);
?>

<body>
    <div id="app" class="app-dashboard">
        <!-- =======BARRA MENU IZQUIERDO ============= -->
        <?php getSideBarTemplate(); ?>
        <section class="dashboard">
            <!-- ======= HEADER ============= -->
            <header class="header">
                <div class="container">
                    <div class="dashboard-header">
                        <div class="header-route">
                            <i class="fas fa-home"> / </i>
                            <a class="link" href="<?= getUrlBase() . $dataPage['titlePage']; ?>"><?= $dataPage["titlePage"]; ?></a>
                        </div>
                        <div class="header-options">
                            <i class="fas fa-cog"></i>
                        </div>
                    </div>
                </div>
            </header>