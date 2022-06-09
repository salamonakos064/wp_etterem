<?php
require_once "db_config.php";
session_start();
if(empty($_SESSION["user-name"]))
{
    header("location:index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reservation data</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/form-validation.js"></script>
    <script src="js/script2.js"></script>
</head>
<body class="text-center">
    <h1 class="mt-5">Reservation data</h1>
    <form method="POST" action="editresult.php" class="margin-side">
        <label for="seats" class="mt-2">seats</label>
        <select id="seats" class="form-control" required >
    <?php
        $sql="select distinct num_of_seats from tables order by num_of_seats asc";
        $result=$conn->prepare($sql);
        $result->execute();
        $result->setFetchMode(PDO::FETCH_NUM);
        while($row=$result->fetch())
        {
            echo "<option value=\"$row[0]\">$row[0]</option>";
        }
    ?>
    </select>
<label for="smoke">smoke</label>
    <select id="smoke" class="form-control" required>
        <option value="0">no</option>
        <option value="1">yes</option>
    </select>
    <label for="number" class="mt-2">table number</label>
    <select id="number" name="number" class="form-control" required>
    </select>
    <label for="date" class="mt-2">Date</label>
    <input type="datetime-local" id="date" name="date" class="form-control " required>
   <label for="duration">Duration</label>
   <select name="duration" id="duration" class="form-control" required>
    </select>
    <input type="hidden" name="reserve" value= "<?php echo $_GET["p"]; ?>">
    <input type="submit" name="s" value="update" class="form-control btn btn-primary mt-3">
</form>
</body>
</html>