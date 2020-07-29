<?php

class NotFoundController extends Controller
{

    public function __construct()
    {
        parent::__construct();
    }

    public function notFound()
    {
        $this->view->loadView($this, "notfound");
    }
}

$objNotFound = new NotFoundController();
$objNotFound->notFound();
