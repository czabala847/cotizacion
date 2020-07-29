<?php

class LoginController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function login()
    {
        $this->view->loadView($this, "login");
    }
}
