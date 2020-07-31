<?php

// retornar url para los assets

function getUrlBase()
{
    return URL_BASE;
}

function getUrlMedia()
{
    return URL_BASE . "Assets/";
}

//traer template de cabecera

function getHeaderTemplate($data = "")
{
    require_once "View/Templates/Header.php";
}
