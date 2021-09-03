<?php
session_start();
require_once("../class/classDatabase.php");

$db = new Database();
if(!$db->connect()) exit("Connection failed");


$showMessage['fail'] = "";
$showMessage['pass'] = "";



//inserting reviews into database

if(isset($_GET['review-button']))
{
        if(isset($_POST['review_product_id']) AND isset($_POST['review_name']) AND isset($_POST['review_textarea']))
        {
            $review_product_id=$_POST['review_product_id'];
            $review_name=$_POST['review_name'];
            $review_textarea=$_POST['review_textarea'];

            if($review_name!="" and $review_textarea!="")
            {
                $review_name=filter_var($review_name, FILTER_SANITIZE_STRING);
                $review_textarea=filter_var($review_textarea, FILTER_SANITIZE_STRING);
                $review_name = htmlentities($review_name, ENT_QUOTES, 'UTF-8'); 
                $review_textarea = htmlentities($review_textarea, ENT_QUOTES, 'UTF-8'); 

                    $sql="INSERT INTO review (product_id, review_name, review_text) VALUES ({$review_product_id}, '{$review_name}', '{$review_textarea}')";
                        $db->query($sql);
                        if($db->error()){
                          $showMessage['fail']="Failed to post review";  
                          exit();
                        } else $showMessage['pass']= "Successfuly sent review. Note: Review will be visible after the approval.";
                                  
            } else $showMessage['fail']= "*All fields are required!"; 
        }   
}


echo JSON_encode($showMessage, 256);
