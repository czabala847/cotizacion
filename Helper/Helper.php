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

function getTemplateDashboard($dataPage = "")
{
    require_once "View/Templates/TemplateDashboard.php";
}

function getSideBarTemplate($dataPage = "")
{
    require_once "View/Templates/Sidebar.php";
}

function getFooterTemplate($dataPage = "")
{
    require_once "View/Templates/Footer.php";
}

function getHeaderTemplate($dataPage = "")
{
    require_once "View/Templates/Header.php";
}
