import formFetch from "../Helper/FormFetch.js";

const $formCotizacion = document.getElementById("frm-cotizacion");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btn-send");

if ($formCotizacion) {
  /***** Evento de submit  *****/
  $formCotizacion.addEventListener("submit", async (e) => {
    e.preventDefault();

    const fd = new FormData($formCotizacion);
    const entries = Array.from(fd.entries()); //Convertir los inputs en array asociativos

    //Ver campos que estan vacios
    const isEmptyField = formFetch.emptyField(entries);

    if (!isEmptyField) {
      formFetch.handlerIconFetch($iconLoading, $btnSend, true);
      const files = okFiles(entries);

      //Si los archivos cargados no arrojan error (0), hacer el fetch
      if (!files.error) {
        const URL_FETCH = formFetch.URL_BASE + "Cotizacion/crear";
        const result = await formFetch.fetchData(URL_FETCH, fd);

        debugger;

        if (result.success && result.response.success) {
          Swal.fire("Enviado Correctamente!", "", "success");
        } else {
          Swal.fire(result.response.errorMessage, "", "error");
        }
      } else {
        Swal.fire(files.message, "", "error");
      }
    } else {
      Swal.fire(`El campo ${isEmptyField[0]} está vacío`, "", "error");
    }

    formFetch.handlerIconFetch($iconLoading, $btnSend, false);
    $formCotizacion.reset();
  });
}

/**** Comprobar si los archivos son validos, para cargarlos al servidor, solo JPG y PDF, maximo 3MB ***/
const okFiles = (entries) => {
  const ALLOWED_EXTENSION = ["image/jpeg", "application/pdf"];
  const MAX_SIZE_FILE = 3000000;
  let sizeFiles = 0;

  let arrayFiles = entries.filter((entry) => {
    return entry[0] === "archivo[]";
  });

  for (let i = 0; i < arrayFiles.length; i++) {
    if (!ALLOWED_EXTENSION.includes(arrayFiles[i][1].type)) {
      return {
        error: true,
        message:
          "El tipo de archivo cargado no esta permitido, solo se permiten PDF y JPG.",
      };
    } else {
      sizeFiles += arrayFiles[i][1].size;
      if (sizeFiles > MAX_SIZE_FILE) {
        return {
          error: true,
          message:
            "El archivo cargado excede el tamaño permitido, solo se pueden subir 3 MB.",
        };
      }
    }
  }

  return {
    error: false,
    message: "Archivo cumple todos los requisitos, para ser subido.",
  };
};
