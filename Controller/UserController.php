<?php
// sleep(3);
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
            "titleMetaPage" => "Login",
            "urlPage" => "user"

        ];
        $this->view->loadView($this, "login", $dataPage);
    }

    public function user()
    {
        $dataPage = [
            "titlePage" => "usuarios",
            "titleMetaPage" => "Usuarios",
            "urlPage" => "user"
        ];
        $this->view->loadView($this, "user", $dataPage);
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
        die();
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
        die();
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

    //Mostrar tabla con todos los usuarios
    public function userTable()
    {
        $valueSearch = $_POST["value"];
        $page = $_POST["pageShow"];

        $response = $this->model->getAllUsers($valueSearch, $page);

        $dataTable = [
            "columns" => ["id", "Cédula", "Nombre", "Correo", "Perfil"],
            "keys" => ["id", "cedula", "nombre", "correo", "perfil"],
            "data" => $response["data"],
            "actualPage" => $response["pageShow"],
            "numberPages" => $response["numberPagesShow"]
        ];


        // echo json_encode($dataTable);
        echo getTableTemplate($dataTable);
        die();
    }

    public function setStatus(int $idUser)
    {
        $response = $this->model->setStatusUser($idUser);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function edit(int $idUser)
    {

        $user = $this->model->searchUser($idUser);

        $dataPage = [
            "titlePage" => "usuarios",
            "titleMetaPage" => "Editar Usuarios",
            "urlPage" => "user",
            "user" => $user
        ];
        $this->view->loadView($this, "editarUsuario", $dataPage);
    }
}
