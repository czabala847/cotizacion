<?php

class View
{

    public function loadView($controller, $nameView, $data = "")
    {

        $fileView = "View/" . $nameView . ".php";
        $nameController = get_class($controller);
        $nameController = str_replace("Controller", "", $nameController);

        if ($nameController !== "Login") {
            $fileView = "View/" . $nameController . "/" . $nameView . ".php";
        }

        if (file_exists($fileView)) {
            require_once $fileView;
        }
    }
}
