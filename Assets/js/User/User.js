import formFetch from "../Helper/FormFetch.js";
import tableFetch from "../Helper/TableFetch.js";
import { showModal } from "../Helper/Modal/Modal.js";

let timeInterval;

//======== Elementos HTML Necesarios ===================================
const $tableContainer = document.querySelector("#userTable");
const $fieldSearch = document.querySelector("#fieldSearch");

//====== Cambiar estado del usuario ===============================
const setStatusUser = async (idUser, container, value) => {
  //Mostrar el modal
  let resultModal = await showModal(
    "¿Estas seguro?",
    "Se cambiará el estado del usuario",
    "warning"
  );

  if (resultModal) {
    const fd = new FormData();
    fd.set("modify", "status");

    const URL_FECTH = formFetch.URL_BASE + "user/setStatus/" + idUser;
    const result = await formFetch.fetchData(URL_FECTH, fd);

    let resultStatus = result.success ? "success" : "error";
    let okModal = await showModal("", result.response.response, resultStatus, {
      showCancelButton: false,
    });

    //Despues de un cambio de estado volver a renderizar la tabla usuarios
    if (okModal) {
      renderUserTable(container, value);
    }
  }
};

//====== Mostrar tabla de usuarios en pantalla ====================
const renderUserTable = async (container, valueSearch = "") => {
  const urlFetch = formFetch.URL_BASE + "user/userTable";
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
        setStatusUser(btnStatus.dataset.iduser, container, valueSearch);
      }
    }
  });
};

//======== Busqueda en tiempo real de usuarios ========================
if ($fieldSearch) {
  $fieldSearch.addEventListener("keyup", async (e) => {
    clearInterval(timeInterval); //limpiar el intervalo
    timeInterval = setTimeout(async () => {
      const search = e.target.value;
      // debugger;
      await renderUserTable($tableContainer, search);
    }, 1000);
  });
}

//======== Main ========================
if ($tableContainer) {
  document.addEventListener("DOMContentLoaded", () => {
    renderUserTable($tableContainer);
  });
}

//===== Actualizar usuarios =========================================
const updateUser = async (dataForm) => {
  let resultModal = false;
  const optModal = {
    showCancelButton: false,
    allowOutsideClick: false,
    allowEscapeKey: false,
  };

  if (dataForm.get("password") !== dataForm.get("password2")) {
    resultModal = await showModal(
      "",
      "Las contraseñas deben ser iguales",
      "error",
      optModal
    );
    return resultModal;
  }

  dataForm.set("modify", "update");

  const result = await fetchData(URL_FECTH, dataForm);
  // debugger;
  const iconModal = result.success ? "success" : "error";
  const message = result.success
    ? result.response.message
    : "Ocurrio un error al hacer la petición";

  resultModal = await showModal("", message, iconModal, optModal);

  return resultModal;
};

//======== Elementos HTML necesarios =============================================
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

//======== Formulario de actualización de datos ========================
if ($formUpdateUser) {
  $formUpdateUser.addEventListener("submit", async (e) => {
    e.preventDefault();

    const dataForm = new FormData($formUpdateUser);
    console.log(dataForm.get("comboRol"));
    //Icono de cargando
    fetchLoading($iconLoading, $btnSend, true);
    let result = await updateUser(dataForm);
    if (result) {
      location.reload();
    }

    fetchLoading($iconLoading, $btnSend, false);
    // handleFieldPassword(false, $fieldsPw);
  });
}
