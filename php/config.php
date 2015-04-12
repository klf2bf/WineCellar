<?php
$db = new mysqli('stardock.cs.virginia.edu','cs4750klf2bf','wine','cs4750klf2bf');
if ($db->connect_errno) {
	echo "<br> <h3>Cannot connect to database. Please try again later!</h3>";
	exit();
}
session_start();
?>