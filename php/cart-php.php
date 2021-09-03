<?php
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");

$json['fail']="";
$json['pass']="";
$json['data']="";

$db = new Database();
if(!$db->connect()) exit("Connection failed");


//add to cart

if(isset($_GET['add-to-cart']))
{ 

        $user_id = $_SESSION['user_id'];
        $product_id=$_POST['product_id'];
        $selectedSize=$_POST['selectedSize'];
        $selectedQty=$_POST['selectedQty'];

        if(isset($product_id) AND isset($selectedSize) AND isset($selectedQty) AND $product_id!=0 AND $selectedSize!=0 AND $selectedQty!=0)
        {   

          $sql = "INSERT INTO cart (user_id, product_id, size_id, cart_quantity) VALUES ({$user_id}, {$product_id}, {$selectedSize}, {$selectedQty})";

          $db->query($sql);

          if($db->error()) {
            $json['fail'] = "Error, please try again.";
            exit();
          } else {

          $sql1 = "UPDATE product_size SET quantity = quantity - {$selectedQty} WHERE product_id = {$product_id} AND size_id = {$selectedSize}";

          $db->query($sql1);
          if($db->error()) {
            $json['fail'] = "Error, please try again.";
            exit();
          } else $json['pass'] = "Successfuly added to cart"; 
          }  

        } else  $json['fail'] = "You must choose size and quantity!"; 
        
  }



 
//show all in the cart

if(isset($_GET['cart']))
{
    if(isset($_SESSION['user_id']))
    {
          $user_id = $_SESSION['user_id'];
          $sql = "SELECT * FROM view_cart WHERE user_id={$user_id} AND is_bought=0";
          $result=$db->query($sql);

          if($db->error()) 
          {
              $json['fail']= "Error, please try again.";
              exit();
          }

              if($db->num_rows($result)!=0)
                  $json['data']=mysqli_fetch_all($result, MYSQLI_ASSOC); 
              else $json['fail'] = "No items in the cart!"; 
    } 

  }


//  remove each row product from the cart

if(isset($_GET['remove-item']))
{
    $user_id = $_SESSION['user_id'];
    $id=$_POST['id'];
    $size=$_POST['size'];
    $qty=$_POST['qty'];

      $sql="DELETE FROM cart WHERE product_id={$id} AND user_id = {$user_id} AND cart_quantity = {$qty} AND size_id = {$size} AND is_bought = 0 LIMIT 1"; 
      $result=$db->query($sql);
    
        if($db->error())
        {
          $json['fail']= "Error, please try again."; 
          exit();
        } else {   //return stock
            $sql1 = "UPDATE product_size SET quantity = quantity + {$qty} WHERE product_id = {$id} AND size_id = {$size}";

              $db->query($sql1);
              if($db->error())
              {
                $json['fail'] = "Error"; 
                exit();
              } else $json['pass'] = "Successfuly deleted item";
              
        }

}



  //Buy all from cart

if(isset($_GET['buy']))
{
    $user_id = $_SESSION['user_id'];

    $sql = "UPDATE cart SET is_bought=1 WHERE user_id=$user_id";

     $db->query($sql);

        if($db->error()){
          $json['fail'] = "Error, please try again."; 
          exit();
        } else $json['pass'] = "Successfuly bought items from cart";
    
}



  //show number items in the cart

  if(isset($_GET['number']))
  {
        if(isset($_SESSION['user_id']))
        {
          $user_id = $_SESSION['user_id'];
  
          $sql = "SELECT * FROM view_cart WHERE user_id={$user_id} AND is_bought=0";
          $result=$db->query($sql);
  
            if($db->error()) 
            {
                exit();
            } else $json['pass'] = $db->num_rows($result);
        } 
  }


echo JSON_encode($json, 256);
