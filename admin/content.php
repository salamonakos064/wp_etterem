<?php
require_once "../db_config.php";
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
    <title>Data</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/bootstrap.min.css">
</head>
<body>
    <?php
    $sql="";
    echo "<table class=\"table-design\">";
        if($_GET["p"]==1)
        {
            if(!empty($_GET["v"]) && !empty($_GET["value"])){
            if($_GET["v"]=="delete")
            {
                $value=$_GET["value"];
                $sql="delete from tables where table_number='$value'";
                $result=$conn->prepare($sql);
                $result->execute();
                
            }
        }
            $sql="select * from tables";
            echo "<tr><td></td><td>table_num</td>
            <td>number of seats</td><td>smoking</td></tr>";
        }
        else if($_GET["p"]==2)
        {
            
            $sql="select * from reservation ";
            if(!empty($_GET["date"]))
            {
                $date=$_GET["date"];
                $sql.="where date between '$date' and date_add('$date',Interval 1 day) ";   
            }
            $sql.="order by activated desc";
            echo "<tr><td></td><td>reservation_code</td>
            <td>user_name</td><td>table number</td>
            <td>date</td>
            <td>reservation duration</td>
            <td>notes</td>
            <td>activated</td>
            <td>deleted by user</td></tr>";
           
        }
        else if($_GET["p"]==3)
        {
            $sql="select * from user where user_type=2";
            echo "<tr><td></td><td>user name</td>
            <td>email</td><td>password</td><td>first name</td><td>last name</td><td>phone number</td><td>user type</td> <td>activated</td></tr>";
        }
        else if($_GET["p"]==5)
        {
            if(isset($_GET["date"])&&isset($_GET["value"]))
            {
                $value=$_GET["value"];
                $sql="update food set ";
                if (empty($_GET["date"]))
                {
                   $sql.="recommendation_date=Null";
                }
                else{
                    $date=$_GET["date"];
                    $sql.="recommendation_date='$date'";
                }
                $sql.=" where id='$value'";
                $result=$conn->prepare($sql);
                $result->execute();
                
            }
            if(!empty($_GET["v"]) && !empty($_GET["value"])){
            if($_GET["v"]=="delete")
            {
                $value=$_GET["value"];
                $sql="delete from food where id='$value'";
                $result=$conn->prepare($sql);
                $result->execute();
                
            }
        }
                if(isset($_GET["name"]))
                {
                    echo 'pp';
                    $ind = $_GET["id"];
                    $name=$_GET["name"];
                    $sql="insert into food (id, name) values ('$ind', '$name')";
                    $result=$conn->prepare($sql);
                    $result->execute();
                }
                
            $sql="select * from food";
            echo "<tr><td></td><td>food id</td>
            <td>food name</td><td>food date</td></tr>";
        }
        else{
            header("location:index.php");
        }
        echo "<form method=\"get\" action=\"content.php\">";
        
        $result=$conn->prepare($sql);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_NUM);
        while($row=$result->fetch())
        {
            echo "<tr>";
            echo "<td><input type=\"radio\" name=\"value\" value=\"$row[0]\">";
            echo "</td>";
            foreach($row as $rows)
            {
                if($rows =='')
                {
                    $rows = 'NULL';
                }
                echo "<td>$rows</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        if($_GET["p"]==1)
        {
            echo "<div class=\"row\">";
           
            echo "<input type=\"hidden\" name=\"p\" value=\"1\">";
            echo "<input type=\"submit\" name=\"v\" value=\"edit\" class=\"button-size col-4\">";
            echo "<input type=\"submit\" name=\"v\" value=\"delete\" class=\"button-size col-4\">";
            echo "<input type=\"submit\" name=\"v\" value=\"insert\" class=\"button-size col-4\">";
            echo "</div>";
            echo "</form>";
        }
        if($_GET["p"]==2)
        {
            echo "<div class=\"row\">";
            echo "<input type=\"date\" name=\"date\" class=\"button-size col-6\">";
            echo "<input type=\"hidden\" name=\"p\" value=\"2\">";
            echo "<input type=\"submit\" class=\"button-size col-6\">";
            echo "</div>";
            
        }
        if($_GET["p"]==5)
        {
            echo "<div class=\"row\">";
           
            echo "<input type=\"hidden\" name=\"p\" value=\"5\">";
            echo "<input type=\"submit\" name=\"v\" value=\"edit\" class=\"button-size col-4\">";
            echo "<input type=\"submit\" name=\"v\" value=\"delete\" class=\"button-size col-4\">";
            echo "<input type=\"submit\" name=\"v\" value=\"insert\" class=\"button-size col-4\">";



            if(!empty($_GET["v"]) ){
                if($_GET["v"]=="edit")
                {
                    echo "<form method=\"get\" action=\"content.php\">";
                    echo "<input type=\"date\" id=\"date\" name=\"date\" class=\"form-control needs-validation\">";
                    echo "<input type=\"submit\" name=\"i\" class=\"button-size col-4\">";
                    echo "</form>";
                }
            }

            if(!empty($_GET["v"]) ){
                if($_GET["v"]=="insert")
                {
                    echo "<form method=\"get\" action=\"content.php\">";
                    echo "<input type=\"hidden\" name=\"p\" value=\"5\">";
                    echo "<input type=\"hidden\" name=\"v\" value=\"insert\">";
                    echo "<input type=\"number\" id=\"id\" name=\"id\" class=\"form-control needs-validation\">";
                    echo "<input type=\"text\" id=\"name\" name=\"name\" class=\"form-control needs-validation\">";
                    echo "<input type=\"submit\" name=\"i\" class=\"button-size col-4\">";
                    echo "</form>";
                }



            echo "</div>";
            echo "</form>";
        }
            
        }
        echo "</form>";
    ?>
</body>
</html>