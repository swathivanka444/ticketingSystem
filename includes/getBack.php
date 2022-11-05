<?php 

include "./includes/connect.php"; 
session_start();
$user = $_SESSION['user'];
$type = $_SESSION['type'];

if(!$user){
    header("Location:login.php");
}

?>