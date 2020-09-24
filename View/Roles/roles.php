<?php getDashboardTemplate($dataPage); ?>

<!-- ======= SECCIÓN DE USUARIOS ============= -->
<section class="roles dashboard-content">
    <div class="container">
        <div class="t-center roles-container">
            <h1 class="title-primary">Roles usuario</h1>
            <div class="roles__create">
                <button id="btnCreateRol" class="btn btn--primary">
                    Crear Rol
                    <i class="fas fa-plus-circle"></i>
                </button>
            </div>
            <section class="table-container" id="rolesTable">
            </section>
        </div>
    </div>
</section>

<?php getFooterTemplate($dataPage); ?>