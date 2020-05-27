import { fetchData } from "../FormFetch.js";

class User {
  constructor() {
    this.url = "../Controller/UserController.php";
    this.fd = null;
  }

  //Mostrar usuarios en pantalla
  getAllUsers = async (value, page) => {
    this.fd = new FormData();
    //Valor a buscar por defecto cadena de texto vacia
    this.fd.set("value", value);
    //Número de la página a buscar, empieza desde la primera (0)
    this.fd.set("page", page);

    const result = await fetchData(this.url, this.fd, "text");

    if (result.success) {
      return result.response;
    }
  };

  //Cambiar estado de los usuarios
  setStatus = async (id) => {
    this.fd = new FormData();
    this.fd.set("modify", "status");

    const linkFetch = `${this.url}?id=${id}`;
    const response = await fetchData(linkFetch, this.fd);
    return response;
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
