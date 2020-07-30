<?php

class Conexion
{

    private $connection;

    public function __construct()
    {
        try {
            $strConnection = "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";" . DB_CHARSET;
            $this->connection = new PDO($strConnection, DB_USER, DB_PASS);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            print "¡Error!: " . $e->getMessage() . "<br/>";
            die();
        }
    }

    public function getConnection()
    {
        return $this->connection;
    }
}
