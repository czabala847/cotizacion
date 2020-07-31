<?php

class DashboardController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function dashboard()
    {

        $this->view->loadView($this, "dashboard");
    }
}
