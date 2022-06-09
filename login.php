<?php
session_start();
require_once "db_config.php";
$user=$_POST["email"];
if(!isset($_POST["email"]) or !isset($_POST["password"])){
    header("location:sign.php?p=1");

}
else{

    $sql="select user_name,password,user_type from user where email='$user' and activated=1";
    $result=$conn->prepare($sql);
    $result->execute();
    $result->setFetchMode(PDO::FETCH_NUM);
    $row=$result->fetch();
    if($row>0)
    {
      
        $password=$_POST["password"];
        
        if(password_verify($password,$row[1]))
        {
            if(isset($_POST["log"])){
                    setcookie("data1",$row[0],time()+ 60*60*24);
                    setcookie("data2",$row[1],time()+ 60*60*24);
                    setcookie("data3",$row[2],time()+ 60*60*24);
                    setcookie("data4",$user,time()+ 60*60*24);

            }
            $_SESSION["user-name"]=$row[0];
            $_SESSION["email"]=$user;
            $_SESSION["password"]=$row[1];
            $_SESSION["user-type"]=$row[2];
            header("location:index.php");
        }
        else{
            header("location:sign.php?p=3");
        }
    }
    else{
        header("location:sign.php?p=2");
    }
}
?>