const $form = document.getElementById("frm-cotizacion");

/***** Evento de submit  *****/
$form.addEventListener("submit", async (e) => {
  e.preventDefault();
  const fd = new FormData($form);

  //FormData.entries, devuelve un objeto con los campos y valores del formulario, se convierte en un array con Array.from
  let entries = Array.from(fd.entries());

  //Ver campos que estan vacios
  let isEmptyField = emptyField(entries);

  if (!isEmptyField) {
    let files = okFiles(entries);

    //Si los archivos cargados no arrojan error (0), hacer el fetch
    if (!files.error) {
      const result = await fetchData("./App/Model/insert.php", fd);
      if (result.success && result.response.success) {
        swal("Enviado Correctamente!", "", "success");
      } else {
        swal(result.response.errorMessage, "", "error");
      }
    } else {
      swal(files.message, "", "error");
    }
  } else {
    swal(`El campo ${isEmptyField[0]} está vacío`, "", "error");
  }
});

/**** Llamada AJAX *****/
const fetchData = async (url, data) => {
  const config = {
    method: "POST",
    body: data,
  };

  try {
    const urlFetch = await fetch(url, config);
    const response = await urlFetch.json();
    return { success: true, response: response };
  } catch (error) {
    return { success: false, error };
  }
};

/**** Comprobar campos vacios ****/
const emptyField = (entries) => {
  let dataEntries = entries.find((entry) => {
    if (entry[0] === "archivo[]") {
      return entry[1].size <= 0;
    } else {
      return entry[1].length <= 0 && entry[0] !== "asunto";
    }
  });

  return dataEntries;
};

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
