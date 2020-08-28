import formFetch from "./FormFetch.js";

//====== Paginador ===============================
const paginatorTable = (arrButtons, container, valueSearch) => {
  let pageShow = 0;
  arrButtons.forEach((button) => {
    button.addEventListener("click", (e) => {
      e.preventDefault();
      // debugger;
      if (!button.classList.contains("btn--disabled")) {
        pageShow = button.dataset.page;
        renderTable(container, { valueSearch, pageShow });
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
  debugger;
  const tableHTML = result.response;

  if (containerRender) {
    if (result.success) {
      containerRender.innerHTML = tableHTML;
      const $arrBtnStatus = document.querySelectorAll(".btn-status");

      //===== Añadir interactividad a los botones de cambiar estados =====
      if ($arrBtnStatus) {
        $arrBtnStatus.forEach((button) => {
          button.addEventListener("click", async (e) => {
            e.preventDefault();
            // setStatus(
            //   button.dataset.id,
            //   containerRender,
            //   valueSearch,
            //   pageShow
            // );
          });
        });
      }

      const $arrBtnPaginator = document.querySelectorAll(
        ".pagination__list--link"
      );

      paginatorTable($arrBtnPaginator, containerRender, valueSearch);
    }
  }
};

export default { renderTable };
