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

function getDashboardTemplate($dataPage = "")
{
    require_once "View/Templates/DashboardMain.php";
}

function getSideBarTemplate($dataPage = "")
{
    require_once "View/Templates/Sidebar.php";
}

function getFooterTemplate($dataPage = "")
{
    require_once "View/Templates/Footer.php";
}

function getHeadTemplate($dataPage = "")
{
    require_once "View/Templates/HeadMeta.php";
}
