<?php

function login(){  
    if(isset($_SESSION['user_id']) and isset($_SESSION['user_username']) and isset($_SESSION['user_email']) and isset($_SESSION['user_role']))
        return true;
    else if(isset($_COOKIE['user_id']) and isset($_COOKIE['user_username']) and isset($_COOKIE['user_email']) and isset($_COOKIE['user_role']))
    {
        $_SESSION['user_id'] = $_COOKIE['user_id']; 
        $_SESSION['user_username'] = $_COOKIE['user_username']; 
        $_SESSION['user_email'] = $_COOKIE['user_email']; 
        $_SESSION['user_role'] = $_COOKIE['user_role']; 
        return true;
    }
    else {
        return false;  
    }
}


function generatePassword(){
    $characters="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789-~!#$^*()_+./<>:[]";
    return substr(str_shuffle($characters), 0, 25);
}

?>