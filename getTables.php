<?php
require_once "db_config.php";
$seats=$_GET["a"];
$smoking=$_GET["b"];
$sql="select table_number from tables where num_of_seats='$seats' and smoking='$smoking'";
$result=$conn->prepare($sql);
$result->execute();
$result->setFetchMode(PDO::FETCH_NUM);

while($row=$result->fetch())
{
    echo "<option value=\"$row[0]\">$row[0]</option>";
}
?>