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

  //Si se ingresa un valor a buscar, no tener encuenta las paginas, es decir, las paginas sera igual a 0
  if (valueSearch.length <= 0 || valueSearch === "") {
    fd.set("pageShow", containerRender.dataset.page);
  } else {
    fd.set("pageShow", 0);
  }

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
