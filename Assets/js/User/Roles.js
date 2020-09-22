import formFetch from "../Helper/FormFetch.js";
import tableFetch from "../Helper/TableFetch.js";
import { showModal } from "../Helper/Modal/Modal.js";

const $tableContainer = document.querySelector("#rolesTable");

//====== Cambiar estado de un rol ===============================
const setStatusRol = async (idRol, container) => {
  //Mostrar el modal
  let resultModal = await showModal(
    "¿Estas seguro?",
    "Se cambiará el estado del rol",
    "warning"
  );

  if (resultModal) {
    // const fd = new FormData();
    // fd.set("modify", "status");

    const URL_FECTH = formFetch.URL_BASE + "roles/setStatus/" + idRol;
    const result = await formFetch.fetchData(URL_FECTH);

    let resultStatus = result.success ? "success" : "error";
    let okModal = await showModal("", result.response.response, resultStatus, {
      showCancelButton: false,
    });

    //Despues de un cambio de estado volver a renderizar la tabla usuarios
    if (okModal) {
      renderTableRoles(container);
    }
  }
};

//====== Mostrar roles la tabla ====================
const renderTableRoles = async (container, valueSearch = "") => {
  const urlFetch = formFetch.URL_BASE + "roles/rolesTable";
  const data = {
    valueSearch,
    urlFetch,
  };

  await tableFetch.renderTable(container, data);

  //===== Añadir interactividad a los botones de cambiar estados =====
  container.addEventListener("click", (e) => {
    //Delegación de eventos
    let btnStatus = e.target.closest(".btn-status");
    if (btnStatus) {
      if (btnStatus.classList.contains("btn-status")) {
        e.preventDefault();
        setStatusRol(btnStatus.dataset.id, container);
      }
    }
  });
};

//======== Main ========================
if ($tableContainer) {
  document.addEventListener("DOMContentLoaded", async () => {
    await renderTableRoles($tableContainer);
  });
}
