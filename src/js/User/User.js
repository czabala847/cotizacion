import { fetchData } from "../FormFetch.js";
import { showModal } from "../Helper/Modal/Modal.js";

class User {
  constructor() {
    this.url = "../Controller/UserController.php";
    this.fd = null;
  }

  //Mostrar usuarios en pantalla
  renderUsers = async (value = "", page = 0, container) => {
    this.fd = new FormData();
    this.fd.set("value", value);
    this.fd.set("page", page);

    const tbUserHTML = await fetchData(this.url, this.fd, "text");

    if (tbUserHTML.success) {
      container.innerHTML = tbUserHTML.response;
    }
  };

  //Cambiar estado de los usuarios
  setStatus = async (idUser) => {
    this.fd = new FormData();
    this.fd.set("modify", "status");

    const linkFetch = `${this.url}?id=${idUser}`;
    const response = await fetchData(linkFetch, this.fd);
    return response;
  };

  //Añadir interactividad a los botones de cambiar estados
  loadStatus = (arrButtons) => {
    arrButtons.forEach((button) => {
      button.addEventListener("click", async (e) => {
        e.preventDefault();
        //Mensajes a mostrar en el modal
        let status = button.dataset.status === "a" ? "desactivado" : "activado";
        let msgAlert = `El usuario quedará ${status}`;

        //Opciones adicionales al modal
        const optModal = {
          showCancelButton: true,
          allowOutsideClick: true,
          allowEscapeKey: true,
        };

        let resultModal = await showModal(
          "¿Estas seguro?",
          msgAlert,
          "warning",
          optModal
        );

        if (resultModal) {
          let result = await this.setStatus(button.dataset.id);
          let resultStatus = result.success ? "success" : "error";
          Swal.fire(result.response, "", resultStatus);
          // await this.renderUsers($tableContainer, $fieldSearch.value, page);
          debugger;
          return result.success;
        }
      });
    });
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
