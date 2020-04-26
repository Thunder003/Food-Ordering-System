<?php

session_start();

if(!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !==true)
{
	header("location: AlertLogin.php");
}
else{

	if($_SESSION["Customer"]!=true)
    {
    	header("location: Alertrestaurant.php");
    }
		
	else{
		header("location: orderdone.php");
	}
}
?>

