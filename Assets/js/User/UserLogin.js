import fetchFM from "../Helper/FetchForm.js";

const $formContainer = document.querySelector("#login-form-container");
const $formLogin = document.querySelector("#login-form");
const $btnRegister = document.querySelector("#registerLogin");
const $btnSend = document.querySelector("#btn-send");

//*** Cambiar texto del formulario dependiendo si es sign in o sign up ***//
const changeTextForm = (formContainer, dataText) => {
  formContainer.querySelector("h2").innerText = dataText.title;
  formContainer.querySelector("span").innerText = dataText.textFooter;
  formContainer.querySelector("a").innerText = dataText.textLink;
};

//*** Mostrar formulario SignUp ***//
const showSignUp = (formContainer) => {
  const $fieldPassword =
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
    fieldReference.insertAdjacentHTML("afterend", $fieldPassword);

    formContainer.dataset.up = "active";
  }
};

//*** Mostrar formulario SignIn ***//
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

    formContainer.dataset.up = "inactive";
  }
};

//*** Registrar o iniciar sesión ***//
const loginUser = async (login, formData) => {
  let loginUrl = "login";

  if (login === "sign-up") {
    if (formData.get("contraseña") !== formData.get("contraseña2")) {
      return {
        success: false,
        msg: "Las contraseñas ingresadas no son iguales",
      };
    }

    loginUrl = "register";
  }

  formData.set("login", login);

  const URL_FETCH = fetchFM.URL_BASE + `User/${loginUrl}`;
  const response = await fetchFM.fetchData(URL_FETCH, formData);

  if (response.success) {
    return response.data;
  }
};

//*** Enviar o Registrar ***//
$formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();

  const fd = new FormData($formLogin);
  fd.set("login", "sign-in");

  //Validar campos vacios
  let emptyField = fetchFM.emptyField(Array.from(fd.entries()));
  let login = $formContainer.dataset.up === "active" ? "sign-up" : "sign-in";

  if (emptyField) {
    return Swal.fire(`El campo ${emptyField[0]} está vacío`, "", "error");
  }

  fetchFM.loadingIcon($btnSend, true);
  const response = await loginUser(login, fd);
  const icon = response.success ? "success" : "error";

  if (response.success && login === "sign-in") {
    window.location = fetchFM.URL_BASE + "dashboard";
  } else {
    Swal.fire(response.msg, "", icon);
  }

  fetchFM.loadingIcon($btnSend, false);
  $formLogin.reset();
});

//*** Cambiar entre SignUp y  SignIn ***//
$btnRegister.addEventListener("click", (e) => {
  e.preventDefault();

  //Obtener si esta en sign in o sign up
  $formContainer.dataset.up === "inactive"
    ? showSignUp($formContainer)
    : removeSignUp($formContainer);
});
