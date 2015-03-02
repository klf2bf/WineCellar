<?php
$db = new mysqli('stardock.cs.virginia.edu','cs4750klf2bf','wine','cs4750klf2bf');
if ($db->connect_errno) {
	echo "Connection Error!";
	exit();
}
?>