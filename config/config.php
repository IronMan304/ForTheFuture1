<?php
ob_start(); //Turns on output buffering 
session_start();



$con = mysqli_connect("localhost", "root", "", "inatilleza_socmed"); //Connection variable

if(mysqli_connect_errno()) 
{
	echo "Failed to connect: " . mysqli_connect_errno();
}

?>