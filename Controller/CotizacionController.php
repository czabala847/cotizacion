<?php

class CotizacionController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function cotizacion()
    {
        $dataPage = [
            "titlePage" => "cotizacion",
            "titleMetaPage" => "Cotizacion"
        ];
        $this->view->loadView($this, "cotizacion", $dataPage);
    }

    public function crear()
    {
        $name = $_POST['nombre'];
        $identification = $_POST['cedula'];
        $email = $_POST['correo'];
        $subject = $_POST['asunto'];
        $file = $_FILES['archivo'];

        $result = $this->model->createQuotation($name, $identification, $email, $subject, $file);
        echo json_encode($result);
    }
}
