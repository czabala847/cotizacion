<?php

class Mysql
{
    private $strQuery;
    private $conexion;
    private $arrParams;

    public function __construct()
    {
        $this->conexion = new Conexion();
        $this->conexion = $this->conexion->getConnection();
    }

    public function select(string $strQuery, array $arrParams, bool $all = false)
    {
        $this->strQuery = $strQuery;
        $this->arrParams = $arrParams;

        $stmt = $this->conexion->prepare($strQuery);
        $stmt->execute($arrParams);

        if ($all) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        }

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insert(string $strQuery, array $arrParams)
    {
        $this->strQuery = $strQuery;
        $this->arrParams = $arrParams;
        $lastInsert = 0;

        $stmt = $this->conexion->prepare($strQuery);
        $response = $stmt->execute($arrParams);

        if ($response) {
            $lastInsert = $this->conexion->lastInsertId();
        }

        return $lastInsert;
    }

    public function update(string $strQuery, array $arrParams)
    {
        $this->strQuery = $strQuery;
        $this->arrParams = $arrParams;

        $stmt = $this->conexion->prepare($strQuery);
        $response = $stmt->execute($arrParams);

        return $response;
    }
}
