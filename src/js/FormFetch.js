export async function fetchData(url, data) {
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
}

/**** Comprobar campos vacios ****/
export const emptyField = (arrayFields) => {
  let dataFields = arrayFields.find((entry) => {
    if (entry[0] === "archivo[]") {
      return entry[1].size <= 0;
    } else {
      return entry[1].length <= 0 && entry[0] !== "asunto";
    }
  });

  return dataFields;
};

/**** Mostrar el icono de loading al hacer el fetch ****/
export const fetchLoading = (icon, btnSend, show) => {
  icon.classList.toggle("hidden-element");

  if (show) {
    btnSend.classList.replace("btn--primary", "btn--disabled");
    btnSend.disabled = true;
  } else {
    btnSend.classList.replace("btn--disabled", "btn--primary");
    btnSend.disabled = false;
  }
};
