<?php
session_start();

if (!isset($_SESSION["newsession"])) {
  header("Location: ../../index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Administración de usuarios</title>
</head>

<body>

</body>

</html>