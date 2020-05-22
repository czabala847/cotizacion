import { fetchData, fetchLoading } from "./FormFetch.js";

//Despues que se renderice la tabla con los usuarios, añadir la funcionalidad de cambiar el estado al usuario
const loadStates = () => {
  //Listar todos los botones de modicar el estado
  let $listElements = document.querySelectorAll(".btn-status");
  //Cambiar estados de los usuarios

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
        let link =
          "../Controller/UserController.php" + "?id=" + element.dataset.id;

        //Enviar una variable modify, para validar en el servidor que acción se va a realizar si cambiar el estado o actualizar el cliente
        const formData = new FormData();
        formData.append("modify", "status");

        await fetchData(link, formData);
        // Swal.fire(result.response, "", "success");

        window.location = "../../App/View/usuarios.php";
      }
    });
  });
};

// Editar usuarios
const $formUpdateUser = document.querySelector("#formUpdate");
const $checkPassword = document.querySelector("input[type=checkbox]");

if ($formUpdateUser) {
  const $iconLoading = document.querySelector("#icon-loading");
  const $btnSend = document.querySelector("#btnEnviar");

  $formUpdateUser.addEventListener("submit", async (e) => {
    e.preventDefault();
    const fd = new FormData($formUpdateUser);
    fetchLoading($iconLoading, $btnSend, true);
    if (fd.get("password") !== fd.get("password2")) {
      $formUpdateUser.reset();
      fetchLoading($iconLoading, $btnSend, false);
      handleFieldPassword(false);
      return Swal.fire("Las contraseñas ingresadas no coinciden", "", "error");
    }
    fd.set("modify", "update");
    const result = await fetchData("../Controller/UserController.php", fd);
    // debugger;
    if (result.success) {
      if (result.response.success) {
        Swal.fire(result.response, "", "success");
        Swal.fire({
          text: "Actualizado con exito",
          icon: "success",
          showCancelButton: false,
          confirmButtonColor: "#353a62",
          confirmButtonText: "Ok",
          allowOutsideClick: false,
          allowEscapeKey: false,
        }).then((result) => {
          if (result.value) {
            location.reload();
          }
        });
      } else {
        Swal.fire(result.response.message, "", "error");
      }
    } else {
      Swal.fire("Error al hacer la petición", "", "error");
    }
    fetchLoading($iconLoading, $btnSend, false);
  });
}

if ($checkPassword) {
  $checkPassword.addEventListener("change", (e) => {
    handleFieldPassword($checkPassword.checked);
  });
}

//Activar y desactivar los campos contraseña
const handleFieldPassword = (check) => {
  const $fieldsPw = document.querySelectorAll("input[type=password]");
  $fieldsPw.forEach((field) => {
    if (check) {
      field.removeAttribute("disabled");
      field.setAttribute("required", "");
    } else {
      field.removeAttribute("required");
      field.setAttribute("disabled", "");
    }
  });
};

//Detectar evento en la caja de texto
const $fieldSearch = document.querySelector("#fieldSearch");
let timeInterval;

if ($fieldSearch) {
  $fieldSearch.addEventListener("keyup", async (e) => {
    clearInterval(timeInterval); //limpiar el intervalo
    let loaded;

    timeInterval = setTimeout(async () => {
      loaded = await searchUser(e.target.value);
      if (loaded) {
        loadStates();
      }
    }, 1000);
  });
}

//Busqueda de usuarios en tiempo real
const searchUser = async (text = "") => {
  const fieldText = new FormData();
  fieldText.set("value", text);
  const result = await fetchData(
    "../Controller/UserController.php",
    fieldText,
    "text"
  );
  // debugger;
  const $userTable = document.querySelector("#userTable");

  if ($userTable) {
    $userTable.innerHTML = result.response;
  }

  return true;
};

document.addEventListener("DOMContentLoaded", async () => {
  let loaded = await searchUser();

  if (loaded) {
    loadStates();

    const $paginatorLink = document.querySelectorAll(".users_pagination--link");

    $paginatorLink.forEach((link) => {
      link.addEventListener("click", (e) => {
        e.preventDefault();
      });
    });
  }
});
