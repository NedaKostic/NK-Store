<?php
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");

$json['fail']="";
$json['data']="";

$db = new Database();
if(!$db->connect()) exit("Connection failed");


//show all available product's sizes and qty

if(isset($_POST['size_product_id']))
{
$size_product_id = $_POST['size_product_id'];
$sql="SELECT * FROM view_all_products WHERE product_id=".$size_product_id." AND quantity>0";  
    $result=$db->query($sql);

    if($db->error()) 
    {
        $json['fail']= "Error, please try again.";
        exit();
    }

    $json['data']=mysqli_fetch_all($result, MYSQLI_ASSOC); 
}

 echo JSON_encode($json, 256);
