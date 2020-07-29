<?php

$fileController = "Controller/" . $controller . ".php";

if (file_exists($fileController)) {
    require_once $fileController;

    $objController = new $controller();
    //Metodo existe, (clase, metodo)
    if (method_exists($controller, $method)) {
        $objController->{$method}($params);
    } else {
        require_once "./Controller/NotFoundController.php";
    }
} else {
    require_once "./Controller/NotFoundController.php";
}
