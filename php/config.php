<?php
session_start();
$db = new mysqli('stardock.cs.virginia.edu','cs4750klf2bfa','spring2015','cs4750klf2bf');
if (isset($_SESSION["is_superuser"])) {

	if ($_SESSION["is_superuser"]) {
	$db = new mysqli('stardock.cs.virginia.edu','cs4750klf2bfb','spring2015','cs4750klf2bf');
	}
}

if ($db->connect_errno) {
	echo "<br> <h3>Cannot connect to database. Please try again later!</h3>";
	exit();
}

?>