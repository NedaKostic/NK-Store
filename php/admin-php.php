<?php
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");

$json['fail']="";
$json['pass']="";
$json['data']="";

$db = new Database();
if(!$db->connect()) exit("Connection failed");


//////////////////MANAGE USERS//////////////////
//show all users
if(isset($_GET['b-users']))
{ 
  $sql = "SELECT * FROM user";

  $result=$db->query($sql);
    if($db->error()){
      $json['fail']= "Error, please try again.";
      exit();
    } 

  $json['data']=mysqli_fetch_all($result, MYSQLI_ASSOC);   
}


//insert new user 
if(isset($_GET['insertUser']))
{
    $admName=$_POST['admName'];
    $admLastname=$_POST['admLastname'];
    $admUsername=$_POST['admUsername'];
    $admEmail=$_POST['admEmail'];
    $admPhone=$_POST['admPhone'];
    $admAddress=$_POST['admAddress'];
    $admRole=$_POST['admRole'];

    if(isset($admName) and isset($admLastname) and isset($admUsername) and isset($admEmail) and isset($admPhone) and isset($admAddress) and isset($admRole) and $admName!="" and $admLastname!="" and $admUsername!="" and $admEmail!="" and $admPhone!="" and $admAddress!="" and $admRole!="") 
    {

        $sql="SELECT * FROM user WHERE user_username='{$admUsername}' OR user_email='{$admEmail}'";
        $result = $db->query($sql);

        if(($db->num_rows($result))==0) 
        {
                    $password = generatePassword();
                    $sql="INSERT INTO user (user_firstname, user_lastname, user_username, user_email, user_password, user_phone, user_address, user_role, is_valid) VALUES ('{$admName}', '{$admLastname}', '{$admUsername}', '{$admEmail}', '{$password}', '{$admPhone}','{$admAddress}', '{$admRole}', '1')";
        
                    $db->query($sql);

                    if($db->error()){
                      $json['fail']= "Error, please try again.";
                      exit();
                    } else $json['pass']= "Successfuly added new user";   

        } else $json['fail'] = "Email address and/or username is already being used.";

    }  else $json['fail'] =  "Please fill in all the required fields.";         
  
}



//update existing user

if(isset($_GET['updateUser']))
{
  $admId = $_POST['admId'];
  $admName=$_POST['admName'];
  $admLastname=$_POST['admLastname'];
  $admUsername=$_POST['admUsername'];
  $admEmail=$_POST['admEmail'];
  $admPhone=$_POST['admPhone'];
  $admAddress=$_POST['admAddress'];
  $admRole=$_POST['admRole'];

    if(isset($admName) and isset($admLastname) and isset($admUsername) and isset($admEmail) and isset($admPhone) and isset($admAddress) and isset($admRole) and $admName!="" and $admLastname!="" and $admUsername!="" and $admEmail!="" and $admPhone!="" and $admAddress!="" and $admRole!="") 
    {

      $sql = "UPDATE user SET user_firstname='{$admName}', user_lastname='{$admLastname}', user_username='{$admUsername}', user_email='{$admEmail}', user_phone='{$admPhone}', user_address='{$admAddress}', user_role='{$admRole}' WHERE user_id=$admId";

      $db->query($sql);

              if($db->error()) 
              {
                $json['fail']= "Error, please try again.";
                exit();
              } else $json['pass']= "Successfuly updated user details";
                

    }  else $json['fail'] = "Please fill in all the required fields."; 
     
}


//delete user
if(isset($_GET['deleteUser']))
{
  $admId=$_POST['admId'];

    $sql="DELETE FROM user WHERE user_id=$admId";
    $result=$db->query($sql);

    if($db->error()){
       $json['fail']= "Error, please try again.";
       exit();
    } else $json['pass']= "Successfuly deleted user";
}



//////////////////MANAGE PRODUCTS//////////////////

//show all products
if(isset($_GET['b-products']))
{ 
    $sql = "SELECT * FROM view_all_products WHERE is_active=1 ORDER BY product_id ASC";   

    $result=$db->query($sql);
    if($db->error()) {
      $json['fail']= "Error, please try again.";
      exit();
    }
 
  $json['data']=mysqli_fetch_all($result, MYSQLI_ASSOC); 
   
}




// insert new product

