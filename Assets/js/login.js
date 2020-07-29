import { fetchData, emptyField, fetchLoading } from "./FormFetch.js";

const $formContainer = document.querySelector("#container-form");
const $formLogin = document.querySelector("#form-login");
const $btnRegister = document.querySelector("#registerLogin");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btn-send");

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
  const $fieldEmail =
    '<input class="login-form__input" type="email" name="email" placeholder="Correo electrónico" required/>';

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
    fieldReference.insertAdjacentHTML("beforebegin", $fieldEmail);
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
    let fieldEmail = formContainer.querySelector("input[name='email']");

    //Eliminandolos
    fieldName.parentNode.removeChild(fieldName);
    fieldPassword2.parentNode.removeChild(fieldPassword2);
    fieldEmail.parentNode.removeChild(fieldEmail);
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
  let signUp = $formContainer.dataset.up;

  //Enviar al servidor si la peticion es para hacer signIn
  fd.set("login", "sign-in");

  //Verificar si el formulario es de registro
  if (signUp == "active") {
    if (fd.get("contraseña") !== fd.get("contraseña2")) {
      $formLogin.reset();
      return swal("Las contraseñas ingresadas no coinciden", "", "error");
    }

    //Enviar al servidor si la peticion es para hacer signUp
    fd.set("login", "sign-up");
  }

  //Guardar los campos del formulario en un array, con llave valor
  let fields = Array.from(fd.entries());

  //Guardar en un array los campos vacios
  let isEmptyField = emptyField(fields);

  //Si no hay campos vacios, proceder con la petición
  if (!isEmptyField) {
    //Mostrar icono de cargando...
    fetchLoading($iconLoading, $btnSend, true);

    const result = await fetchData("./App/Controller/Login.php", fd);
    if (result.response.success) {
      //Si el resultado de la petición era para sign-in, redireccionar a la página siguiente
      if (result.response.login == "sign-in") {
        window.location = "./App/View/nueva-cotizacion.php";
      } else {
        swal("Usuario creado correctamente", "", "success");
      }
    } else {
      swal(result.response.errorMessage, "", "error");
    }
  } else {
    swal(`El campo ${isEmptyField[0]} está vacío`, "", "error");
  }

  fetchLoading($iconLoading, $btnSend, false);
  $formLogin.reset();
});
