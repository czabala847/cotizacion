import formFetch from "../Helper/FormFetch.js";

const $tableContainer = document.querySelector("#rolesTable");

//====== Mostrar roles la tabla ====================
const renderTableRoles = async (container, value = "", pageShow = 0) => {
  const fd = new FormData();
  fd.set("value", value);
  fd.set("pageShow", pageShow);

  const URL_FECTH = formFetch.URL_BASE + "roles/rolesTable";
  const result = await formFetch.fetchData(URL_FECTH, fd, "text");

  const tableHTML = result.response;

  if (container) {
    if (result.success) {
      container.innerHTML = tableHTML;

      const $arrBtnStatus = document.querySelectorAll(".btn-status");

      //===== Añadir interactividad a los botones de cambiar estados =====
      $arrBtnStatus.forEach((button) => {
        button.addEventListener("click", async (e) => {
          e.preventDefault();
          setStatusUser(button.dataset.id, container, value, pageShow);
        });
      });

      const $arrBtnPaginator = document.querySelectorAll(
        ".pagination__list--link"
      );

      paginatorTable($arrBtnPaginator, container, value);
    }
  }
};

//======== Main ========================
if ($tableContainer) {
  document.addEventListener("DOMContentLoaded", async () => {
    await renderTableRoles($tableContainer);
  });
}
