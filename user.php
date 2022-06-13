<?php
class User{
    private $email;
    private $phone;
    private $user;
    private $password;
    private $fname;
    private $lname;
    private $token;
    function __construct($email,$user,$phone,$fname,$lname,$token,$password){
        $this->email=$email;
        $this->user=$user;
        $this->phone=$phone;
        $this->fname=$fname;
        $this->lname=$lname;
        $this->token=$token;
        $this->password=$password;
    }
    function getEmail()
    {
        return $this->email;
    }
    function getUser()
    {
        return $this->user;
    }
    function getFirstName()
    {
        return $this->fname;
    }
    function getLastName()
    {
        return $this->lname;
    }
    function getToken()
    {
        return $this->token;
    }
    function getPassword()
    {
        return password_hash($this->password,PASSWORD_DEFAULT);
    }
    function getPhone(){
        return $this->phone;
    }
    function validateEmail()
    {
        
        return filter_var($this->email,FILTER_VALIDATE_EMAIL);
    }
    function passwordLength()
    {
       
        if(strlen(trim($this->password))<8)
        {
            return true;
        }
        else
        {
            return false;
        }
    }
}
?>