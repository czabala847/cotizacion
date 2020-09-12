import formFetch from "../Helper/FormFetch.js";
import tableFetch from "../Helper/TableFetch.js";

const $tableContainer = document.querySelector("#rolesTable");

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
    let btnStatus = event.target.closest(".btn-status");
    if (btnStatus) {
      if (btnStatus.classList.contains("btn-status")) {
        e.preventDefault();
        // setStatusUser(btnStatus.dataset.iduser, container, valueSearch);
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
