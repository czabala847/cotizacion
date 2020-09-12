import formFetch from "../Helper/FormFetch.js";

const $formContainer = document.querySelector("#login-form-container");
const $formLogin = document.querySelector("#login-form");
const $btnRegister = document.querySelector("#registerLogin");
const $iconLoading = document.querySelector("#icon-loading");
const $btnSend = document.querySelector("#btn-send");

//Cambiar texto del formulario dependiendo si es sign in o sign up
const changeTextForm = (formContainer, dataText) => {
  formContainer.querySelector("h2").innerText = dataText.title;
  formContainer.querySelector("span").innerText = dataText.textFooter;
  formContainer.querySelector("a").innerText = dataText.textLink;
};

const showSignUp = (formContainer) => {
  // campos que se muestran en el registro
  const $fieldPassword2 =
    '<input type="password" name="contraseña2" placeholder="Repetir Contraseña" required/>';
  const $fieldName =
    '<input type="text" name="nombre" placeholder="Nombre completo" required/>';
  const $fieldEmail =
    '<input type="email" name="email" placeholder="Correo electrónico" required/>';

  const dataText = {
    title: "Registrate",
    textFooter: "Ya tienes una cuenta?",
    textLink: "Iniciar sesión",
  };

  if (formContainer) {
    changeTextForm(formContainer, dataText);

    // obtener campo contraseña, ya que es el punto de referencia, donde se mostrara
    // los campos nombre (antes) y contraseña2 (despues)
    let fieldReference = formContainer.querySelector(
      "input[name='contraseña']"
    );

    fieldReference.insertAdjacentHTML("beforebegin", $fieldName);
    fieldReference.insertAdjacentHTML("beforebegin", $fieldEmail);
    fieldReference.insertAdjacentHTML("afterend", $fieldPassword2);
    // debugger;
  }
};

const removeSignUp = (formContainer) => {
  if (formContainer) {
    const dataText = {
      title: "Iniciar sesión",
      textFooter: "No tienes una cuenta?",
      textLink: "Registrate",
    };

    changeTextForm(formContainer, dataText);

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
  fd.set("login", "sign-in");

  //Validar campos vacios
  let fields = Array.from(fd.entries());
  let isEmptyField = formFetch.emptyField(fields);

  if (!isEmptyField) {
    if (signUp == "active") {
      if (fd.get("contraseña") !== fd.get("contraseña2")) {
        $formLogin.reset();
        return Swal.fire(
          "Las contraseñas ingresadas no son iguales",
          "",
          "error"
        );
      }

      fd.set("login", "sign-up");
      formFetch.handlerIconFetch($iconLoading, $btnSend, true); //Mostrar icono de cargando...
      //PETICION PARA REGISTRAR
      const responseRegister = await formFetch.fetchData(
        formFetch.URL_BASE + "User/register",
        fd
      );

      if (responseRegister.success) {
        let icon = responseRegister.response.success ? "success" : "error";
        Swal.fire(responseRegister.response.msg, "", icon);
      } else {
        Swal.fire("Error al hacer la petición", "", "error");
      }
    } else {
      formFetch.handlerIconFetch($iconLoading, $btnSend, true);
      //PETICION PARA LOGIN
      const responseLogin = await formFetch.fetchData(
        formFetch.URL_BASE + "User/login",
        fd
      );

      if (responseLogin.response.success) {
        window.location = formFetch.URL_BASE + "dashboard";
      } else {
        Swal.fire(responseLogin.response.msg, "", "error");
      }
    }
  } else {
    Swal.fire(`El campo ${isEmptyField[0]} está vacío`, "", "error");
  }

  formFetch.handlerIconFetch($iconLoading, $btnSend, false);
  $formLogin.reset();
});
