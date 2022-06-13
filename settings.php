<?php
session_start();    
require_once "db_config.php";
if(!isset($_SESSION["user-name"]))
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
    <title>Settings</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/checkData.js"></script>
</head>
<body class="text-center">
    <h1 class="mt-5">User Data</h1>
    <form method="POST" action="settings.php" id="form" class="margin-side">
        <label for="password" class="mt-2">Password</label>
    <input type="password" id="password" name="password" id="pword" class="form-control">
    <label for="name" class="mt-2">First Name</label>
    <input type="text" id="name" name="name" class="form-control ">
    <label for="lname" class="mt-2">Last Name</label>
    <input type="text" id="lname" name="lname" class="form-control ">
    <label for="phone" class="mt-2">Phone</label>
    <input type="text" id="phone" name="phone" class="form-control ">
    <button type="submit" class="form-control btn btn-primary mt-3">Update user data</button>

    <?php
if(!empty($_POST["password"]) || !empty($_POST["name"]) || !empty($_POST["lname"]) || !empty($_POST["phone"]))
{
    $a="";
    $sql="update user set ";
    if(!empty($_POST["password"]) && strlen($_POST["password"])>=8)
    {
        $password=password_hash($_POST["password"],PASSWORD_DEFAULT);
        $sql.="password='$password'";
        $a=1;
    }
    if(!empty($_POST["name"]))
    {
        if($a==1)
        {
            $sql.=",";
            
        }
        $name=$_POST["name"];
        $sql.="first_name='$name'";
        $a=1;
    }
    if(!empty($_POST["lname"]))
    {
        if($a==1)
        {
            $sql.=",";
            
        }
        $lname=$_POST["lname"];
        $sql.="last_name='$lname'";
        $a=1;
    }
    if(!empty($_POST["phone"]))
    {
        if($a==1)
        {
            $sql.=",";
            
        }
        $phone=$_POST["phone"];
        $sql.="phone_number='$phone'";
        $a=1;
    }
    if($a==1)
    {
    $user=$_SESSION["user-name"];
    $sql.=" where user_name = '$user'" ;
    $result=$conn->prepare($sql);
    $result->execute();
    if($result->rowCount()>0){
        echo "<div class=\"alert alert-success\" role=\"alert\">User data successfully updated</div>"; 
    }
    else{ echo "<div class=\"alert alert-danger\" role=\"alert\">Could not update user data</div>"; }
    }
    else 
    {
        echo "<div class=\"alert alert-danger\" role=\"alert\">Could not update user data</div>";
    }
}

?>
</form>

</body>
</html>