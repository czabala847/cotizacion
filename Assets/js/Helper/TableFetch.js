import formFetch from "./FormFetch.js";

//====== Paginador ===============================
const paginatorTable = (arrButtons, containerRender, data) => {
  arrButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      // debugger;
      //El botón que este desabilitado, no tendra esta opción
      if (!button.classList.contains("btn--disabled")) {
        data.pageShow = button.dataset.page;
        containerRender.dataset.page = data.pageShow;
        renderTable(containerRender, data);
        debugger;
      }
    });
  });
};

//===== Renderizar datos en la tabla =====
const renderTable = async (containerRender, data) => {
  const { valueSearch, pageShow, urlFetch } = data;

  const fd = new FormData();
  fd.set("value", valueSearch ? valueSearch : "");
  fd.set("pageShow", pageShow ? pageShow : 0);

  const result = await formFetch.fetchData(urlFetch, fd, "text");
  const tableHTML = result.response;

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
