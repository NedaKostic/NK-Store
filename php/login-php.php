<?php
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");

$json['fail']="";
$json['pass']="";
$json['redirect']="";

$db = new Database();
if(!$db->connect()) exit("Connection failed");


//LOGIN

if(isset($_GET['login'])){

if(isset($_POST['username']) and isset($_POST['password']) and $_POST['username']!="" and $_POST['password']!="")   
{
    $username = $_POST['username'];
    $password = $_POST['password'];
    $remember= $_POST['remember'];      

    $username = filter_var($username, FILTER_SANITIZE_STRING);
    $password = filter_var($password, FILTER_SANITIZE_STRING);
    $username = htmlentities($username, ENT_QUOTES, 'UTF-8');   // ENT_QUOTES to convert both double and single quotes.
    $password = htmlentities($password, ENT_QUOTES, 'UTF-8');

    //paswword hash
    $salt="A*d6Mr3Vvevy#&Gi";
    $password_hash = hash("sha256", $password).$salt;

        $sql = "SELECT * FROM user WHERE user_username='{$username}'";
        $result = $db->query($sql); 
            if($db->error()) {
                $json['fail']= "Error";
                exit();
            } 
        
                if($db->num_rows($result)==1)  
                {
                    $row = $db->fetch_object($result);

                    if($row->user_password==$password_hash)
                    {

                        if($row->is_active==1 and $row->is_valid==1) 
                        {
                                $_SESSION['user_id'] = $row->user_id;  
                                $_SESSION['user_username'] = $row->user_username;
                                $_SESSION['user_email']=$row->user_email;   
                                $_SESSION['user_role'] = $row->user_role;

                                if($remember=="1")
                                {
                                    setcookie("user_id",  $_SESSION['user_id'], time()+86400, "/");
                                    setcookie("user_username",  $_SESSION['user_username'], time()+86400, "/");
                                    setcookie("user_email",  $_SESSION['user_email'], time()+86400, "/");
                                    setcookie("user_role",  $_SESSION['user_role'], time()+86400, "/"); 
                                }  
                                
                                if($row->user_role == "administrator") $json['redirect']="admin"; 
                                else $json['redirect'] ="user"; 

                        } else $json['fail'] = "User $username is not active";

                    } else $json['fail'] = "Wrong username or password.";  
                } else $json['fail'] = "Wrong username or password.";  

} else $json['fail'] =  "Please fill in all the required fields.";
    
}




//REGISTRATION

if(isset($_GET['register'])){

        if(isset($_POST['regName']) and isset($_POST['regLastname']) and isset($_POST['regUsername']) and isset($_POST['regEmail']) and isset($_POST['regPassword']) and isset($_POST['regRePassword']) and isset($_POST['regPhone'])and isset($_POST['regAddress']) and $_POST['regName']!="" and $_POST['regLastname']!="" and $_POST['regUsername']!="" and $_POST['regEmail']!="" and $_POST['regPassword']!="" and $_POST['regRePassword']!="" and $_POST['regPhone']!="" and $_POST['regAddress']!="")
        {
            //sanitize
            $regName = filter_var($_POST['regName'], FILTER_SANITIZE_STRING);
            $regLastname = filter_var($_POST['regLastname'], FILTER_SANITIZE_STRING);
            $regUsername = filter_var($_POST['regUsername'], FILTER_SANITIZE_STRING);
            $regEmail = filter_var($_POST['regEmail'], FILTER_SANITIZE_EMAIL);
            $regPassword = filter_var($_POST['regPassword'], FILTER_SANITIZE_STRING);
            $regRePassword = filter_var($_POST['regRePassword'], FILTER_SANITIZE_STRING);
            $regPhone = filter_var($_POST['regPhone'], FILTER_SANITIZE_NUMBER_INT); 
            $regAddress = filter_var($_POST['regUsername'], FILTER_SANITIZE_STRING);   
        
            if($regPassword==$regRePassword)
            {
                $sql="SELECT * FROM user WHERE user_username='{$regUsername}' OR user_email='{$regEmail}'";
                $result = $db->query($sql);
                if($db->error()) {
                    $json['fail']= "Error, please try again.";
                    exit();
                } 
                    if(($db->num_rows($result))==0) 
                    {
                        //validation
                        if (!filter_var($regEmail, FILTER_VALIDATE_EMAIL) === false) 
                        {
                                //clear tags
                                $regName = htmlentities($regName, ENT_QUOTES, 'UTF-8');
                                $regLastname = htmlentities($regLastname, ENT_QUOTES, 'UTF-8');
                                $regUsername = htmlentities($regUsername, ENT_QUOTES, 'UTF-8');
                                $regEmail = htmlentities($regEmail, ENT_QUOTES, 'UTF-8');
                                $regPassword = htmlentities($regPassword, ENT_QUOTES, 'UTF-8');
                                $regRePassword = htmlentities($regRePassword, ENT_QUOTES, 'UTF-8');
                                $regPhone = htmlentities($regPhone, ENT_QUOTES, 'UTF-8');
                                $regAddress = htmlentities($regAddress, ENT_QUOTES, 'UTF-8');
                                //password hash
                                $salt="A*d6Mr3Vvevy#&Gi";
                                $password_hash = hash("sha256", $regPassword).$salt;
                                //to generate random number 
                                $validationNumber=mt_rand(100000, mt_getrandmax());  

                                $sql="INSERT INTO user (user_firstname, user_lastname, user_username, user_email, user_password, user_phone, user_address, user_role, is_valid) VALUES ('{$regName}', '{$regLastname}', '{$regUsername}', '{$regEmail}','{$password_hash}', '{$regPhone}','{$regAddress}', 'customer', '{$validationNumber}')";
                    
                                $db->query($sql);

                                if($db->error()) {
                                    $json['fail']= "Error, please try again.";
                                    exit();
                                } else $json['pass']= "Successfuly registred! Check you email and validate your account";               
                
                        } else $json['fail'] =  "Not a valid format of email address";            

                    } else $json['fail']= "Sorry, this email address and/or username is already being used.";
        
            } else $json['fail'] = "Passwords not matching, please try again.";

        } else $json['fail'] = "Please fill in all the required fields.";
}



//RESET PASSWORD
if(isset($_GET['resetPassword']))
{

    if(isset($_POST['passEmail']) and $_POST['passEmail']!="")
    {

        $passEmail = $_POST['passEmail'];
        $passEmail = filter_var($_POST['passEmail'], FILTER_SANITIZE_EMAIL);
        if (!filter_var($passEmail, FILTER_VALIDATE_EMAIL) === false) 
        {
            $salt="A*d6Mr3Vvevy#&Gi";
            $newPassword = generatePassword(); 
            $new_password_hash = hash("sha256", $newPassword).$salt;
        
            $sql="UPDATE user SET user_password='{$new_password_hash}' WHERE user_email='{$passEmail}'";
            $db->query($sql);
                if($db->error()) {
                    $json['fail']= "Error, please try again.";
                    exit();
                } else {
                    $json['pass']= "Successfuly reset password! We sent you email with your new password. Once you are logged in, please change your password from user panel.";

                    //SEND EMAIL
                    $message = "Your temporary password is $newPassword; Once you are logged in, please change your password from user panel.";
                    $message = wordwrap($message, 70, "\r\n");
                    @mail("$passEmail", 'Reset your password', $message);
                }
        
        } else $json['fail'] =  "Not a valid format of email address";   

    } else $json['fail'] = "Please fill in email address.";
}


echo JSON_encode($json, 256);

?>