if(isset($_GET['insertProduct']))
{
      $user_id = $_SESSION['user_id'];
      $prodSizeId=$_POST['prodSizeId'];
      $prodQty=$_POST['prodQty'];

      $prodName=$_POST['prodName'];
      $prodPrice=$_POST['prodPrice'];
      $prodDescr=$_POST['prodDescr'];
      $prodColor=$_POST['prodColor'];
      $prodMaterial=$_POST['prodMaterial'];
      $prodCare=$_POST['prodCare'];
      $prodOrigin=$_POST['prodOrigin'];
      $prodCategory=$_POST['prodCategory'];
      $image=$_FILES['prodImage']['name'];


      if(isset($prodName) and isset($prodPrice) and isset($prodDescr) and isset($prodColor) and isset($prodMaterial) and isset($prodCare) and isset($prodOrigin) and isset($prodCategory) and isset($prodQty) and isset($image) and $prodName!="" and $prodPrice!="" and $prodDescr!="" and $prodColor!="" and $prodMaterial!="" and $prodCare!="" and $prodOrigin!="" and $prodCategory!=0 and $prodQty!="" and $image!="") 
      {
                 //insert products detail into product table
                $sql1="INSERT INTO product (product_name, product_price, product_description, product_color, product_material, product_care, product_origin, category_id, user_id) VALUES ('{$prodName}', '{$prodPrice}', '{$prodDescr}', '{$prodColor}', '{$prodMaterial}', '{$prodCare}','{$prodOrigin}', {$prodCategory}, {$user_id})";
                  
                 $db->query($sql1);

                if($db->error()) {
                  $json['fail']= "Error, please try again.";
                  exit();
                   } else 
                      {

                              //size and qty
                              $last_id = $db->insert_id();   //take last inserted id of products and put into next insert query 

                              $sql2="INSERT INTO product_size (product_id, size_id, quantity) VALUES ({$last_id}, {$prodSizeId}, {$prodQty})";
                              $db->query($sql2);

                              if($db->error()){
                                $json['fail']= "Error, please try again.";
                                exit();
                              } else 
                              {
                                  //to move image in folder and insert picture id into database
                                  $image=$_FILES['prodImage']['name'];
                                  $tempName=$_FILES['prodImage']['tmp_name'];
                                    
                                  $imageName=microtime(true).".jpg";
                                  $targetDirection="../assets/images/products/".$imageName;
                                  $allowed = array("jpg", "jpeg", "webp", "png", "bmp");

                                  if(in_array(pathinfo($imageName, PATHINFO_EXTENSION), $allowed))
                                  {
                                      if(@move_uploaded_file($tempName, $targetDirection))
                                      {

                                          $sql3="INSERT INTO product_image (product_image_name, product_id) VALUES ('{$imageName}', $last_id)";
                                          $db->query($sql3);
                                          if($db->error()) {
                                          $json['fail']= "Error, please try again.";
                                          exit();
                                          } else $json['pass'] = "Successfuly added new product"; 

                                      }  else $json['fail'] = "Error, image can not be uploaded.";
                                  } else $json['fail']= "Error, image can not be uploaded.";
                              }

                      }

      } else $json['fail'] = "Please fill in all the required fields.";         
} 






// UPDATE product

if(isset($_GET['updateProduct']))
{
    $user_id = $_SESSION['user_id'];
    $prodId = $_POST['prodId'];
    $prodSizeId=$_POST['prodSizeId'];
    $prodQty=$_POST['prodQty'];
    $prodName=$_POST['prodName'];
    $prodPrice=$_POST['prodPrice'];
    $prodDescr=$_POST['prodDescr'];
    $prodColor=$_POST['prodColor'];
    $prodMaterial=$_POST['prodMaterial'];
    $prodCare=$_POST['prodCare'];
    $prodOrigin=$_POST['prodOrigin'];
    $prodCategory=$_POST['prodCategory'];

    if(isset($prodName) and isset($prodPrice) and isset($prodDescr) and isset($prodColor) and isset($prodMaterial) and isset($prodCare) and isset($prodOrigin) and isset($prodCategory) and isset($prodQty) and $prodName!="" and $prodPrice!="" and $prodDescr!="" and $prodColor!="" and $prodMaterial!="" and $prodCare!="" and $prodOrigin!="" and $prodCategory!=0 and $prodQty!="")
    {

            // update product details into product table
            $sql1="UPDATE product SET product_name = '{$prodName}', product_price = '{$prodPrice}', product_description = '{$prodDescr}', product_color = '{$prodColor}', product_material = '{$prodMaterial}', product_care = '{$prodCare}', product_origin = '{$prodOrigin}', category_id = {$prodCategory}, user_id = $user_id WHERE product_id = $prodId";

            $db->query($sql1);

            if($db->error()) {
              $json['fail']= "Error, please try again.";
              exit(); 
            }
            
          //size and qty
          //different sizes - if already exists products with that size update, if not insert new size
            $sql2 = "SELECT * FROM product_size WHERE product_id={$prodId} and size_id={$prodSizeId}";
            $result2 = $db->query($sql2);

            if(($db->num_rows($result2))>0) 
            {
                $sql3="UPDATE product_size SET size_id = {$prodSizeId}, quantity = {$prodQty} WHERE product_id = $prodId LIMIT 1";
                $db->query($sql3);

                if($db->error()) { $json['fail']= "Error, please try again."; exit(); } 
          
            } else {
                $sql3="INSERT INTO product_size (product_id, size_id, quantity) VALUES ({$prodId}, {$prodSizeId}, {$prodQty})";
                $db->query($sql3);
              }

              //to move image in folder and insert picture id into database
              $image=$_FILES['prodImage']['name'];
              if($image!="")
              {               // if img exists because it can be the case that admin do not add new img
                    
                  $tempName=$_FILES['prodImage']['tmp_name'];
                  $imageName=microtime(true).".jpg";
                  $targetDirection="../assets/images/products/".$imageName;
                  $allowed = array("jpg", "jpeg", "webp", "png", "bmp");

                  if(in_array(pathinfo($imageName, PATHINFO_EXTENSION), $allowed))
                  {
                  
                    if(@move_uploaded_file($tempName, $targetDirection))
                    {

                        $sql4="UPDATE product_image SET product_image_name = '{$imageName}' WHERE product_id = $prodId";
                        $db->query($sql4);
                        if($db->error()) {
                          $json['fail'] = "Error, please try again.";
                           exit();
                        } else $json['pass'] = "Successfuly updated product"; 

                    } else $json['fail'] = "Error, image can not be uploaded.";

                  } else $json['fail'] = "Error, image can not be uploaded.";


              } else  $json['pass']= "Successfuly updated product"; 
                  
    } else $json['fail'] = "Please fill in all the required fields.";         
          
} 



 // DELETE product by selected size

