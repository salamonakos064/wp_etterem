<?php
require_once "db_config.php";
$reserve="";
if(empty($_POST["reserve"]))
{
    header("location:current.php?p=1");   
}
else
{
$reserve=$_POST["reserve"];

if($_POST["s"]=="delete")
{
    
    $sql="update reservation set activated=0,deleted_by_user=1 where reservation_code='$reserve' and now()<=Date_sub(date,interval 4 hour)";
   
}
else if($_POST["s"]=="book")
{
    $notes=$_POST["notes"];
    
    $notes=str_replace("'","\'",$notes);
    echo $notes;
    $sql="update reservation set activated=0,notes='$notes' where reservation_code='$reserve'";
}

else if($_POST["s"]=="edit")
{
   header("location:edit.php?p=$reserve");
 
}
$result=$conn->prepare($sql);
$result->execute();

if($result->rowCount()>0){
    header("location:current.php?p=2");
}
else{
    header("location:current.php?p=3");
}
}
?>