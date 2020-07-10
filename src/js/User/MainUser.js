import User from "./User.js";
import { fetchLoading } from "../FormFetch.js";

//======== Elementos HTML Necesarios ===================================
const $tableContainer = document.querySelector("#userTable");
const $fieldSearch = document.querySelector("#fieldSearch");

let timeInterval;
let objUser = new User();

//======== Cuando este en la página de la lista de usuarios =============
if ($tableContainer) {
  //======== Cuando se carge completamente la página ====================
  document.addEventListener("DOMContentLoaded", async () => {
    await objUser.renderUsers($tableContainer);
  });

  //======== Busqueda en tiempo real de usuarios ========================
  $fieldSearch.addEventListener("keyup", async (e) => {
    clearInterval(timeInterval); //limpiar el intervalo
    timeInterval = setTimeout(async () => {
      await objUser.renderUsers($tableContainer, e.target.value);
    }, 1000);
  });
}

//======== Editar usuarios =============================================
const $formUpdateUser = document.querySelector("#formUpdate");
const $checkPassword = document.querySelector("input[type=checkbox]");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btnEnviar");

//======== Activar y desactivar los campos contraseñas ==================
const handlePasswordFields = (passFields, showFields = true) => {
  passFields.forEach((field) => {
    if (showFields) {
      field.removeAttribute("disabled");
      field.setAttribute("required", "");
    } else {
      field.removeAttribute("required");
      field.setAttribute("disabled", "");
    }
  });
};

if ($checkPassword) {
  const $fieldsPw = document.querySelectorAll("input[type=password]");
  $checkPassword.addEventListener("change", () =>
    handlePasswordFields($fieldsPw, $checkPassword.checked)
  );
}

if ($formUpdateUser) {
  $formUpdateUser.addEventListener("submit", async (e) => {
    e.preventDefault();
    objUser = new User();

    const dataForm = new FormData($formUpdateUser);

    //Icono de cargando
    fetchLoading($iconLoading, $btnSend, true);
    let result = await objUser.updateUser(dataForm);
    if (result) {
      location.reload();
    }

    fetchLoading($iconLoading, $btnSend, false);
    // handleFieldPassword(false, $fieldsPw);
  });
}
