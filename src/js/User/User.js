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

      //===== Añadir interactividad a los botones de cambiar estados ======
      arrButtons.forEach((button) => {
        button.addEventListener("click", async (e) => {
          e.preventDefault();
          this.setStatus(button.dataset.id, container, value, page);
        });
      });
    }
  };

  //Actualizar usuario
  update = async (form) => {
    this.fd = new FormData(form);
    if (this.fd.get("password") !== this.fd.get("password2")) {
      return {
        success: false,
        message: "Las contraseñas ingresadas no coinciden.",
      };
    }

    this.fd.set("modify", "update");
    const result = await fetchData(this.url, this.fd);
    if (result.success) {
      return {
        success: result.response.success,
        message: result.response.message,
      };
    } else {
      return {
        success: false,
        message: "Error al hacer la petición.",
      };
    }
  };
}

export default User;
