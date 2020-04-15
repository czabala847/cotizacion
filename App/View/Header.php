<?php

function htmlHeader($title)
{
  echo "<!DOCTYPE html>
<html lang=\"es\">

<head>
  <meta charset=\"UTF-8\" />
  <meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\" />
  <meta http-equiv=\"X-UA-Compatible\" content=\"ie=edge\" />
  <title>{$title}</title>
  <link rel=\"stylesheet\" href=\"./src/css/style.css\" />
  <link href=\"https://fonts.googleapis.com/css?family=Cabin&display=swap\" rel=\"stylesheet\" />
</head>

<body>
  <div id=\"app\">
    <header class=\"header\">
      <div class=\"container\">
        <nav class=\"header-menu\">
          <ul class=\"header-menu__list\">
            <li class=\"header-menu__list--item\">
              <a class=\"header-menu__list--link\" href=\"#\">Inicio</a>
            </li>
            <li class=\"header-menu__list--item\">
              <a class=\"header-menu__list--link\" href=\"#\">Administración</a>
            </li>
          </ul>
        </nav>
      </div>
    </header>";
}
