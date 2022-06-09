<?php
require_once "../db_config.php";
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
            $sql="select * from tables";
            echo "<tr><td></td><td>table_num</td>
            <td>number of seats</td><td>smoking</td></tr>";
        }
        else if($_GET["p"]==2)
        {
            $sql="select * from reservation order by activated desc";
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
        else{
            header("location:index.php");
        }

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
                echo "<td>$rows</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
        if($_GET["p"]==2)
        {
            echo "<div class=\"row\">";
            echo "<input type=\"date\" class=\"button-size col-6\">";
            echo "<input type=\"submit\" class=\"button-size col-6\">";
            echo "</div>";
        }
    ?>
</body>
</html>