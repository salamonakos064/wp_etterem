<?php
require_once "db_config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food orders</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="container">
        <div class="row">
    <a href="current.php" class="text-center button-custom col-12">Return to the website</a>
    <?php
    $reserve=$_GET["p"];
    $sql="select f.name,o.quantity from food f inner join orders o on f.id=o.food_id where o.res_id='$reserve'";
    $result=$conn->prepare($sql);
    try
    {
        $result->execute();
    }
    catch(Exception $e){
        header("location:current.php");
    }
    if($result->rowCount()>0)
    {
        $result->setFetchMode(PDO::FETCH_NUM);
        echo "<table class=\"table-design mt-3\">";
        echo "<tr><td>name</td><td>quantity</td></tr>";
        while($row=$result->fetch())
        {
            echo "<tr>";
            foreach($row as $rows)
            {
                echo "<td>$rows</td>";
            }
            echo "</tr>";
        }
        echo "</table>";
    }
    else {
        echo "<h1 class=\"text-center\">No entries found</h1>";
    }
    ?>
</div>
</div>
</body>
</html>