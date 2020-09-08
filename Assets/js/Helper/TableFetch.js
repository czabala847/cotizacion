import formFetch from "./FormFetch.js";

//====== Paginador ===============================
const paginatorTable = (arrButtons, containerRender, data) => {
  arrButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      //El botón que este desabilitado, no tendra esta opción
      if (!button.classList.contains("btn--disabled")) {
        const pageShow = button.dataset.page;
        containerRender.dataset.page = pageShow;
        renderTable(containerRender, data);
        console.log("Se ejecuto el paginador");
      }
    });
  });
};

//===== Renderizar datos en la tabla =====
const renderTable = async (containerRender, data) => {
  const { valueSearch, urlFetch } = data;

  const fd = new FormData();
  fd.set("value", valueSearch ? valueSearch : "");
  fd.set("pageShow", containerRender.dataset.page);

  const result = await formFetch.fetchData(urlFetch, fd, "text");
  const tableHTML = result.response;

  // debugger;

  if (containerRender) {
    if (result.success) {
      containerRender.innerHTML = tableHTML;

      const $arrBtnPaginator = document.querySelectorAll(
        ".pagination__list--link"
      );

      paginatorTable($arrBtnPaginator, containerRender, data);
    }
  }
};

export default { renderTable };
