</section> <!-- ======= CIERRE CONTENIDO DERECHO ============= -->
</div> <!-- ======= FIN APP ============= -->
<script src="https://kit.fontawesome.com/2028b75fa6.js" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
<script src="<?= getUrlMedia() ?>js/Dashboard/SideBar.js"></script>
<script type="module" src="<?= getUrlMedia(); ?>js/Cotizacion/Cotizacion.js"></script>
<script type="module" src="<?= getUrlMedia(); ?>js/User/User.js"></script>
<?php if ($dataPage["titlePage"] === "roles") : ?>
    <script type="module" src="<?= getUrlMedia(); ?>js/User/Roles.js"></script>
<?php endif; ?>

</body>

</html>