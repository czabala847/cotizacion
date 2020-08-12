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
}
