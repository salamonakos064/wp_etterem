<?php
    
    require_once "db_config.php";
    require_once "action.php";
    $s="y24oyRYW4252kRGa462y24B";
    if($s!=SECRET){
        header("location:register.php?p=4");
    }
    $email=$_POST["email"];
    if(!filter_var($email,FILTER_VALIDATE_EMAIL))
    {
        header("location:register.php?p=3");
    }
   
    if($_POST["phone"]=="")
    {$phone=null;}
    else{
        $phone=$_POST["phone"];
    }
    $at=strpos($email,'@');
    $user=substr($email,0,$at);
    $sql="select * from user where user_name='$user'";
    $result=$conn->prepare($sql);
    $result->execute();
    if($result->rowCount()>0)
    {header("location:register.php?p=6");}
    $password=PASSWORD_HASH($_POST["pword"],PASSWORD_DEFAULT);
    $fname=$_POST["fname"];
    $lname=$_POST["lname"];  
    $token=getData();
    

    $sql="insert into `user`(email,user_name,password,first_name,last_name,phone_number,user_type,activated,token,expiration_date)  values('$email','$user','$password','$fname','$lname','$phone',1,0,'$token',now()+INTERVAL 1 DAY)";
    $result=$conn->prepare($sql);
    $result->execute();
    if(requestEmail($user,$email,$token,1))
    header("location:register.php?p=5");
    else{
        
    }
?>
