<?php

class Controller
{

    protected $model;
    protected $view;

    public function __construct()
    {
        $this->loadModel();
        $this->view = new View();
    }

    //Cargar el modelo
    public function loadModel()
    {
        $controller = get_class($this);
        //Quitar la palabra controller, del nombre del controlador
        $controller = str_replace("Controller", "", $controller);
        $nameModel = $controller . "Model";
        $fileModel = "Model/" . $nameModel . ".php";

        if (file_exists($fileModel)) {
            require_once $fileModel;
            $this->model = new $nameModel();
        }
    }
}
