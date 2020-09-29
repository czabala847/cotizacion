const URL_BASE = "http://localhost/cotizacion/";

/**** Petición Fetch ****/
async function fetchData(url, data, type = "json") {
  let config;

  if (data) {
    config = {
      method: "POST",
      body: data,
    };
  }

  try {
    const response = await fetch(url, config);
    let data;

    switch (type) {
      case "json":
        data = await response.json();
        break;
      case "text":
        data = await response.text();
        break;
    }

    return { success: true, data };
  } catch (error) {
    return { success: false, error };
  }
}

/**** Comprobar campos vacios ****/
function emptyField(arrFields) {
  let emptyFields = arrFields.find((field) => {
    if (field[0] === "archivo[]") {
      return field[1].size <= 0;
    } else {
      return field[1].length <= 0 && field[0] !== "asunto";
    }
  });
  return emptyFields;
}

/**** Mostrar el icono de cargando al hacer el fetch ****/
function loadingIcon(btn, active) {
  const $icon = document.querySelector("#icon-loading");
  $icon.classList.toggle("hidden-element");

  if (active) {
    btn.classList.replace("btn--primary", "btn--disabled");
    btn.disabled = true;
  } else {
    btn.classList.replace("btn--disabled", "btn--primary");
    btn.disabled = false;
  }
}

export default { URL_BASE, fetchData, emptyField, loadingIcon };
