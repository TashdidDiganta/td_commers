<?php 
session_start();
$msg="";

unset($_SESSION['ID']);
unset($_SESSION['username']);
unset($_SESSION['login']);

session_destroy();
$msg="Logout Successfull";
header("Location:login.php?id={$msg}");
exit;
?>