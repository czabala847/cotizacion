import formFetch from "../Helper/FormFetch.js";
import tableFetch from "../Helper/TableFetch.js";
import { showModal, modalRol } from "../Helper/Modal/Modal.js";
import { removeAccents } from "../Helper/Strings.js";

const $tableContainer = document.querySelector("#rolesTable");
const $createRol = document.querySelector("#btnCreateRol");

//====== Cambiar estado de un rol ===============================
const setStatusRol = async (idRol, container) => {
  //Mostrar el modal
  let resultModal = await showModal(
    "¿Estas seguro?",
    "Se cambiará el estado del rol",
    "warning"
  );

  if (resultModal) {
    const URL_FECTH = formFetch.URL_BASE + "roles/setStatus/" + idRol;
    const result = await formFetch.fetchData(URL_FECTH);
    let resultStatus = result.response.success ? "success" : "error";
    let okModal = await showModal("", result.response.response, resultStatus, {
      showCancelButton: false,
    });

    //Despues de un cambio de estado volver a renderizar la tabla usuarios
    if (okModal) {
      renderTableRoles(container);
    }
  }
};

//====== Mostrar roles la tabla ====================
const renderTableRoles = async (container, valueSearch = "") => {
  const urlFetch = formFetch.URL_BASE + "roles/rolesTable";
  const data = {
    valueSearch,
    urlFetch,
  };

  await tableFetch.renderTable(container, data);

  //===== Añadir interactividad a los botones de cambiar estados =====
  container.addEventListener("click", (e) => {
    //Delegación de eventos
    e.preventDefault();
    let btnStatus = e.target.closest(".btn-status");
    let btnEdit = e.target.closest(".btn-edit");

    if (btnStatus) {
      if (btnStatus.classList.contains("btn-status")) {
        setStatusRol(btnStatus.dataset.id, container);
      }
    } else if (btnEdit) {
      if (btnEdit.classList.contains("btn-edit")) {
        updateRol(btnEdit.dataset.id);
      }
    }
  });
};

//===== Validar los datos ingresados en el formulario de los modal =====
const validateFormRol = (data) => {
  if (data) {
    const emptyField = formFetch.emptyField(data);

    if (!emptyField) {
      const fd = new FormData();

      data.forEach((value) => {
        const key = removeAccents(value[0]);
        fd.set(key, value[1]);
      });

      return { status: true, data: fd };
    }

    return { status: false, msg: `El campo ${emptyField[0]} está vacío` };
  }
};

//======== Crear un ROL ========================
const createRol = async (dataRol) => {
  const URL_FECTH = formFetch.URL_BASE + "/roles/add";
  const response = await formFetch.fetchData(URL_FECTH, dataRol);

  if (response.success) {
    let resultStatus = response.response.success ? "success" : "error";
    let okModal = await showModal("", response.response.msg, resultStatus, {
      showCancelButton: false,
    });

    if (okModal === true && response.response.success == true) {
      renderTableRoles($tableContainer);
    }
  }
};

//======== Actualizar ROL ========================
const updateRol = async (idRol) => {
  let URL_FECTH = formFetch.URL_BASE + "/roles/rol/" + idRol;

  //Colocar en el formulario la información del rol seleccionado
  const { response: data } = await formFetch.fetchData(URL_FECTH);
  const { value: rolUpdate } = await modalRol("Actualizar Rol", data.rol);

  const dataRol = validateFormRol(rolUpdate);

  if (dataRol) {
    if (dataRol.status === true) {
      URL_FECTH = formFetch.URL_BASE + "roles/update";
      dataRol.data.set("id", idRol); //Añadir el campo id, del rol y enviarlo por ajax
      const response = await formFetch.fetchData(URL_FECTH, dataRol.data);

      if (response.success) {
        let resultStatus = response.response.success ? "success" : "error";
        let okModal = await showModal("", response.response.msg, resultStatus, {
          showCancelButton: false,
        });

        if (okModal === true && response.response.success == true) {
          renderTableRoles($tableContainer);
        }
      }
    } else {
      Swal.fire(dataRol.msg, "", "error");
    }
  }
};

//======== Main ========================
if ($tableContainer) {
  document.addEventListener("DOMContentLoaded", async () => {
    await renderTableRoles($tableContainer);
  });
}

//Bóton de crear rol
$createRol.addEventListener("click", async () => {
  const { value: data } = await modalRol("Crear Rol");
  const dataRol = validateFormRol(data);

  if (dataRol) {
    if (dataRol.status === true) {
      createRol(dataRol.data);
    } else {
      Swal.fire(dataRol.msg, "", "error");
    }
  }
});
