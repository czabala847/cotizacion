<?php

//URL digitada
$url = isset($_GET["url"]) ? $_GET["url"] : "Login/login";

$arrURL = explode("/", $url);

//obtener controlador y poner primera letra en Mayus y la palabra controller al final
$controller = ucwords($arrURL[0]) . "Controller";

//Colocar la primera palabra en minuscula al metodo, 
//si el método no esta en la url, colocar el nombre del controlador
$method = isset($arrURL[1]) ? lcfirst($arrURL[1]) : lcfirst($arrURL[0]);
$params = "";

// Guardar parametros en una variable
for ($i = 2; $i < count($arrURL); $i++) {
    $params .= $arrURL[$i] . ",";
}

//Eliminar ultima coma(,) del string de parametros
$params = trim($params, ",");

require_once "./Library/Core/Autoload.php";
require_once "./Library/Core/Load.php";
