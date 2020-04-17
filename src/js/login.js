import { fetchData } from "./FetchData.js";

const $singUpContainer = document.querySelector("#sign-up");
const $btnRegister = document.querySelector("#registerLogin");
const $formLogin = document.querySelector("#form-login");

//Parte donde dice no tienes cuenta o ya tienes cuenta
// $textFooterForm = document.querySelector("#p-text");

const templateSignUp = () => {
  return `    
    <input class="login-form__input" type="password" name="password2" placeholder="Repetir Contraseña" />
    <input class="login-form__input" type="text" name="code" placeholder="Código de registro" />`;
};

//cambiar entre sign in y sign up
$btnRegister.addEventListener("click", (e) => {
  e.preventDefault();

  //si esta en login cambiar a registrar, si esta en registrar pasar a login
  let dataLogin = $singUpContainer.dataset.up;

  if (dataLogin === "inactive") {
    $singUpContainer.innerHTML = templateSignUp();
    $singUpContainer.dataset.up = "active";
  } else {
    $singUpContainer.innerHTML = "";
    $singUpContainer.dataset.up = "inactive";
  }

  // //cambiar data-set
  // $singUpContainer.dataset.login = dataLogin;
});

$formLogin.addEventListener("submit", async (e) => {
  e.preventDefault();

  const fd = new FormData($formLogin);

  const result = await fetchData("./App/Model/Login.php", fd);

  // debugger;

  if (result.response === true) {
    window.location = "http://localhost/cotizacion/nueva-cotizacion.php";
  } else {
    swal(result.response, "", "error");
    $formLogin.reset();
  }
});
