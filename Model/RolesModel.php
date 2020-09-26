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

    public function getAllRoles()
    {
        $strQuerySelect = "SELECT id, nombre, descripcion FROM roles WHERE estado = ?";
        $arrRoles = $this->db->select($strQuerySelect, array("A"), true);

        return $arrRoles;
    }

    //Mostrar roles dependiendo de la pagina
    public function getTableRoles(string $nameRol, int $pageShow = 0)
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

        //Verificar si el rol esta asignado a un usuario.
        $strQuerySearch = "SELECT id FROM usuarios WHERE rol = ? AND estado = ?";
        $user = $this->db->select($strQuerySearch, array($this->id, 'A'));

        if (empty($user)) {
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

        return ["success" => false, "response" => "No se puede desactivar el rol si hay usuarios con este perfil"];;
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

    public function updateRol(int $id, string $name, string $description)
    {
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;

        $strQueryUpdate = "UPDATE roles SET nombre = ?, descripcion = ? WHERE id = ?";
        $arrParams = array($this->name, $this->description, $this->id);

        $responseUpdate = $this->db->update($strQueryUpdate, $arrParams);

        return $responseUpdate;
    }
}
