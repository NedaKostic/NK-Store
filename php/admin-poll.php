<?php 
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");


$db = new Database();

if(!$db->connect()) exit("Connection failed");

if(isset($_GET['b-poll']))
{
                 
      $sql = "SELECT * FROM user WHERE is_voted=1"; 
      $result=$db->query($sql); 
      $res=$db->num_rows($result);
      if($db->error()) exit();
      
      if($res>0){
      echo "<p>Total number of votes: {$res} </p>";   

          $sql1 = "SELECT * FROM user WHERE voted_result = 1"; 
            $result1=$db->query($sql1); 
            $res1=$db->num_rows($result1);
          echo "<p>Extremely Unsatisfied: {$res1} </p>";
          
          $sql2 = "SELECT * FROM user WHERE voted_result = 2"; 
          $result2=$db->query($sql2); 
          $res2=$db->num_rows($result2);
          echo "<p>Unsatisfied: {$res2}</p>";

          $sql3 = "SELECT * FROM user WHERE voted_result = 3"; 
          $result3=$db->query($sql3); 
          $res3=$db->num_rows($result3);
          echo "<p>Extremely Neutral: {$res3}</p>";

          $sql4 = "SELECT * FROM user WHERE voted_result = 4"; 
          $result4=$db->query($sql4); 
          $res4=$db->num_rows($result4);
          echo "<p>Satisfied: {$res4}</p>";

          $sql5 = "SELECT * FROM user WHERE voted_result = 5"; 
          $result5=$db->query($sql5); 
          $res5=$db->num_rows($result5);
          echo "<p>Extremely Satisfied: {$res5}</p>";


    } else echo "No votes for this poll";
}

?>