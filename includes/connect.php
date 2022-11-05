<?php 

$connection = mysqli_connect("localhost","root","","ticketingSystem");
if(!$connection){
   die("Connection failed:".mysqli_connect_error()); 
}
// echo "Connected successfully";

?>