<?php
session_start();
session_destroy();
setcookie("data1","",time()*0);
setcookie("data2","",time()*0);
setcookie("data3","",time()*0);
header("location:index.php");
?>