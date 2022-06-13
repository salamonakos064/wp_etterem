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
    <a href="index.php" class="button-custom ">return to home page</a>    
    <?php
    $sql="";
    echo "<table class=\"table-design\">";
        if($_GET["p"]==1)
        {   
            echo "<h1 class=\"text-center\">Tables</h1>";
            if(!empty($_GET["v"]) && !empty($_GET["value"])){
            if($_GET["v"]=="delete")
            {
                $value=$_GET["value"];
                $sql="delete from tables where table_number='$value'";
                $result=$conn->prepare($sql);
                try{
                    $result->execute();
                    header("location:content.php?p=1");
                }
                catch(Exception $e)
                {
                    header("location:index.php?p=1");
                }
          
                
            }
           
        }
        if(!empty($_GET["b"]))
        {
        if($_GET["b"]=="insert" && $_GET["smoke"]>=0 && $_GET["smoke"]<2 && !empty($_GET["value"]) && !empty($_GET["seat"]))
        {
            
            $table=$_GET["value"];
            $seat=$_GET["seat"];
            $smoke=$_GET["smoke"];
            $sql="insert into tables values('$table','$seat','$smoke')";
            $result=$conn->prepare($sql);
            try{
                $result->execute();
                header("location:content.php?p=1");
            }
            catch(Exception $e)
            {
                header("location:index.php?p=1");
            }
           
        }
        if($_GET["b"]=="edit" && !empty($_GET["seat"]) && isset($_GET["smoke"] ) && $_GET["smoke"]>=0 && $_GET["smoke"]<2)
        {
            
            $table=$_GET["value"];
            $seat=$_GET["seat"];
            $smoke=$_GET["smoke"];
            $sql="update tables set num_of_seats='$seat',smoking='$smoke' where table_number='$table'";
            $result=$conn->prepare($sql);
            try{
                $result->execute();
                header("location:content.php?p=1");
            }
            catch(Exception $e)
            {
                header("location:index.php?p=1");
            }
           
        }
    }
            $sql="select * from tables";
            echo "<tr><td></td><td>table_num</td>
            <td>number of seats</td><td>smoking</td></tr>";
        }
        else if($_GET["p"]==2)
        {
            echo "<h1 class=\"text-center\">Reservations</h1>";
            $sql="select * from reservation ";
            if(!empty($_GET["date"]) && isset($_GET["by-date"]))
            {
                $date=$_GET["date"];
                $sql.="where date between '$date' and date_add('$date',Interval 1 day) ";   
               
            }
            else if(isset($_GET["json"]) && !empty($_GET["value"]))
            {
                $value=$_GET["value"];
                $sql="select * from reservation where reservation_code='$value'";
                $result=$conn->prepare($sql);
                $result->execute();
                $result->setFetchMode(PDO::FETCH_NUM);
                $row=$result->fetchObject();
                $rows=json_encode($row);
                var_dump($rows);
                header('location:json.php?row='.$rows);
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
            echo "<h1 class=\"text-center\">Employees</h1>";
            if(!empty($_GET["v"]))
            {
                if($_GET["v"]=="delete" && !empty($_GET["value"]))
                {
                    $value=$_GET["value"];
                    $sql="delete from user where user_name='$value'";
                    $result=$conn->prepare($sql);
                    try{
                        $result->execute();
                        header("location:content.php?p=3");
                    }
                    catch(Exception $e)
                    {
                        header("location:index.php?p=1");
                    }   
                }
               
            }
            if(!empty($_GET["b"])){
            if($_GET["b"]=="edit" && !empty($_GET["value"]) && !empty($_GET["first_name"]) && !empty($_GET["last_name"]) && !empty($_GET["password"])&& strlen($_GET["password"])>=8)
            {
                $value=$_GET["value"];
                $fname=$_GET["first_name"];
                $lname=$_GET["last_name"];
                $password=password_hash($_GET["password"],PASSWORD_DEFAULT);
             
                   $sql="update user set first_name='$fname',last_name='$lname',password='$password' ";
                   if(!empty($_GET["phone"]))
                   {
                       $phone=$_GET["phone"];
                       $sql.=",phone_number='$phone' ";
                   }
                   $sql.="where user_name='$value'";
                   $result=$conn->prepare($sql);
                   try{
                       $result->execute();
                       header("location:content.php?p=3");
                   }
                   catch(Exception $e)
                    {
                        header("location:index.php?p=1");
                    }   
            }
            if($_GET["b"]=="insert" && !empty($_GET["email"]) && !empty($_GET["first_name"]) && !empty($_GET["last_name"]) && !empty($_GET["password"]) && strlen($_GET["password"])>=8)
            {
                $bool=filter_var($_GET["email"],FILTER_VALIDATE_EMAIL);
                if(!($bool))
                {
                    header("location:content.php?p=3");
                }
                else{
                $email=$_GET["email"];
                $value=substr($email,0,strpos($email,"@"));
                $fname=$_GET["first_name"];
                $lname=$_GET["last_name"];
                $password=password_hash($_GET["password"],PASSWORD_DEFAULT);
             
                   
                   if(!empty($_GET["phone"]))
                   {
                       $phone=$_GET["phone"];
                       $sql="insert into user(user_name,email,first_name,last_name,password,phone_number,user_type,activated) values 
                       ('$value','$email','$fname','$lname','$password','$phone',2,1)";
                   }
                   else{
                    $sql="insert into user(user_name,email,first_name,last_name,password,user_type,activated) values 
                    ('$value','$email','$fname','$lname','$password',2,1)";

                   }
                 
                   $result=$conn->prepare($sql);
                   try{
                       $result->execute();
                       header("location:content.php?p=3");
                   }
                   catch(Exception $e)
                    {
                    header("location:index.php?p=1");
                    }   
            }}
        }
            
            $sql="select user_name,email,first_name,last_name,phone_number,user_type,activated from user where user_type=2";
            echo "<tr><td></td><td>user name</td>
            <td>email</td><td>first name</td><td>last name</td><td>phone number</td><td>user type</td> <td>activated</td></tr>";
        }
        else if($_GET["p"]==5)
        {
            echo "<h1 class=\"text-center\">Food</h1>";
            if(isset($_GET["date"]) && isset($_GET["value"]))
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
                try{
                $result->execute();
                header("location:content.php?p=5");
                }
                catch(Exception $e){
                    header("location:index.php?p=1");
                }
            }
            if(!empty($_GET["v"]) && !empty($_GET["value"])){
            if($_GET["v"]=="delete")
            {
                $value=$_GET["value"];
                $sql="delete from food where id='$value'";
                $result=$conn->prepare($sql);
                try{
                $result->execute();
                header("location:content.php?p=5");
                }
                catch(Exception $e)
                {
                    header("location:index.php?p=1");
                }
            }
        }
                if(!empty($_GET["name"]))
                {
                    
                    $ind = $_GET["id"];
                    $name=$_GET["name"];
                    $sql="insert into food (id, name) values ('$ind', '$name')";
                    $result=$conn->prepare($sql);
                    try{
                    $result->execute();
                    header("location:content.php?p=5");
                    }
                    catch(Exception $e)
                    {
                        header("location:index.php?p=1");
                    }
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
        try{
        $result->execute();
        }
        catch(Exception $e)
        {
            header("location:index.php?p=1");
        }
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
          
            if(!empty($_GET["v"]) ){
                if($_GET["v"]=="edit")
                {
                    echo "<form method=\"get\" action=\"content.php\">";
                    echo "<input type=\"text\" id=\"name\" name=\"seat\" placeholder=\"num of seats\" class=\"button-size col-6 needs-validation\">";
                    echo "<label for=\"smoke\" class=\"col-2\">smoke</label>";
                    echo "<select name=\"smoke\" id=\"smoke\"class=\"button-size col-4 needs-validation\">";
                    echo "<option value=\"0\">no</option>";
                    echo "<option value=\"1\">yes</option>";
                    echo "</select>";
                    echo "<input type=\"hidden\" name=\"b\" value=\"edit\">";
                    echo "<input type=\"submit\" name=\"i\" class=\"button-size col-4\">";
                    echo "</form>";
                }
            }

            if(!empty($_GET["v"]) ){
                if($_GET["v"]=="insert")
                {
                    echo "<form method=\"get\" action=\"content.php\">";
                    echo "<input type=\"number\" id=\"name\" name=\"value\" placeholder=\"table num\" class=\"button-size col-3 needs-validation\">";
                    echo "<input type=\"text\" id=\"name\" name=\"seat\" placeholder=\"num of seats\" class=\"button-size col-3 needs-validation\">";
                    echo "<label for=\"smoke\" class=\"col-2\">smoke</label>";
                    echo "<select name=\"smoke\"  id=\"smoke\" class=\"button-size col-4 needs-validation\">";
                    echo "<option value=\"0\">no</option>";
                    echo "<option value=\"1\">yes</option>";
                    echo "</select>";
                    echo "<input type=\"hidden\" name=\"b\" value=\"insert\">";
                    echo "<input type=\"submit\" name=\"i\" class=\"button-size col-4\">";
                    echo "</form>";
                }



            echo "</div>";
            echo "</form>";
        }
        }
        if($_GET["p"]==2)
        {
            echo "<div class=\"row\">";
            echo "<input type=\"date\" name=\"date\" class=\"button-size col-6\">";
            echo "<input type=\"hidden\" name=\"p\" value=\"2\">";
            echo "<input type=\"submit\" name=\"by-date\" class=\"button-size col-6\">";
            echo "<input type=\"submit\" name=\"json\" class=\"button-size col-12\" value=\"getJson\" >";
            echo "</div>";
            
            
        }
        if($_GET["p"]==3)
        {
            echo "<div class=\"row\">";
           
            echo "<input type=\"hidden\" name=\"p\" value=\"3\">";
            echo "<input type=\"submit\" name=\"v\" value=\"edit\" class=\"button-size col-4\">";
            echo "<input type=\"submit\" name=\"v\" value=\"delete\" class=\"button-size col-4\">";
            echo "<input type=\"submit\" name=\"v\" value=\"insert\" class=\"button-size col-4\">";
            if(!empty($_GET["v"]))
            {
                if($_GET["v"]=="insert")
                {
                    echo "<input type=\"hidden\" name=\"p\" value=\"3\">";
                    echo "<input type=\"hidden\" name=\"b\" value=\"insert\">";
                    echo "<input type=\"text\" name=\"email\" placeholder=\"email\" class=\"button-size col-4  needs-validation\">";
                    echo "<input type=\"text\" name=\"first_name\" placeholder=\"first_name\" class=\"button-size col-4  needs-validation\">";
                    echo "<input type=\"text\" name=\"last_name\" placeholder=\"last_name\" class=\"button-size col-4 needs-validation\">";
                    echo "<input type=\"password\" name=\"password\" placeholder=\"password\" class=\"button-size col-6  needs-validation\">";
                    echo "<input type=\"text\" name=\"phone\" placeholder=\"phone\" class=\"button-size col-6 needs-validation\">";
                    
                    echo "<input type=\"submit\" name=\"i\" class=\"button-size col-12\">";
                    
                }
                if($_GET["v"]=="edit")
                {
                    echo "<input type=\"hidden\" name=\"p\" value=\"3\">";
                    echo "<input type=\"hidden\" name=\"b\" value=\"edit\">";
                    echo "<input type=\"text\" name=\"first_name\" placeholder=\"first_name\" class=\"button-size col-6  needs-validation\">";
                    echo "<input type=\"text\" name=\"last_name\" placeholder=\"last_name\" class=\"button-size col-6 needs-validation\">";
                    echo "<input type=\"password\" name=\"password\" placeholder=\"password\" class=\"button-size col-6  needs-validation\">";
                    echo "<input type=\"text\" name=\"phone\" placeholder=\"phone\" class=\"button-size col-6 needs-validation\">";
                    
                    echo "<input type=\"submit\" name=\"i\" class=\"button-size col-12\">";
                }
            }


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
                    echo "<input type=\"number\" id=\"id\" name=\"id\" placeholder=\"id\" class=\"form-control needs-validation\">";
                    echo "<input type=\"text\" id=\"name\" name=\"name\" placeholder=\"name\" class=\"form-control needs-validation\">";
                    
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