if(isset($_GET['deleteProduct']))
{
      $prodId = $_POST['prodId'];
      $prodSizeId = $_POST['prodSizeId'];

      if($prodId!=0)
      {
          $sql="UPDATE product_size SET quantity = 0 WHERE product_id = $prodId AND size_id =$prodSizeId";
          $db->query($sql);
           if($db->error()) {
            $json['fail']= "Error, please try again.";
            exit();
            } else {
                 $json['pass']= "Successfuly deleted product"; 
              }
  
      } else $json['fail'] = "You did not choose product to delete!"; 

}


// DELETE selected products all sizes

if(isset($_GET['prodDeleteAllSizes']))
{
    $prodId = $_POST['prodId'];
    if($prodId!=0)
    {
          $sql="UPDATE product SET is_active = 0 WHERE product_id = $prodId";
          $db->query($sql);
          if($db->error()) {
            $json['fail']= "Error, please try again.";
            exit();
            } else {
                $sql1 = "DELETE FROM product_size WHERE product_id = $prodId";
                $db->query($sql1);
                if($db->error()){
                $json['fail'] = "Error, please try again.";
                exit();
                } else $json['pass'] = "Successfuly deleted product";    
            }
    
    } else $json['fail'] = "You did not choose product to delete!"; 


}



//////////////////MANAGE REVIEWS//////////////////

//show all unanswered reviews
if(isset($_GET['b-reviews']))
{ 
      $sql = "SELECT * FROM review WHERE is_approved = 0";

      $result=$db->query($sql);
    
      if($db->error()){
        $json['fail']= "Error, please try again.";
        exit();
      } 

      $json['data']=mysqli_fetch_all($result, MYSQLI_ASSOC); 
   
}


//reject selected review

 if(isset($_GET['reject']))
 {
    $adm_review_id = $_POST['adm_review_id'];
    $sql = "DELETE FROM review WHERE review_id=$adm_review_id";
    $db->query($sql);
    if($db->error()) {
      $json['fail']= "Error, please try again.";
      exit();
    } else $json['pass']= "Successfuly rejected review"; 
  
 }

 //approve selected review

 if(isset($_GET['approve']))
 {
    $adm_review_id = $_POST['adm_review_id'];
    $sql = "UPDATE review SET is_approved=1 WHERE review_id=$adm_review_id";

    $db->query($sql);
    if($db->error()) {
      $json['fail']= "Error, please try again.";
      exit();
    } else $json['pass']= "Successfuly approved review"; 
    
 }






 //////////////////MANAGE MESSAGES//////////////////

//show all unanswered messages

if(isset($_GET['b-messages']))
{ 
  $sql = "SELECT * FROM contact WHERE contact_answer is null";

  $result=$db->query($sql);
 
  if($db->error()){
    $json['fail']= "Error, please try again.";
    exit();
  } 

  $json['data']=mysqli_fetch_all($result, MYSQLI_ASSOC); 
   
}



//answer to message

if(isset($_GET['answer']))
{

    if(isset($_POST['adm_mess_id']) AND isset($_POST['contact_answer']))
    {
        $adm_mess_id=$_POST['adm_mess_id'];
        $contact_answer=$_POST['contact_answer'];

        if($adm_mess_id!=0 and $contact_answer!="")
        { 
          $sql= "UPDATE contact SET contact_answer='{$contact_answer}' WHERE contact_id=$adm_mess_id";
          $db->query($sql);
          if($db->error()){
            $json['fail'] ="Failed to send answer";
            exit();
          } else $json['pass'] = "Successfuly sent answer.";   
                           
        } else $json['fail']= "Please write answer"; 
    }  
}


 
echo JSON_encode($json, 256);



?>