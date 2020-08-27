<?php getDashboardTemplate($dataPage); ?>

<!-- ======= SECCIÓN DE COTIZACIÓN ============= -->
<section class="quotation dashboard-content">
    <div class="container">
        <div class="quotation-container">
            <article class="quotation__detail">
                <h1 class="title-primary">Envia tu cotización</h1>
                <p class="quotation__detail--description">
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                    Deserunt atque at quidem culpa dolore quis accusantium.
                </p>
            </article>
            <form id="frm-cotizacion" method="POST" class="quotation__form" enctype="multipart/form-data" autocomplete="off">
                <input type="text" placeholder="Nombre" name="nombre" required />
                <input type="text" placeholder="Cédula" name="cedula" required />
                <input type="email" placeholder="Correo" name="correo" required />
                <textarea placeholder="Comentarios" name="asunto" id="" cols="30" rows="10"></textarea>
                <div class="quotation-btn">
                    <button id="btn-send" type="submit" class="btn btn--primary"><span>Enviar</span><i id="icon-loading" class="fa fa-spinner fa-spin hidden-element"></i></button>
                    <input type="file" class="btn" name="archivo[]" value="Adjuntar archivos" accept="application/pdf, .jpg" multiple="multiple" required />
                </div>
            </form>
        </div>
    </div>
</section>

<?php getFooterTemplate($dataPage); ?>