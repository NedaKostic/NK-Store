<?php 
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");

$db = new Database();
if(!$db->connect()) exit("Connection failed");


if(isset($_POST['inputText']))
{

    $inputText = $_POST['inputText'];
    $inputText = filter_var($inputText, FILTER_SANITIZE_STRING);
    $inputText = htmlentities($inputText); 
    $sql = "SELECT * FROM product WHERE is_active = 1 AND (product_name LIKE '%{$inputText}%' OR product_color LIKE '%{$inputText}%' OR product_material LIKE '%{$inputText}%')";

    $result=$db->query($sql); 
    if($db->error())  echo $db->error();  
    
    echo "<ul>";

    if(($db->num_rows($result))>0)
    {

        while($row=$db->fetch_object($result))
         echo "<li><a href='singleproduct.php?id=".$row->product_id."'>" .$row->product_name. "</a></li>";
        
    } else echo "<li>No matching results</li>";

    echo "</ul>";
    } 

?>