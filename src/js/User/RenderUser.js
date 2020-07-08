import User from "./User.js";
import { fetchLoading } from "../FormFetch.js";
import { showModal } from "../Helper/Modal/Modal.js";

const $tableContainer = document.querySelector("#userTable");
const $fieldSearch = document.querySelector("#fieldSearch");
let timeInterval;
let page = 0;

//Paginador
const paginator = (listPages) => {
  listPages.forEach((link) => {
    link.addEventListener("click", (e) => {
      e.preventDefault();
      // debugger;
      if (!link.classList.contains("btn--disabled")) {
        page = link.dataset.page;
        renderUsers($tableContainer, $fieldSearch.value, page);
      }
    });
  });
};

//Mostrar tabla de usuarios
const renderUsers = async (container, value = "", page = 0) => {
  if (container) {
    const user = new User();

    await user.renderUsers(value, page, container);

    const $btnListStatus = document.querySelectorAll(".btn-status");

    let resultStatus = await user.loadStatus($btnListStatus);
    console.log("Despues del click");

    const $paginatorLink = document.querySelectorAll(".users_pagination--link");
    paginator($paginatorLink);
  }
};

// Editar usuarios
const $formUpdateUser = document.querySelector("#formUpdate");
const $checkPassword = document.querySelector("input[type=checkbox]");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btnEnviar");

const updateUser = (form, elementCheck) => {
  if (elementCheck) {
    const $fieldsPw = document.querySelectorAll("input[type=password]");
    elementCheck.addEventListener("change", (e) => {
      handleFieldPassword(elementCheck.checked, $fieldsPw);
    });
  }

  form.addEventListener("submit", async (e) => {
    e.preventDefault();
    const user = new User();
    fetchLoading($iconLoading, $btnSend, true);
    let result = await user.update(form);
    // modal
    const iconModal = result.success ? "success" : "error";
    const optModal = {
      showCancelButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false,
    };
    let resultModal = await showModal("", result.message, iconModal, optModal);

    if (resultModal) {
      location.reload();
    }
    fetchLoading($iconLoading, $btnSend, false);
    // handleFieldPassword(false, $fieldsPw);
  });
};

if ($formUpdateUser) {
  updateUser($formUpdateUser, $checkPassword);
}
