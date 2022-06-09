
<?php
require_once "db_config.php";
function getData(){
    $token="";
    $a=97;
    $b=$a+25;
    for($i=0;$i<28;$i++)
    {
        if($i%2==0)
        {
            $token=$token.strtoupper(chr(mt_rand($a,$b)));
        }
        else{
            $token=$token.strtolower(chr(mt_rand($a,$b)));
        }

    }
    return $token;
}
function requestEmail($user,$email,$token,$num){

    $to=$email;
    $header = "From: ADMIN <Admin@example.com>\n";
    $header .= "X-Sender: Admin@example.com\n";
    $header .= "X-Mailer: PHP/" . phpversion();
    $header .= "X-Priority: 1\n";
    $header .= "Reply-To:support@example.com\r\n";
    $header .= "Content-Type: text/html; charset=UTF-8\n";
    
    if($num!=3){$subject="Activate your account";}
    else{$subject="Your place has been reserved";}
    if($num==1){
    $content="Greetings " . $user." please activate your account to use our website\n";
    $content.= SITE."/token.php?p=".$token;
    }
    else if($num==2){
    $content="Greetings " . $user." please reset your password to use our website\n";
    $content.= SITE."/password.php?token=".$token;
    }
    else{
        $content="Greetings ".$user." your reserevation code is: ".$token;
    }
    return mail($to,$subject,$content,$header);
}

function headerSite(){
    if(!empty($_COOKIE["data1"]) and !empty($_COOKIE["data2"]) and !empty($_COOKIE["data3"]) and !empty($_COOKIE["data4"]))
    {
        $_SESSION["user-name"]=$_COOKIE["data1"];
        $_SESSION["password"]=$_COOKIE["data2"];
        $_SESSION["user-type"]=$_COOKIE["data3"];
        $_SESSION["email"]=$_COOKIE["data4"];
    }
        echo "<li> <a href=\"menus.php\" class=\"nav-link px-2 link-dark\">Take a look at the menu</a></li>";  
    if(isset($_SESSION["user-name"]) and !empty($_SESSION["user-name"]) )
{
    if($_SESSION["user-type"]==3)
    {
        echo "<li><a href=\"admin/index.php\" class=\"nav-link px-2 link-dark\">Admin Page</a></li>";
        
    } 
    echo "</ul>";
	 echo "<div class=\"dropdown text-end\">";
     echo "<a href=\"#\" class=\"d-block link-dark text-decoration-none dropdown-toggle\" id=\"dropdownUser1\" data-bs-toggle=\"dropdown\" aria-expanded=\"false\">";
    echo "<img src=\"img/user.png\" alt=\"img\" width=\"32\" height=\"32\" class=\"rounded-circle\">";
     echo "</a>";
     echo "<ul class=\"dropdown-menu text-small\" aria-labelledby=\"dropdownUser1\">";
     echo "<li><a class=\"dropdown-item\" href=\"reserve.php\">Reserve now!</a></li>";
      echo  "<li><a class=\"dropdown-item\" href=\"current.php\">Reservations</a></li>";
       echo "<li><a class=\"dropdown-item\" href=\"settings.php\">Settings</a></li>";
       echo "<li><hr class=\"dropdown-divider\"></li>";
        echo "<li><a class=\"dropdown-item\" href=\"logout.php\">Sign out</a></li>";
     echo "</ul>";
   echo "</div>";
}
else{
    echo "</ul>";
echo "<div class=\"col-md-3 text-end\">";
echo "<a href=\"sign.php\"> <button type=\"button\" class=\"btn btn-outline-primary me-2\">Login</button></a>";
 echo "<a href=\"register.php\"><button type=\"button\" class=\"btn btn-primary\">Sign-up</button></a>";
echo "</div>";}
}

?>