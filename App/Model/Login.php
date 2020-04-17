<?php

session_start();

$user = $_POST["usuario"];
$password = $_POST["contraseña"];


echo json_encode(["usuario" => $user, "password" => $password]);
