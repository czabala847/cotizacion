<?php getDashboardTemplate($dataPage); ?>

<!-- ======= SECCIÓN DE USUARIOS ============= -->
<section class="user dashboard-content">
    <div class="container">
        <div class="user-container">
            <section class="hero">
                <h1 class="title-primary">Administrador de usuarios</h1>
                <form action="" autocomplete="off">
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