<?php
session_start();
require_once("../class/classDatabase.php");

$db = new Database();
if(!$db->connect()) exit("Connection failed");


$showMessage['fail'] = "";
$showMessage['pass'] = "";


	if(isset($_POST['name']) and isset($_POST['email']) and isset($_POST['subject']) and isset($_POST['message']))
    {

		$name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
		$email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
		$subject = filter_var($_POST['subject'], FILTER_SANITIZE_STRING);
		$message = filter_var($_POST['message'], FILTER_SANITIZE_STRING);
		$name = htmlentities($name, ENT_QUOTES, 'UTF-8'); 
		$subject = htmlentities($subject, ENT_QUOTES, 'UTF-8'); 
		$message = htmlentities($message, ENT_QUOTES, 'UTF-8'); 

			if($name!="" and $email!="" and $subject!="" and $message!="")
			{

				if(filter_var($email, FILTER_VALIDATE_EMAIL))
				{ 
				
					$sql = "INSERT INTO contact (contact_username, contact_email, contact_subject, contact_message) VALUES ('{$name}', '{$email}', '{$subject}', '{$message}')";
					$db->query($sql);
						if($db->error()){
						$showMessage['fail'] = "Error, please try again.";
						exit();
						} else $showMessage['pass']= "Message sent successfuly. We will get back to you shortly.";  
								
				} else $showMessage['fail'] = "Invalid email format, please correct it.";

			} else $showMessage['fail'] = "Please fill in all the required fields.";
	
	} else $showMessage['fail'] = "Please fill in all the required fields.";

echo JSON_encode($showMessage, 256);
