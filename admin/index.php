<?php
session_start();
if($_SESSION["user-type"]!=3)
{
    header("location:../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <link rel="stylesheet" href="../css/bootstrap.min.css">
    <link rel="stylesheet" href="../css/style.css">
</head>
<body>
    <div class="margin-side">
    <h1>Administrator page</h1>
    <div class="container">
<div class="row">
    <a href="content.php?p=1" class="button-custom">Tables</a>
    <a href="content.php?p=2" class="button-custom">Reservations</a>
    <a href="content.php?p=3" class="button-custom">Users</a>
    <a href="content.php?p=4" class="button-custom">Menu</a>
</div>
    </div>
</body>
</html>