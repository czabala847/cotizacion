const $form = document.getElementById("frm-cotizacion");
// const $respuesta = document.getElementById("respuesta");

$form.addEventListener("submit", async e => {
  e.preventDefault();

  const dataForm = new FormData($form);

  const response = await fetchData("./App/Model/insert.php", dataForm);
  // $respuesta.innerHTML = response;

  if (response.success) {
    swal("Enviado Correctamente!", "", "success");
  }
});

const fetchData = async (url, data) => {
  const config = {
    method: "POST",
    body: data
  };

  try {
    const urlFetch = await fetch(url, config);
    const response = await urlFetch.text();
    return { success: true, response: response };
  } catch (error) {
    return { success: false, error: error };
  }
};
