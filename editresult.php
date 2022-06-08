<?php
require_once "db_config.php";
$reserve=$_POST["reserve"];
if($_POST["s"]=="update")
{
    
    $table=$_POST["number"];
    $date=$_POST["date"];
    $duration=$_POST["duration"];
    $sql="select * from reservation where table_number='$table' and reservation_code<>'$reserve' and (date between '$date' and DATE_ADD('$date',Interval '$duration' hour) or reservation_duration between '$date' and DATE_ADD('$date',interval '$duration' hour)) ";
    $res=$conn->prepare($sql);
    $res->execute();
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

?>