<?php 
	include("php/config.php");
	session_start();
	session_unset();
	$result = session_destroy();
	header("Location: /wineries.php");
	
?>