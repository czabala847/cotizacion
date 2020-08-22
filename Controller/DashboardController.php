<?php

class DashboardController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {

        $dataPage = [
            "titlePage" => "dashboard",
            "titleMetaPage" => "Dashboard",
            "urlPage" => "dashboard"
        ];
        $this->view->loadView($this, "dashboard", $dataPage);
    }
}
