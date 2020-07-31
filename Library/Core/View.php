<?php

class View
{

    public function loadView($controller, $nameView, $data = "")
    {

        $nameController = get_class($controller);
        $nameController = str_replace("Controller", "", $nameController);
        $fileView = "View/" . $nameController . "/" . $nameView . ".php";
        if (!isset($_SESSION["newsession"])) {
            if (file_exists($fileView)) {
                require_once $fileView;
            }
        }
    }
}
