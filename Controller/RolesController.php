<?php
// sleep(3);
class RolesController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function roles()
    {
        $dataPage = [
            "titlePage" => "roles",
            "titleMetaPage" => "Roles",
            "urlPage" => "roles"

        ];
        $this->view->loadView($this, "roles", $dataPage);
    }

    //Mostrar tabla con todos los roles
    public function rolesTable()
    {
        $valueSearch = $_POST["value"];
        $page = intval($_POST["pageShow"]);

        $response = $this->model->getAllRoles($valueSearch, $page);

        $dataTable = [
            "columns" => ["id", "Nombre", "Descripción"],
            "keys" => ["id", "nombre", "descripcion"],
            "controller" => "roles",
            "data" => $response["data"],
            "actualPage" => $response["pageShow"],
            "numberPages" => $response["numberPagesShow"]
        ];

        getTableTemplate($dataTable);
    }

    public function setStatus(int $idRol)
    {
        $response = $this->model->setStatusRol($idRol);
        echo json_encode($response, JSON_UNESCAPED_UNICODE);
        die();
    }

    public function add()
    {
        $name = $_POST["nombre"];
        $description = $_POST["descripcion"];

        $success = false;
        $msg = "El nombre del rol ya existe.";

        $response = $this->model->insertRol($name, $description);

        if ($response === true) {
            $msg = "Rol creado exitosamente.";
            $success = true;
        } elseif ($response === false) {
            $msg = "Ocurrió un error al crear el rol.";
        }

        echo json_encode(["success" => $success, "msg" => $msg], JSON_UNESCAPED_UNICODE);
    }

    public function rol(int $id)
    {
        $id = intval($id);
        $rol = $this->model->getRol($id);
        echo json_encode(["rol" => [$rol["nombre"], $rol["descripcion"]]], JSON_UNESCAPED_UNICODE);
    }

    public function update()
    {
        $id = intval($_POST["id"]);
        $name = $_POST["nombre"];
        $description = $_POST["descripcion"];

        $response = $this->model->updateRol($id, $name, $description);
        $msg = $response ? "Rol actualizado correctamente" : "Ocurrió un error al actualizar el Rol.";

        echo json_encode(["success" => $response, "msg" => $msg], JSON_UNESCAPED_UNICODE);
    }
}
