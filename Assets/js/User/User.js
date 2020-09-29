import fetchFM from "../Helper/FetchForm.js";
import fetchTB from "../Helper/FetchTable.js";
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

    const URL_FECTH = fetchFM.URL_BASE + "user/setStatus/" + idUser;
    const result = await fetchFM.fetchData(URL_FECTH, fd);

    let resultStatus = result.success ? "success" : "error";

    let okModal = await showModal("", result.data.response, resultStatus, {
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
  const urlFetch = fetchFM.URL_BASE + "user/userTable";
  const data = {
    valueSearch,
    urlFetch,
  };

  await fetchTB.renderTable(container, data);

  //===== Añadir interactividad a los botones de cambiar estados =====
  container.addEventListener("click", (e) => {
    //Delegación de eventos
    let btnStatus = e.target.closest(".btn-status");
    if (btnStatus) {
      if (btnStatus.classList.contains("btn-status")) {
        e.preventDefault();
        setStatusUser(btnStatus.dataset.id, container, valueSearch);
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
  if (dataForm.get("password") !== dataForm.get("password2")) {
    return {
      success: false,
      msg: "Las contraseñas ingresadas no son iguales",
    };
  }

  const URL_FECTH = fetchFM.URL_BASE + "user/update";
  const response = await fetchFM.fetchData(URL_FECTH, dataForm);

  if (response.success) {
    return response.data;
  }
};

//======== Elementos HTML necesarios =============================================
const $formUpdateUser = document.querySelector("#formUpdate");
const $checkPassword = document.querySelector("input[type=checkbox]");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btnEnviar");
const $comboRol = document.querySelector("#comboRol");

//======== Activar y desactivar los campos contraseñas ==================
const handlerPasswordFields = (passFields, showFields = true) => {
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
    handlerPasswordFields($fieldsPw, $checkPassword.checked)
  );
}

//======== Mostrar los roles en el combobox ==================
const loadRoles = async (comboBox) => {
  const URL_FECTH = fetchFM.URL_BASE + "roles/show";
  const response = await fetchFM.fetchData(URL_FECTH);

  const arrRoles = response.data;
  comboBox.innerHTML = "";
  const idRol = comboBox.dataset.profile;
  arrRoles.forEach((rol) => {
    comboBox.innerHTML += `<option value="${rol.id}">${rol.nombre}</option>`;
  });

  comboBox.value = idRol;
};

//======== Formulario de actualizar usuarios ========================
if ($formUpdateUser) {
  //Cargar los roles en el combobox
  document.addEventListener("DOMContentLoaded", () => {
    loadRoles($comboRol); //Cargar los roles en el select
  });

  //Acción de enviar en el formulario
  $formUpdateUser.addEventListener("submit", async (e) => {
    e.preventDefault();

    const fd = new FormData($formUpdateUser);
    fetchFM.loadingIcon($btnSend, true); //Mostrar icono de loading

    //Validar campos vacios
    let emptyField = fetchFM.emptyField(Array.from(fd.entries()));
    if (emptyField) {
      fetchFM.loadingIcon($btnSend, false);
      return Swal.fire(`El campo ${emptyField[0]} está vacío`, "", "error");
    }

    const responseUpdate = await updateUser(fd);
    const icon = responseUpdate.success ? "success" : "error";
    const optModal = {
      showCancelButton: false,
      allowOutsideClick: false,
      allowEscapeKey: false,
    };
    const responseModal = await showModal(
      "",
      responseUpdate.msg,
      icon,
      optModal
    );

    if (responseModal) {
      location.reload();
    }

    fetchFM.loadingIcon($btnSend, false);
  });
}
