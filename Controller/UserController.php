<?php
sleep(3);
class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $dataPage = [
            "titlePage" => "login",
            "titleMetaPage" => "Login"
        ];
        $this->view->loadView($this, "login", $dataPage);
    }

    public function login()
    {
        $identification = $_POST["cedula"];
        $pass = $_POST["contraseña"];
        $action = $_POST["login"];
        $success = false;
        $msg = "Error no se esta haciendo login.";

        if ($action === "sign-in") {
            $responseLogin = $this->model->loginUser($identification, $pass);

            if ($responseLogin === true) {
                $success = true;
                $msg = "Logeado correctamente";
                session_start();
                $_SESSION["newsession"] = $identification;
            } elseif ($responseLogin === false) {
                $msg = "Datos de inicio incorrectos";
            } else {
                $msg = "Ocurrió un error, usuario " . $responseLogin . " en sistema.";
            }
        }
        echo json_encode(["success" => $success, "msg" => $msg], JSON_UNESCAPED_UNICODE);
    }

    public function register()
    {
        $identification = $_POST["cedula"];
        $name = $_POST["nombre"];
        $email = $_POST["email"];
        $pass = $_POST["contraseña"];
        $action = $_POST["login"];
        $success = false;
        $msg = "Error no se esta haciendo un  registro.";

        if ($action === "sign-up") {
            $responseRegister = $this->model->insertUser($identification, $name, $email, $pass);

            if ($responseRegister === true) {
                $success = true;
                $msg = "Registro exitoso, Bienvenido.";
            } elseif ($responseRegister === false) {
                $msg = "Ocurrió un error al registrarse.";
            } else {
                $msg = "Ya existe un usuario con esa cédula";
            }
        }

        echo json_encode(["success" => $success, "msg" => $msg], JSON_UNESCAPED_UNICODE);
    }

    //Cerrar sesión
    public function logout()
    {
        // Inicializar la sesión.
        // Si está usando session_name("algo"), ¡no lo olvide ahora!
        session_start();

        // Destruir todas las variables de sesión.
        $_SESSION = array();

        // Si se desea destruir la sesión completamente, borre también la cookie de sesión.
        // Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
        if (ini_get("session.use_cookies")) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params["path"],
                $params["domain"],
                $params["secure"],
                $params["httponly"]
            );
        }

        // Finalmente, destruir la sesión.
        session_destroy();
        $go = getUrlBase();
        header("Location: $go");
    }
}
