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

    public function getRol(int $id)
    {
        $this->id = $id;
        $strQuery = "SELECT * FROM roles WHERE id = ?";
        return $this->db->select($strQuery, array($this->id));
    }

    //Mostrar roles dependiendo de la pagina
    public function getAllRoles(string $nameRol, int $pageShow = 0)
    {
        $limit = 5;
        $index = $pageShow * $limit;

        $this->name = "%$nameRol%";
        $arrParams = array($this->name);

        $strQueryCount = "SELECT COUNT(id) Cantidad FROM roles WHERE nombre LIKE ?";
        $resultCount = $this->db->select($strQueryCount, $arrParams);
        //Obtener cuantas páginas tiene la tabla roles
        $numberPagesShow = ceil(intval($resultCount["Cantidad"]) / $limit);

        $strQueryUsers = "SELECT id, nombre, descripcion, estado FROM roles WHERE nombre LIKE ? LIMIT $index, " . $limit;
        $arrRoles = $this->db->select($strQueryUsers, $arrParams, true, false);

        return ["data" => $arrRoles, "pageShow" => $pageShow, "numberPagesShow" => $numberPagesShow];
    }

    //Cambiar estado del usuario
    public function setStatusRol(int $id)
    {
        $this->id = $id;
        $rol = $this->getRol($this->id);
        $strUpdate = "UPDATE roles SET estado = ? WHERE id = ?";

        $messageModification = "activado";

        if ($rol) {
            if ($rol["estado"] == 'A') {
                $responseUpdate = $this->db->update($strUpdate, array("I", $this->id));
                $messageModification = 'desactivado';
            } else {
                $responseUpdate = $this->db->update($strUpdate, array("A", $this->id));
            }

            if ($responseUpdate) {
                return ["success" => true, "response" => "Rol " . $messageModification . " con exito"];
            } else {
                return ["success" => false, "response" => "Ocurrio error al modificar rol"];
            }
        } else {
            return ["success" => false, "response" => "Rol a modificar no existe"];;
        }
    }

    public function insertRol(string $name, string $description)
    {
        $this->name = $name;
        $this->description = $description;
        $status = "A";

        $strQuerySearch = "SELECT nombre FROM roles WHERE nombre = ?";
        $rol = $this->db->select($strQuerySearch, array($this->name));

        if (empty($rol)) {

            $strQueryInsert = "INSERT INTO roles(nombre, descripcion, estado) VALUES (?,?,?)";
            $arrParams = array($this->name, $this->description, $status);
            $responseInsert = $this->db->insert($strQueryInsert, $arrParams);

            if ($responseInsert > 0) {
                return true;
            } else {
                return false;
            }
        }

        return "existe";
    }
}
