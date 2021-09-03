<?php
session_start();
require_once("../functions/general.php");
session_unset();
session_destroy();

setcookie("user_id", "", time() - 1, "/");
setcookie("user_username", "", time() - 1, "/");
setcookie("user_email", "", time() - 1, "/");
setcookie("user_role", "", time() - 1, "/");
header("location:home");

?>






