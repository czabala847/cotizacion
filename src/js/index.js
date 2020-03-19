const $form = document.getElementById("frm-cotizacion");
// const $respuesta = document.getElementById("respuesta");

$form.addEventListener("submit", async e => {
  e.preventDefault();
  const fd = new FormData($form);

  //FormData.entries, devuelve un objeto con los campos y valores del formulario
  //Para recorrer eso se convierte en un Array, con Array.from
  //entries tiene campo y valor del input
  let entries = Array.from(fd.entries());

  //Ver campos que estan vacios
  let isEmptyField = emptyField(entries);

  if (!isEmptyField) {
    //file = objeto con el tamaño total de todos los archivos cargados y si la extensión es correcta (true)
    let file = okFile(entries);

    //Si la extensión es correcta (JPG y PDF)
    if (file.extension) {
      if (file.allSize <= 3000000) {
        const result = await fetchData("./App/Model/insert.php", fd);
        if (result.success && result.response.success) {
          swal("Enviado Correctamente!", "", "success");
        } else {
          const errorMessage = result.response.errorMessage;
          swal(errorMessage, "", "error");
        }
      } else {
        swal(
          "El archivo cargado excede el tamaño permitido, solo se pueden subir 3 MB.",
          "",
          "error"
        );
      }
    } else {
      swal(
        "El tipo de archivo cargado no esta permitido, solo se permiten PDF y JPG.",
        "",
        "error"
      );
    }
  } else {
    swal(`El campo ${isEmptyField[0]} está vacío`, "", "error");
  }
});

/* Llamada a la api */
const fetchData = async (url, data) => {
  const config = {
    method: "POST",
    body: data
  };

  try {
    const urlFetch = await fetch(url, config);
    const response = await urlFetch.json();
    return { success: true, response: response };
  } catch (error) {
    return { success: false, error: error };
  }
};

/* Comprobar campos vacios */
const emptyField = entries => {
  let dataEntries = entries.find(entry => {
    if (entry[0] === "archivo[]") {
      return entry[1].size <= 0;
    } else {
      return entry[1].length <= 0 && entry[0] !== "asunto";
    }
  });

  return dataEntries;
};

//Comprobar que las extensiones del archivo son las correctas y sumar el tamaño de los archivos
const okFile = entries => {
  const ALLOWED_EXTENSION = ["image/jpeg", "application/pdf"];

  let arrayFiles = [];

  entries.forEach(entry => {
    if (entry[0] === "archivo[]") {
      arrayFiles.push(entry[1]);
    }
  });

  let sizeFiles = 0;

  for (let i = 0; i < arrayFiles.length; i++) {
    if (!ALLOWED_EXTENSION.includes(arrayFiles[i].type)) {
      return { extension: false, allSize: 0 };
    } else {
      sizeFiles += arrayFiles[i].size;
    }
  }

  return { extension: true, allSize: sizeFiles };
};
