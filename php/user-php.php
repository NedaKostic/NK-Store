<?php
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");

$json['fail']="";
$json['pass']="";

$db = new Database();
if(!$db->connect()) exit("Connection failed");



//CHANGE ADDRESS
if(isset($_GET['changeAddress']))
{
    if(isset($_POST['deliveryAddress']) and $_POST['deliveryAddress']!="")
    {
        //sanitize input field
        $deliveryAddress = filter_var($_POST['deliveryAddress'], FILTER_SANITIZE_STRING);  
        $deliveryAddress = htmlentities($deliveryAddress, ENT_QUOTES, 'UTF-8');
        
        
        $sql = "UPDATE user SET user_address = '{$deliveryAddress}' WHERE user_id = {$_SESSION['user_id']}";
        $db->query($sql);
        if($db->error()) {
            $json['fail']= "Error, please try again.";
            exit();
        } else $json['pass']= "Successfuly changed address";    

    } else $json['fail'] = "Please fill in input field.";
}


//CHANGE PASSWORD

if(isset($_GET['changePassword']))
{
    if(isset($_POST['currentPwd']) and isset($_POST['newPwd']) and isset($_POST['confirmNewPwd']) and $_POST['currentPwd']!="" and $_POST['newPwd']!="" and $_POST['confirmNewPwd']!="")
    {
            $newPwd = $_POST['newPwd'];
            $confirmNewPwd = $_POST['confirmNewPwd'];

                if($newPwd==$confirmNewPwd)
                {
                    $currentPwd = filter_var($_POST['currentPwd'], FILTER_SANITIZE_STRING);  
                    $currentPwd = htmlentities($currentPwd, ENT_QUOTES, 'UTF-8');
                    $salt="A*d6Mr3Vvevy#&Gi";
                    $password_hash = hash("sha256", $currentPwd).$salt;
                
                    $sql = "SELECT * FROM user WHERE user_id={$_SESSION['user_id']} AND user_password='{$password_hash}'";
                    $result = $db->query($sql);
                        if($db->error()) {
                            $json['fail']= "Error, please try again.";
                            exit();
                        }  
                            if($db->num_rows($result)==1)   
                            {
                                 $newPwd = filter_var($newPwd, FILTER_SANITIZE_STRING);  
                                 $newPwd = htmlentities($newPwd, ENT_QUOTES, 'UTF-8');
                                 $salt="A*d6Mr3Vvevy#&Gi";
                                 $new_password_hash = hash("sha256", $newPwd).$salt;
                                            
                                    $sql1 = "UPDATE user SET user_password='{$new_password_hash}' WHERE user_id={$_SESSION['user_id']}";

                                    $db->query($sql1);
                                        if($db->error()){
                                           $json['fail']= "Error, please try again."; 
                                           exit();
                                        }  else $json['pass']= "Successfuly changed password";
                            } else $json['fail'] = "Wrong current password.";  

                } else $json['fail'] = "Passwords not matching, please try again.";

    } else $json['fail'] = "Please fill in all required fields.";
}



   
//SHOW POLL OR MESSAGE IF ALREADY VOTED 
if(isset($_GET['b-opinion']))
{
        $sql = "SELECT * FROM user WHERE is_voted = 0 AND user_id = {$_SESSION['user_id']}";
        $result = $db->query($sql);
        if($db->error()){
           $json['fail'] = "Error, please try again."; 
           exit();
        } 
    
        if ($db->num_rows($result) == 0) {
            $json['fail'] = "No new questions at the moment.";
        } 
}
    
    
//ON CONFIRM BUTTON SEND ANSWER OF POLL AND UPDATE IN DATABSE
if(isset($_GET['confirm']))
{
        $user_id = $_SESSION['user_id'];

        if(isset($_POST['answer']) and $_POST['answer']!="")
        {
            $answer = $_POST['answer'];
            $sql = "UPDATE user SET is_voted=1, voted_result=$answer WHERE user_id =$user_id";
            $db->query($sql);
                if($db->error()){
                    $json['fail']= "Error, please try again.";
                    exit();
                } else $json['pass'] = "Thank you for your feedback. No new questions at the moment.";
        } else $json['fail'] = "You must choose one option";
}



//CONTACT US

if(isset($_GET['contactUs']))
{
    if(isset($_POST['contactSubject']) and $_POST['contactMessage']!="")

    {       //sanitize input fields
            $contactSubject = filter_var($_POST['contactSubject'], FILTER_SANITIZE_STRING);  
            $contactSubject = htmlentities($contactSubject, ENT_QUOTES, 'UTF-8');
            $contactMessage = filter_var($_POST['contactMessage'], FILTER_SANITIZE_STRING);  
            $contactMessage = htmlentities($contactMessage, ENT_QUOTES, 'UTF-8');

            $sql = "INSERT INTO contact (user_id, contact_username, contact_email, contact_subject, contact_message) VALUES ({$_SESSION['user_id']}, '{$_SESSION['user_username']}', '{$_SESSION['user_email']}', '{$contactSubject}', '{$contactMessage}')";

            $db->query($sql);
            if($db->error()){
                $json['fail']= "Error, please try again.";
                exit();
            } else $json['pass']= "Message sent successfuly. We will get back to you shortly.";    
                    
    } else $json['fail'] = "Please fill in all fields.";
}


echo JSON_encode($json, 256);


?>
