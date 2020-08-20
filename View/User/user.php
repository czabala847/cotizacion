<?php getDashboardTemplate($dataPage); ?>

<!-- ======= SECCIÓN DE USUARIOS ============= -->
<section class="user dashboard-content">
    <div class="container">
        <div class="user-container">
            <section class="user-search">
                <h1 class="t-center title-primary">Administrador de usuarios</h1>
                <form class="user-search__form" autocomplete="off">
                    <input type="text" placeholder="Buscar" name="buscador" id="fieldSearch" />
                </form>
            </section>
            <section class="users">
                <div class="container">
                    <div class="table-container" id="userTable">
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>

<?php getFooterTemplate(); ?>