class DataTable {
  template = (data) => {
    return `
      <table class="users__table">
      <thead>
        <tr>
          <th>id</th>
          <th>Cédula</th>
          <th>Nombre</th>
          <th>Correo</th>
          <th>Estado</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($listUser as $user) : ?>
          <tr>
            <th>${data.id}</th>
            <th>${data.cedula}</th>
            <th>${data.nombre}</th>
            <th>${data.correo}</th>
            <th>
              <a class="btn-status" data-id="${data.id}" data-status="${
      data.estado
    }" href="#">
                ${
                  data.estado === "A"
                    ? "<i class='fas fa-check-square'></i>"
                    : "<i class='fas fa-window-close'></i>"
                }
              </a>
            </th>
            <th><a href="usuarioEditar.php${
              data.id
            }"><i class="fas fa-pen-square"></i></a></th>
          </tr>
      </tbody>
    </table>`;
  };
}
