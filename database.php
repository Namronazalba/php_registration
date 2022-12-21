<?php 
$conn = mysqli_connect("localhost","root","","registration");

if(!$conn){
	die("Connection error: " . mysqli_connect_error());	
}
?>