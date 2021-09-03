<?php
session_start();
require_once("../class/classDatabase.php");
require_once("../functions/general.php");

$db = new Database();
if (!$db->connect()) exit("Connection failed");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>NK STORE</title>

    <link rel="icon" href="favicon.ico">

    <!------------ INCLUDE CSS Custom File -------------->
    <link rel="stylesheet" href="assets/css/style.css">

    <!---------------- Font Awesome ---------------------->
    <script src="https://kit.fontawesome.com/ff8c852e02.js" crossorigin="anonymous"></script>

    <!---------------------- JQuery ---------------------->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!------------ INCLUDE CUSTOM JS FILES -------------->
    <script src="assets/js/main.js" defer></script>
    <script src="assets/js/cartNum.js" defer></script>
    <script src="assets/js/search.js" defer></script>