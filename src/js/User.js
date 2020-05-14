import { fetchData } from "./FormFetch.js";

//Listar todos los botones de modicar el estado
let $listElements = document.querySelectorAll(".btn-status");

//A cada item añadir el evento click, que enviara la petición AJAX
$listElements.forEach((element) => {
  element.addEventListener("click", async (e) => {
    e.preventDefault();

    //Mensaje del modal
    let messageStatus =
      element.dataset.status === "a" ? "desactivado" : "activado";

    let resultModal = await Swal.fire({
      title: "¿Estas seguro?",
      text: `El usuario quedara ${messageStatus}`,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#353a62",
      cancelButtonColor: "#ce0f3d",
      confirmButtonText: "Si, confirmar",
      cancelButtonText: "Cancelar",
    }).then((result) => result.value);

    //Si en el modal se seleccion OK
    if (resultModal) {
      //Obtener URL del llamado al servidor
      let link = element.dataset.href + "?id=" + element.dataset.id;

      //Enviar una variable modify, para validar en el servidor que acción se va a realizar si cambiar el estado o actualizar el cliente
      const formData = new FormData();
      formData.append("modify", "status");

      const result = await fetchData(link, formData);
      // Swal.fire(result.response, "", "success");

      window.location = "../../App/View/usuarios.php";
    }
  });
});
