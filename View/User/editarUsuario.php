<?php getDashboardTemplate($dataPage); ?>

<!-- ======= SECCIÓN DE USUARIOS ============= -->
<section class="user dashboard-content">
    <div class="container">
        <div class="user-container">

            <section class="user-container__info hero">
                <h1 class="title-primary"><?= $dataPage["user"]["nombre"] ?></h1>
                <p>C.C <?= $dataPage["user"]["cedula"] ?></p>
            </section>

            <section class="users editUser">
                <div class="container">
                    <h2>Editar usuario</h2>
                    <form id="formUpdate" class="editUser__form" autocomplete="off" action="#">
                        <input type="hidden" name="id" value="<?php echo $user['id'] ?>" />
                        <label for="name">Nombre</label>
                        <input class="editUser__form--field" type="text" name="nombre" id="name" value="<?php echo $user['nombre'] ?>" required />
                        <label for="email">Correo</label><input class="editUser__form--field" type="email" name="correo" id="email" value="<?php echo $user['correo'] ?>" required />
                        <label>Seleccionar perfil de usuario</label>
                        <select class="editUser__form--field" name="comboRol" id="comboRol">
                            <?php for ($i = 0; $i < count($arrRoles); $i++) : ?>
                                <option value="<?= $arrRoles[$i]['id'] ?>" <?= ($i + 1) == $user["rol"] ? "selected" : "" ?>><?= $arrRoles[$i]["nombre"] ?></option>
                            <?php endfor; ?>
                        </select>
                        <label for="changePass">¿Cambiar contraseña?</label><input type="checkbox" name="changePass" id="changePass" value="Si" />
                        <label for="pw1">Contraseña</label>
                        <input class="editUser__form--field" type="password" name="password" id="pw1" disabled />
                        <label for="pw2">Confirmar contraseña</label><input class="editUser__form--field" type="password" name="password2" id="pw2" disabled />
                        <div class="form-login__btn">
                            <input class="btn btn--primary" type="submit" id="btnEnviar" value="Enviar">
                            <i id="icon-loading" class="fa fa-spinner fa-spin hidden-element"></i>
                        </div>
                    </form>
                </div>
            </section>
        </div>
    </div>
</section>

<?php getFooterTemplate(); ?>