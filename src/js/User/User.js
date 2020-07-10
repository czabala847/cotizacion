import { fetchData } from "../FormFetch.js";
import { showModal } from "../Helper/Modal/Modal.js";

class User {
  constructor() {
    this.url = "../Controller/UserController.php";
    this.fd = null;
  }

  //====== Cambiar estado del usuario ===============================
  //====== Nota: cuando se cree el datatable.js no se pedira el valor y la página por parametro
  setStatus = async (idUser, container, value, page) => {
    //Mostrar el modal
    let resultModal = await showModal(
      "¿Estas seguro?",
      "Se cambiará el estado del usuario",
      "warning"
    );

    if (resultModal) {
      this.fd = new FormData();
      this.fd.set("modify", "status");

      const linkFetch = `${this.url}?id=${idUser}`;
      const result = await fetchData(linkFetch, this.fd);

      let resultStatus = result.success ? "success" : "error";
      let okModal = await showModal("", result.response, resultStatus, {
        showCancelButton: false,
      });

      if (okModal) {
        this.renderUsers(container, value, page);
      }
    }
  };

  //====== Mostrar tabla de usuarios en pantalla ====================
  renderUsers = async (container, value = "", page = 0) => {
    this.fd = new FormData();
    this.fd.set("value", value);
    this.fd.set("page", page);

    const tbUserHTML = await fetchData(this.url, this.fd, "text");

    if (tbUserHTML.success) {
      container.innerHTML = tbUserHTML.response;

      const arrButtons = document.querySelectorAll(".btn-status");

      //===== Añadir interactividad a los botones de cambiar estados =====
      arrButtons.forEach((button) => {
        button.addEventListener("click", async (e) => {
          e.preventDefault();
          this.setStatus(button.dataset.id, container, value, page);
        });
      });
    }
  };

  //===== Actualizar usuarios =========================================
  updateUser = async (dataForm) => {
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

    const result = await fetchData(this.url, dataForm);

    const iconModal = result.success ? "success" : "error";

    const message = result.success
      ? result.response.message
      : "Ocurrio un error al hacer la petición";

    resultModal = await showModal("", message, iconModal, optModal);

    return resultModal;
  };
}

export default User;
