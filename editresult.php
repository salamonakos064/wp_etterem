<?php
require_once "db_config.php";
require_once "action.php";
if(empty($_POST["s"])||empty($_POST["reserve"]) || empty($_POST["number"]) ||empty($_POST["date"]) || empty($_POST["duration"]) )
{
    header("location:reserve.php?p=4");
}
$reserve=$_POST["reserve"];
$table=$_POST["number"];
$date=$_POST["date"];
$duration=$_POST["duration"];
$sql="select * from reservation where table_number='$table' and reservation_code<>'$reserve' and (date between '$date' and DATE_ADD('$date',Interval '$duration' hour) or reservation_duration between '$date' and DATE_ADD('$date',interval '$duration' hour)) ";
    $res=$conn->prepare($sql);
    $res->execute();
if($_POST["s"]=="update")
{
    if($res->rowCount()>0)
    {
        header("location:current.php?p=3");
    }
    else{
    $sql="update reservation set table_number='$table',date='$date',reservation_duration=DATE_ADD('$date',Interval '$duration' hour) where reservation_code='$reserve' and now()<=Date_sub(date,interval 4 hour) and date>'2020-01-01'";
    $res=$conn->prepare($sql);
    $res->execute();
    if($res->rowCount()>0){
        header("location:current.php?p=2");
    }
    else{
        header("location:current.php?p=3");
    }
    }
}
if($_POST["s"]=="reserve")
{
    if($res->rowCount()>0)
    {
        header("location:reserve.php?p=3");
    }
    else{
    
    $sql="insert into reservation(reservation_code,user_name,table_number,date,reservation_duration,activated,deleted_by_user) values (NULL,'$reserve','$table','$date',DATE_ADD('$date',Interval '$duration' hour),1,0)";
    $res=$conn->prepare($sql);
    $res->execute();
    $row=$conn->lastInsertId();
    if($res->rowCount()>0){
       
        requestEmail($reserve,$_POST["email"],$row,3);
        header("location:reserve.php?p=2");
       
    }
    else{
        header("location:reserve.php?p=3");
    }
    }
}

?>