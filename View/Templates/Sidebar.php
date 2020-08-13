<aside class="sidebar">
    <div class="sidebar-container">
        <div class="sidebar-header">
            <figure class="sidebar-header__logo">
                <h3 class="sidebar-header__logo--title"><a class="link-normal" href="<?= getUrlBase() ?>dashboard">LOGO</a></h3>
                <div class="sidebar-header__logo--circle"></div>
            </figure>
            <i id="sidebar-menu-icon" class="sidebar-header__icon fas fa-bars"></i>
        </div>
        <nav class="sidebar__menu">
            <ul>
                <li class="sidebar__menu--item"><a class="link-normal" href=""><i class="fas fa-users"></i><span>Usuarios</span></a></li>
                <li class="sidebar__menu--item"><a class="link-normal" href="<?= getUrlBase() ?>cotizacion"><i class="fas fa-file-invoice-dollar"></i><span>Cotizaciones</span></a></li>
                <li class="sidebar__menu--item"><a class="link-normal" href="<?= getUrlBase() ?>user/logout"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a></li>
            </ul>
        </nav>
    </div>
</aside>