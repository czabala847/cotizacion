import { fetchData, emptyField } from "./FormFetch.js";

const $formContainer = document.querySelector("#container-form");
const $formLogin = document.querySelector("#form-login");
const $btnRegister = document.querySelector("#registerLogin");

//Cambiar texto del formulario dependiendo si es sign in o sign up
const changeTextForm = (
  formContainer,
  titleForm,
  textFooterForm,
  textLinkForm
) => {
  formContainer.querySelector("h2").innerText = titleForm;
  formContainer.querySelector("span").innerText = textFooterForm;
  formContainer.querySelector("a").innerText = textLinkForm;
};

const showSignUp = (formContainer) => {
  // campos que se muestran en el registro
  const $fieldPassword2 =
    '<input class="login-form__input" type="password" name="contraseña2" placeholder="Repetir Contraseña" required/>';
  const $fieldName =
    '<input class="login-form__input" type="text" name="nombre" placeholder="Nombre completo" required/>';

  if (formContainer) {
    //Cambiar textos del formulario
    changeTextForm(
      formContainer,
      "Registrate",
      "Ya tienes una cuenta?",
      "Iniciar sesión"
    );

    // obtener campo contraseña, ya que es el punto de referencia, donde se mostrara los campos nombre (antes) y contraseña2 (despues)
    let fieldReference = formContainer.querySelector(
      "input[name='contraseña']"
    );

    fieldReference.insertAdjacentHTML("beforebegin", $fieldName);
    fieldReference.insertAdjacentHTML("afterend", $fieldPassword2);
  }
};

const removeSignUp = (formContainer) => {
  if (formContainer) {
    //Cambiar textos esta vez colocando los textos del sign in
    changeTextForm(
      formContainer,
      "Iniciar sesión",
      "No tienes una cuenta?",
      "Registrate"
    );

    //Obtener los campos a eliminar
    let fieldName = formContainer.querySelector("input[name='nombre']");
    let fieldPassword2 = formContainer.querySelector(
      "input[name='contraseña2']"
    );

    //Eliminandolos
    fieldName.parentNode.removeChild(fieldName);
    fieldPassword2.parentNode.removeChild(fieldPassword2);
  }
};

//cambiar entre sign in y sign up
$btnRegister.addEventListener("click", (e) => {
  e.preventDefault();

  //si esta en login cambiar a registrar, si esta en registrar pasar a login
  let dataLogin = $formContainer.dataset.up;

  if (dataLogin === "inactive") {
    showSignUp($formContainer);
    $formContainer.dataset.up = "active";
  } else {
    removeSignUp($formContainer);
    $formContainer.dataset.up = "inactive";
  }
});

$formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();

  const fd = new FormData($formLogin);
  let dataLogin = $formContainer.dataset.up;
  let equalPassword = true;

  //Verificar si el formulario es de registro
  if (dataLogin == "active") {
    if (fd.get("contraseña" !== fd.get("contraseña2"))) {
      equalPassword = false;
    }
  }

  if (equalPassword) {
  }

  let fields = Array.from(fd.entries());

  //Guardar en un array los campos vacios
  let isEmptyField = emptyField(fields);

  if (!isEmptyField) {
    const result = await fetchData("./App/Model/Login.php", fd);
    if (result.response === true) {
      window.location = "./nueva-cotizacion.php";
    } else {
      swal(result.response, "", "error");
      $formLogin.reset();
    }
  } else {
    swal(`El campo ${isEmptyField[0]} está vacío`, "", "error");
  }
});
