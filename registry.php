<?php
    
    require_once "db_config.php";
    require_once "action.php";
    require_once "user.php";
    $s="y24oyRYW4252kRGa462y24B";
    if($s!=SECRET){
        header("location:register.php?p=4");
    }
    $user=new User($_POST["email"],substr($_POST["email"],0,strpos($_POST["email"],"@")),$_POST["phone"],$_POST["fname"],$_POST["lname"],getData(),$_POST["pword"]);
   
    if(!$user->validateEmail())
    {
        header("location:register.php?p=3");
    }
    else if($user->passwordLength())
    {
        header("location:register.php?p=8");
    }
    else{
    $username=$user->getUser();
    $sql="select * from user where user_name='$username'";
    $result=$conn->prepare($sql);
    $result->execute();
    if($result->rowCount()>0)
    {header("location:register.php?p=6");}
    
    $email=$user->getEmail();
    $password=$user->getPassword();
    $fname=$user->getFirstName();
    $lname=$user->getLastName();
    $phone=$user->getPhone();
    $token=$user->getToken();
    $sql="insert into `user`(email,user_name,password,first_name,last_name,phone_number,user_type,activated,token,expiration_date)  values('$email','$username','$password','$fname','$lname','$phone',1,0,'$token',now()+INTERVAL 1 DAY)";
    $result=$conn->prepare($sql);
    $result->execute();
    if(requestEmail($user->getUser(),$user->getEmail(),$user->getToken(),1))
        header("location:register.php?p=5");
    else{
        header("location:register.php?p=7"); 
    }
}
?>
