import User from "./User.js";
import { fetchLoading } from "../FormFetch.js";

const $tableContainer = document.querySelector("#userTable");
const $fieldSearch = document.querySelector("#fieldSearch");
let timeInterval;
let page = 0;

const showModal = async (title = "", text, icon, opt) => {
  let resultModal = await Swal.fire({
    title: title,
    text: text,
    icon: icon,
    showCancelButton: opt.showCancelButton,
    confirmButtonColor: "#353a62",
    cancelButtonColor: "#ce0f3d",
    confirmButtonText: "Ok",
    cancelButtonText: "Cancelar",
    allowOutsideClick: opt.allowOutsideClick,
    allowEscapeKey: opt.allowEscapeKey,
  }).then((result) => result.value);

  return resultModal;
};

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
    container.innerHTML = await user.getAllUsers(value, page);

    const $btnListStatus = document.querySelectorAll(".btn-status");
    loadStatus($btnListStatus);

    const $paginatorLink = document.querySelectorAll(".users_pagination--link");
    paginator($paginatorLink);
  }
};

//Cambiar estados del usuario
const loadStatus = (listElements) => {
  listElements.forEach((element) => {
    element.addEventListener("click", async (e) => {
      e.preventDefault();
      let alertms = element.dataset.status === "a" ? "desactivado" : "activado";
      let msg = `El usuario quedara ${alertms}`;
      const optModal = {
        showCancelButton: true,
        allowOutsideClick: true,
        allowEscapeKey: true,
      };

      let resultModal = await showModal(
        "¿Estas seguro?",
        msg,
        "warning",
        optModal
      );

      if (resultModal) {
        const user = new User();
        let result = await user.setStatus(element.dataset.id);
        let resultStatus = result.success ? "success" : "error";
        Swal.fire(result.response, "", resultStatus);
        await renderUsers($tableContainer, $fieldSearch.value, page);
      }
    });
  });
};

if ($tableContainer) {
  document.addEventListener("DOMContentLoaded", async () => {
    await renderUsers($tableContainer);
  });

  $fieldSearch.addEventListener("keyup", async (e) => {
    clearInterval(timeInterval); //limpiar el intervalo
    timeInterval = setTimeout(async () => {
      await renderUsers($tableContainer, e.target.value);
    }, 1000);
  });
}

// Editar usuarios
const $formUpdateUser = document.querySelector("#formUpdate");
const $checkPassword = document.querySelector("input[type=checkbox]");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btnEnviar");

//Activar y desactivar los campos contraseña
const handleFieldPassword = (check, fieldsPass) => {
  fieldsPass.forEach((field) => {
    if (check) {
      field.removeAttribute("disabled");
      field.setAttribute("required", "");
    } else {
      field.removeAttribute("required");
      field.setAttribute("disabled", "");
    }
  });
};

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
      // location.reload();
    }
    fetchLoading($iconLoading, $btnSend, false);
    // handleFieldPassword(false, $fieldsPw);
  });
};

if ($formUpdateUser) {
  updateUser($formUpdateUser, $checkPassword);
}
