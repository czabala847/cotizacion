import formFetch from "../Helper/FormFetch.js";

const $formContainer = document.querySelector("#login-form-container");
const $formLogin = document.querySelector("#login-form");
const $btnRegister = document.querySelector("#registerLogin");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btn-send");
const URL_BASE = "http://localhost/cotizacion/";

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
    changeTextForm(
      formContainer,
      "Registrate",
      "Ya tienes una cuenta?",
      "Iniciar sesión"
    );

    // obtener campo contraseña, ya que es el punto de referencia, donde se mostrara
    // los campos nombre (antes) y contraseña2 (despues)
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

    //Eliminando campos
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
      return Swal.fire("Las contraseñas ingresadas no coinciden", "", "error");
    }

    //Enviar al servidor si la peticion es para hacer signUp
    fd.set("login", "sign-up");
  }

  //Validar campos vacios
  let fields = Array.from(fd.entries());
  let isEmptyField = formFetch.emptyField(fields);

  if (!isEmptyField) {
    //Mostrar icono de cargando...
    formFetch.handlerIconFetch($iconLoading, $btnSend, true);

    const URL_FETCH = URL_BASE + "User/login";
    const result = await formFetch.fetchData(URL_FETCH, fd);

    if (result.response.success) {
      // if (result.response.login == "sign-in") {
      //   window.location = "./App/View/nueva-cotizacion.php";
      // } else {
      //   Swal.fire("Usuario creado correctamente", "", "success");
      // }
    } else {
      Swal.fire(result.response.msg, "", "error");
    }
  } else {
    Swal.fire(`El campo ${isEmptyField[0]} está vacío`, "", "error");
  }

  formFetch.handlerIconFetch($iconLoading, $btnSend, false);
  $formLogin.reset();
});
