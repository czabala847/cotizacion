<?php

class RolesModel
{
    private $id;
    private $name;
    private $description;
    private $db;

    public function __construct()
    {
        $this->db = new Mysql();
    }

    //Mostrar roles dependiendo de la pagina
    public function getAllRoles(string $nameRol, int $pageShow = 0)
    {
        $limit = 5;
        $index = $pageShow * $limit;

        $nameRol = "%$nameRol%";
        $arrParams = array($nameRol);

        $strQueryCount = "SELECT COUNT(id) Cantidad FROM roles WHERE nombre LIKE ?";
        $resultCount = $this->db->select($strQueryCount, $arrParams);
        //Obtener cuantas páginas tiene la tabla roles
        $numberPagesShow = ceil(intval($resultCount["Cantidad"]) / $limit);

        $strQueryUsers = "SELECT id, nombre, descripcion, estado FROM roles WHERE nombre LIKE ? LIMIT $index, " . $limit;
        $arrRoles = $this->db->select($strQueryUsers, $arrParams, true, false);

        return ["data" => $arrRoles, "pageShow" => $pageShow, "numberPagesShow" => $numberPagesShow];
    }
}
