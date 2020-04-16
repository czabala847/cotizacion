const templateLogin = (title, login) => {
  $textFooterForm.innerText =
    login === "sign-in" ? "No tienes una cuenta?" : "Ya tienes una cuenta?";

  $btnRegister.innerText =
    login === "sign-in" ? "Registrate" : "Iniciar sesión";

  return `  
  <h2>${title}</h2>
  <form class="quotation__form" action="" autocomplete="off" method="POST">
    <input class="login-form__input" type="text" name="user" placeholder="Usuario" />
    <input class="login-form__input" type="password" name="password" placeholder="Contraseña" />
    ${
      login === "sign-up"
        ? `<input class="login-form__input" type="password" name="password2" placeholder="Repetir Contraseña" />
           <input class="login-form__input" type="text" name="code" placeholder="Código de registro" />`
        : ``
    }
    <input class="btn btn--primary" type="submit" value="Enviar" />
  </form>
  `;
};

$formContainer = document.querySelector("#change-form");
$btnRegister = document.querySelector("#registerLogin");

//Parte donde dice no tienes cuenta o ya tienes cuenta
$textFooterForm = document.querySelector("#p-text");

//cambiar entre sign in y sign up
$btnRegister.addEventListener("click", (e) => {
  e.preventDefault();

  //si esta en login cambiar a registrar, si esta en registrar pasar a login
  let dataLogin =
    $formContainer.dataset.login == "sign-in" ? "sign-up" : "sign-in";

  if (dataLogin === "sign-up") {
    $formContainer.innerHTML = templateLogin("Registrate", dataLogin);
    // $textFooterForm.innerText = "Ya tienes una cuenta?";
    // $btnRegister.innerText = "";
  } else {
    $formContainer.innerHTML = templateLogin("Iniciar sesión", dataLogin);
  }

  //cambiar data-set
  $formContainer.dataset.login = dataLogin;
});

//Por defecto se renderiza el sign in
$formContainer.innerHTML = templateLogin(
  "Iniciar sesión",
  $formContainer.dataset.login
);
