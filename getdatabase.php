<?php
require_once "db_config.php";

  if(!empty($_GET["user-name"]))
  {

    $sql="";
      if($_GET["user-type"]==1)
      {
        $user=$_GET["user-name"];
        $sql="select reservation_code,table_number,date,reservation_duration from reservation where user_name='$user' and activated= 1";
     
      }
      else
      {
        $sql="select reservation_code,user_name,table_number,date,reservation_duration from reservation where activated= 1";
       
      }
    $result=$conn->prepare($sql);
    $result->execute();
    $result->setFetchMode(PDO::FETCH_NUM);
    if($result->rowCount()>0)
    {
      echo "<h1 class=\"text-center\">Reservations</h1>"; 
      echo "<form method=\"post\" class=\"text-center\" action=\"editdatabase.php\">";
     
      echo "<table class=\"table-design table mt-3\">";
      echo "<tr>\n<td>Reservation code</td>\n";
      if($_GET["user-type"]!=1)
      {
        echo"<td>user_name</td>\n";
      }
      echo "<td>Table number</td>\n<td>date</td>\n <td>duration</td>\n";
      while($row=$result->fetch())
      {
          echo "<tr>";
          echo "<td><input type=\"radio\" name=\"reserve\" id=\"res-$row[0]\" value=\"$row[0]\"><label for=\"res-$row[0]\">$row[0]</label></td> <td>$row[1]</td> <td>$row[2]</td>  <td>$row[3]</td>";
          if($_GET["user-type"]!=1)
          {
            echo "<td>$row[4]</td>";
          }
          echo "</tr>";
      }
      echo "</table>";
      echo "<div class=\"container button-size\">";
      
      if($_GET["user-type"]==1)
      {
        echo "<div class=\"row\">";
        echo "<input type=\"submit\" name=\"s\" class=\"col-12 col-md-4 btn btn-primary\" value=\"discard\">";
        echo "<input type=\"submit\" name=\"s\" class=\"col-12 col-md-4 btn btn-primary\" value=\"delete\">";
        echo "<input type=\"submit\" name=\"s\" class=\"col-12 col-md-4 btn btn-primary\" value=\"edit\">";
        echo "</div>";
      }
      else{
          echo "<p><label for=\"note\">notes</label></p>";
          echo "<textarea name=\"notes\" id=\"note\"></textarea><br>";
          echo "<input type=\"submit\" name=\"s\" class=\"col-md-12 btn btn-primary\" value=\"book\">";
      }
      echo "</div>";
      echo "</form>";
      if($_GET["user-type"]==1)
{
  echo   "<div class=\"alert alert-warning\" role=\"alert\">Reservation can only be deleted and edited 4 hours ahead</div>";
}
    
    }
    else{
      echo "<h1 class=\"text-center\">No entries were found</h1>";
      if($_GET["user-type"]==1)
      {
        echo "<h1 class=\"text-center\">Go to Reserve now to reserve a table</h1>";
      }
    }
  }
  else{
    echo "<h1 class=\" col-12 d-flex  justify-content-center mt-5\">Log in to gain access to the features of this website</h1>";
    echo "<h1 class=\" col-12 d-flex  justify-content-center mt-5\">If you don't have an account? Press the Sign-up button! </h1>";
  }
  ?>