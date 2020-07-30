<?php

class UserModel
{
    private $id;
    private $identification;
    private $name;
    private $email;
    private $password;
    private $status;
    private $rol;
    private $db;

    public function __construct()
    {
        $this->db = new Mysql();
    }

    //Guardar en variables datos del usuario
    private function saveDataUser(string $name, string $email, string $password)
    {

        $this->setName($name);
        $this->setEmail($email);
        $this->setPassword(password_hash($password, PASSWORD_DEFAULT));

        //Valores por defecto, estado activo y rol 2 (estandar)
        $this->setStatus("A");
        $this->setRol(2);
    }

    //Buscar usuario por id o por cedula
    private function searchUser(string $value, bool $searchIdentification = false)
    {

        $searchColum = "id";

        if ($searchIdentification) {
            $searchColum = "cedula";
        }

        $strQuerySearch = "SELECT * FROM usuarios WHERE $searchColum = ?";
        $userFound = $this->db->select($strQuerySearch, array($value));

        return $userFound;
    }

    public function loginUser(string $identification, string $pass)
    {
        $this->setIdentification($identification);
        $this->setPassword($pass);

        $user = $this->searchUser($this->getIdentification(), true);

        if (empty($user)) {
            return "no existe";
        } else if (password_verify($this->getPassword(), $user["contrasena"])) {
            if ($user["estado"] === 'A') {
                return true;
            } else {
                return "inactivo";
            }
        } else {
            return false;
        }
    }

    //Registro
    public function insertUser($identification, $name, $email, $password)
    {
        $newUser = $this->searchUser($identification, true);

        if (empty($newUser)) {
            //Guardar datos
            $this->saveDataUser($name, $email, $password);
            $this->setIdentification($identification);

            $strQueryInsert = "INSERT INTO usuarios(cedula, nombre, correo, contrasena, estado, rol) VALUES (?, ?, ?, ?, ?, ?)";
            $response = $this->db->insert($strQueryInsert, array($this->getIdentification(), $this->getName(), $this->getEmail(), $this->getPassword(), $this->getStatus(), $this->getRol()));

            if ($response > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            return "existe";
        }
    }

    /** GETTERS Y SETTERS */

    public function getId()
    {
        return $this->id;
    }

    public function getIdentification()
    {
        return $this->identification;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function getStatus()
    {
        return $this->status;
    }

    public function getRol()
    {
        return $this->rol;
    }

    public function setId(int $id)
    {
        $this->id = $id;
    }

    public function setIdentification(string $identification)
    {
        $this->identification = $identification;
    }

    public function setName(string $name)
    {
        $this->name = $name;
    }

    public function setEmail(string $email)
    {
        $this->email = $email;
    }

    public function setPassword(string $password)
    {
        $this->password = $password;
    }

    public function setStatus(int $status)
    {
        $this->status = $status;
    }

    public function setRol(int $rol)
    {
        $this->rol = $rol;
    }
}
