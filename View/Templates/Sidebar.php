<aside class="sidebar">
    <div class="sidebar-header">
        <figure class="sidebar-header__logo">
            <h3 class="sidebar-header__logo--title title-logo"><a class="link-normal" href="<?= getUrlBase() ?>dashboard">LOGO</a></h3>
            <div class="sidebar-header__logo--circle"></div>
        </figure>
        <i id="sidebar-menu-icon" class="sidebar-header__icon fas fa-bars"></i>
    </div>
    <nav class="sidebar__menu">
        <ul class="list-normal">
            <li class="sidebar__menu--item"><a class="link-normal" href="<?= getUrlBase() ?>dashboard"><i class="fas fa-home"></i><span>Dashboard</span></a></li>
            <li class="sidebar__menu--item menu-dropdown">
                <a class="link-normal" href="" data-toggle="drop-down">
                    <i class="fas fa-users"></i>
                    <span>Usuarios</span>
                    <i id="icon-angle" class="fas fa-angle-right"></i>
                </a>
                <ul class="list-normal sidebar__submenu">
                    <li class="sidebar__submenu--item">
                        <a href="<?= getUrlBase() ?>User" class="link-normal">
                            <span>Lista usuarios</span>
                        </a>
                    </li>
                    <li class="sidebar__submenu--item">
                        <a href="" class="link-normal">
                            <span>Roles</span>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="sidebar__menu--item"><a class="link-normal" href="<?= getUrlBase() ?>cotizacion"><i class="fas fa-file-invoice-dollar"></i><span>Cotizaciones</span></a></li>
            <li class="sidebar__menu--item"><a class="link-normal" href="<?= getUrlBase() ?>user/logout"><i class="fas fa-sign-out-alt"></i><span>Salir</span></a></li>
        </ul>
    </nav>
</aside>