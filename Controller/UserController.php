<?php

class UserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function home()
    {
        $this->view->loadView($this, "login");
    }

    public function login()
    {
        $identification = $_POST["cedula"];
        $pass = $_POST["contraseña"];
        $action = $_POST["login"];
        $success = false;
        $msg = "";

        $responseLogin = $this->model->loginUser($identification, $pass);

        if ($responseLogin === true) {
            $success = true;
            $msg = "Logeado correctamente";
        } elseif ($responseLogin === false) {
            $msg = "Datos de inicio incorrectos";
        } else {
            $msg = "Ocurrió un error, usuario " . $responseLogin . " en sistema.";
        }

        echo json_encode(["success" => $success, "msg" => $msg], JSON_UNESCAPED_UNICODE);
    }
}
