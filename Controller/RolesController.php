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
        $page = $_POST["pageShow"];

        $response = $this->model->getAllRoles($valueSearch, $page);

        $dataTable = [
            "columns" => ["id", "Nombre", "Descripción"],
            "keys" => ["id", "nombre", "descripcion"],
            "data" => $response["data"],
            "actualPage" => $response["pageShow"],
            "numberPages" => $response["numberPagesShow"]
        ];

        getTableTemplate($dataTable);
    }
}
