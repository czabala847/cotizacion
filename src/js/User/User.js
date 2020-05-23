import { fetchData, fetchLoading } from "../FormFetch.js";

class User {
  constructor() {
    this.url = "../Controller/UserController.php";
    this.fd = null;
  }

  //Mostrar usuarios en pantalla
  renderUsers = async (containerRender, value = "", page = 0) => {
    this.fd = new FormData();
    //Valor a buscar por defecto cadena de texto vacia
    this.fd.set("value", value);
    //Número de la página a buscar, empieza desde la primera (0)
    this.fd.set("page", page);

    const result = await fetchData(this.url, this.fd, "text");

    if (containerRender) {
      containerRender.innerHTML = result.response;
      //paginator();
      return true;
    }

    return false;
  };

  //Cambiar estado de los usuarios
  setStatus = async (id) => {
    this.fd = new FormData();
    this.fd.set("modify", "status");

    const linkFetch = `${this.url}?id=${id}`;
    const response = await fetchData(linkFetch, this.fd);
    return response;
  };
}

export default User;
