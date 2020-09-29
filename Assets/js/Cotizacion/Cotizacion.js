import fetchFM from "../Helper/FetchForm.js";

const $formCotizacion = document.getElementById("frm-cotizacion");
const $btnSend = document.querySelector("#btn-send");

if ($formCotizacion) {
  /***** Evento de submit  *****/
  $formCotizacion.addEventListener("submit", async (e) => {
    e.preventDefault();

    const fd = new FormData($formCotizacion);
    const entries = Array.from(fd.entries());
    //Ver campos que estan vacios
    const emptyFields = fetchFM.emptyField(entries);

    if (emptyFields) {
      return Swal.fire(`El campo ${emptyFields[0]} está vacío`, "", "error");
    }

    fetchFM.loading($btnSend, true);
    const files = okFiles(entries);

    //Si los archivos cargados no arrojan error (0), hacer el fetch
    if (!files.error) {
      const URL_FETCH = fetchFM.URL_BASE + "Cotizacion/crear";
      const response = await fetchFM.fetchData(URL_FETCH, fd);

      if (response.success && response.data.success) {
        Swal.fire("Enviado Correctamente!", "", "success");
      } else {
        Swal.fire(response.data.errorMessage, "", "error");
      }
    } else {
      Swal.fire(files.message, "", "error");
    }

    fetchFM.loading($btnSend, false);
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
