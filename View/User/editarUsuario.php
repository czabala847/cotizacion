<?php getDashboardTemplate($dataPage); ?>

<!-- ======= SECCIÓN DE USUARIOS ============= -->
<section class="user dashboard-content">
    <div class="container">
        <div class="user-container">
            <h2 class="title-dashboard">Editar usuario</h2>
            <div class="user-edit">
                <div class="user-edit__header">
                    <p><?= $dataPage["user"]["nombre"]; ?></p>
                </div>

                <div class="user-edit__sidebar">
                    <i class="avatar-user fas fa-user-astronaut"></i>
                    <p class="t-center">Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
                <!-- ======= FORMULARIO EDITAR USUARIO============= -->
                <form id="formUpdate" class="user-edit__form" autocomplete="off">
                    <h3>Información general</h3>
                    <input type="hidden" name="id" value="<?= $dataPage['user']['id'] ?>" />
                    <div class="form-group fg-2">
                        <div class="form-group__group">
                            <label for="name">Nombre</label>
                            <input type="text" name="nombre" id="name" value="<?= $dataPage['user']['nombre'] ?>" required />
                        </div>
                        <div class="form-group__group">
                            <label for="email">Correo</label>
                            <input type="email" name="correo" id="email" value="<?= $dataPage['user']['correo'] ?>" required />
                        </div>
                    </div>

                    <label>Seleccionar perfil de usuario</label>
                    <select name="comboRol" id="comboRol">
                        <option value="1">Administrador</option>
                        <option value="2">Estandar</option>
                    </select>


                    <div class="form-group">
                        <div class="form-group__group textpass">
                            <label class="title-dashboard-secondary" for="changePass">Cambiar contraseña</label>
                            <input type="checkbox" name="changePass" id="changePass" value="Si" />
                        </div>
                    </div>

                    <label for="pw1"><span>Contraseña</span><input type="password" name="password" id="pw1" disabled /></label>
                    <label for="pw2"><span>Confirmar contraseña</span><input type="password" name="password2" id="pw2" disabled /></label>

                    <div class="form-login__btn">
                        <input class="btn btn--primary" type="submit" id="btnEnviar" value="Enviar">
                        <i id="icon-loading" class="fa fa-spinner fa-spin hidden-element"></i>
                    </div>
                </form>

            </div>
        </div>
    </div>
</section>

<?php getFooterTemplate($dataPage); ?>