<?php
require_once("../Model/User.php");

$user = new User();

if (isset($_POST["modify"])) {
  $result = $user->changeStatus($_GET["id"]);

  echo json_encode($result);
}
