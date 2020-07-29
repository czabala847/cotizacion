<?php

spl_autoload_register(function ($nameClass) {
    $file = "./Library/Core/" . $nameClass . ".php";

    if (file_exists($file)) {
        require_once $file;
    }
});
